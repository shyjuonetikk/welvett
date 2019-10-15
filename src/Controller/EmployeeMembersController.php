<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Datasource\ConnectionManager;
use Cake\ORM\TableRegistry;
use Cake\Mailer\Email;

/**
 * EmployeeMembers Controller
 *
 * @property \App\Model\Table\EmployeeMembersTable $EmployeeMembers
 *
 * @method \App\Model\Entity\EmployeeMember[] paginate($object = null, array $settings = [])
 */
class EmployeeMembersController extends AppController {

    private $welvettCommission = 20;

    public function isAuthorized($user) {
        $allow_employee = array('deleteService', 'fetchUsers','serviceVisibility', 'employeeEvents', 'getCustomerReviews', 'getBothDisputes', 'getDisputes', 'deleteReference', 'getLink', 'addReference', 'editReference', 'saveTalentDispute', 'requestPayment', 'readNotifications', 'changeEarning', 'updateServicesDashboard', 'editCities', 'getCity', 'ratings', 'saveUserInfo', 'validateBookings', 'addcities', 'clienttype', 'booktype', 'addradius', 'addReview', 'dashboardpro', 'employeeFreeevents', 'blockDates', 'talentReviews', 'findServices', 'updateServices', 'findSubServices', 'calendardates', 'messages', 'showBooking', 'addserviceEvents', 'services');
        $allow_corporate = array('getBooking','fetchUsers', 'saveDispute', 'getBothDisputes', 'getDisputes', 'releasePayment', 'readNotifications', 'viewBooking', 'editBooking', 'viewEmployee', 'getAmount', 'validateBookings', 'validateForm', 'getAmount', 'calendar', 'calendardates');
        $allow_individual = array('viewEmployee', 'fetchUsers','saveDispute', 'getBothDisputes', 'getDisputes', 'releasePayment', 'readNotifications', 'viewBooking', 'editBooking', 'getBooking', 'getAmount', 'validateBookings', 'validateForm', 'getAmount', 'calendar', 'calendardates');

        if (in_array($this->request->action, $allow_employee) && $user['role_id'] == 4) {
            return true;
        }
        if (in_array($this->request->action, $allow_corporate) && $user['role_id'] == 3) {
            return true;
        }
        if (in_array($this->request->action, $allow_individual) && $user['role_id'] == 2) {
            return true;
        }
        if ($this->viewVars['actionPermission'] != "") {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index() {
        $this->paginate = [
            'contain' => ['Users', 'Eventcategories']
        ];
        $employeeMembers = $this->paginate($this->EmployeeMembers);

        $this->set(compact('employeeMembers'));
        $this->set('_serialize', ['employeeMembers']);
    }

    public function getCustomerReviews() {
        //        debug($_GET['id']);
        $this->viewBuilder()->layout('');
        $this->loadModel('CustomerReviews');
        $this->loadModel('Users');
        $customer_details = $this->Users->get($_GET['id']);


        $reviews = $this->CustomerReviews->find('all')
                ->contain(['TalentUsers'])
                ->where(['customer_id' => $_GET['id']])
                ->toArray();
        $this->set('reviews', $reviews);
        $this->set('customer_details', $customer_details);
    }

    public function addReference($redirectTo = null) {

        if ($this->request->is('post')) {
            $this->loadModel('RefrenceLinks');
            $addLink = $this->RefrenceLinks->newEntity();
            $addLink = $this->RefrenceLinks->patchEntity($addLink, $this->request->data);

            if ($this->RefrenceLinks->save($addLink)) {
                $this->Flash->success('Reference link saved');
            } else {
                $this->Flash->error('Reference link can not be saved');
            }
            if ($redirectTo) {
                if ($redirectTo == 'dashboard') {
                    return $this->redirect('/Users/dashboard');
                } else {
                    return $this->redirect('/Users/pro_dashboard');
                }
            } else {
                return $this->redirect('/EmployeeMembers/employeeFreeevents/' . $this->request->data['talent_event_id']);
            }
        }
    }

    public function deleteReference($redirectTo = null) {

        if ($_GET['link_id']) {
            $linkId = $_GET['link_id'];
            $this->loadModel('RefrenceLinks');

            $addLink = $this->RefrenceLinks->get($linkId);

            if ($this->RefrenceLinks->delete($addLink)) {
                $responce = array('flag' => 1, 'message' => 'Reference deleted successfully');
            } else {
                $responce = array('flag' => 0, 'message' => 'Reference can not be deleted');
            }
        } else {
            $responce = array('flag' => 0, 'message' => 'Reference can not be deleted');
        }
        echo json_encode($responce);
        exit;
    }

    public function editReference($redirectTo = null) {

        if ($this->request->is('post')) {
            $linkId = $this->request->data['link_id'];

            unset($this->request->data['link_id']);

            $this->loadModel('RefrenceLinks');
            $addLink = $this->RefrenceLinks->get($linkId);
            $addLink = $this->RefrenceLinks->patchEntity($addLink, $this->request->data);

            if ($this->RefrenceLinks->save($addLink)) {
                $this->Flash->success('Reference link Updated');
            } else {
                $this->Flash->error('Reference link can not be updated');
            }
            if ($redirectTo) {
                if ($redirectTo == 'dashboard') {
                    return $this->redirect('/Users/dashboard');
                } else {
                    return $this->redirect('/Users/pro_dashboard');
                }
            } else {
                return $this->redirect('/EmployeeMembers/employeeFreeevents/' . $this->request->data['talent_event_id']);
            }
        }
    }

    public function getLink() {
        $this->loadModel('RefrenceLinks');
        if (isset($_GET['link_id'])) {
            $link = $this->RefrenceLinks->get($_GET['link_id']);
            if ($link) {
                echo json_encode(array('flag' => 1, 'data' => $link));
            } else {
                echo json_encode(array('flag' => 0, 'data' => '', 'message' => 'No Record found'));
            }
        } else {
            echo json_encode(array('flag' => 0, 'data' => '', 'message' => 'Method not allowed'));
        }
        exit;
    }

    public function changeEarning() {
        if ($_GET['month']) {
            $from = date($_GET['month'] . '-01');
            $to = date("Y-m-t", strtotime($from));
        }
        $this->loadModel('TalentEvents');
        $this->loadModel('EventTypes');
        $talentEvent = $this->TalentEvents->find('all', ['order' => 'id', 'limit' => 1, 'contain' => [
                        'Bookings' => function($r) use($from, $to) {
                            $r->contain('TalentEventCities')->where(['Bookings.created >' => $from, 'Bookings.created <' => $to]);
                            return $r;
                        }
                    ], 'conditions' => ['TalentEvents.user_id' => $this->Auth->user('id'), 'TalentEvents.id' => $_GET['service']]])->first();
        $event_types = $this->EventTypes->find('list', ['keyField' => 'event_type', 'valueField' => 'amount', 'conditions' => ['talent_event_id' => $talentEvent->id]])->toArray();
        $totalEarning = 0;
        foreach ($talentEvent->bookings as $b):
            if ($b->event_type == 1) {
                if ($b->talent_event_city != null) {
                    $totalEarning += $event_types[1] + $b->talent_event_city->accommodation_price;
                } else {
                    $totalEarning += $event_types[1] + 0;
                }
            } else {
                if ($b->talent_event_city != null) {
                    $totalEarning += $event_types[2] + $b->talent_event_city->accommodation_price;
                } else {
                    $totalEarning += $event_types[2] + 0;
                }
            }
        endforeach;
        $pre = date('Y-m', strtotime(date($_GET['month']) . " -1 month"));
        $next = date('Y-m', strtotime(date($_GET['month']) . " +1 month"));
        $m_name = date('F', strtotime(date($_GET['month'])));
        $response = array('earning' => $totalEarning, 'next' => $next, 'previous' => $pre, 'month_name' => $m_name);
        echo json_encode($response);
        exit();
    }

    public function getBooking() {
        $this->loadModel('Bookings');
        $booking = $this->Bookings->get($_GET['id']);
        $this->viewBuilder()->layout('');
        $this->loadModel('TalentEvents');
        $this->loadModel('TalentEventCities');
        $get_talent_cities = $this->TalentEventCities->find('all', ['conditions' => ['talent_event_id' => $booking->talent_event_id]])->toArray();
        //        debug($booking->talent_event_id);
        $service = $this->TalentEvents->get($booking->talent_event_id, ['contain' => ['Eventcategories', 'EventTypes']]);


        $conn = ConnectionManager::get('default');
        $query = 'SELECT s.id,s.statename FROM `cities` AS `c` JOIN `states` as `s` ON c.state_code=s.state_abbrv WHERE c.city LIKE "' . $booking->city . '" ';
        $result = $conn->execute($query);
        $states = $result->fetchAll('assoc');


        $this->loadModel('EventTypes');
        $get_amount = $this->EventTypes->find('all')->where(['talent_event_id' => $booking->talent_event_id, 'event_type' => 1])->first();
        $total_amount = 0;
        if (!empty($get_amount)) {
            $total_amount = $get_amount->amount;
        }
        if ($booking->event_type == 1) {
            $this->loadModel('TalentCalendars');
            $talent_dates = $this->TalentCalendars->find('all')->contain(['Bookings'])->where(['Bookings.event_type' => $booking->event_type, 'TalentCalendars.user_id' => $booking->talent_id, 'TalentCalendars.date >=' => $booking->from_date, 'TalentCalendars.date <=' => $booking->to_date])->order('date DESC')->toArray();
        }

        $this->set(compact('booking', 'total_amount', 'states', 'get_talent_cities', 'service', 'talent_dates'));
    }

    public function getCity() {
        $this->loadModel('TalentEventCities');
        $city = $this->TalentEventCities->get($_POST['id']);

        if ($city) {
            $conn = ConnectionManager::get('default');
            $query = 'SELECT s.id,s.statename FROM `cities` AS `c` JOIN `states` as `s` ON c.state_code=s.state_abbrv WHERE c.city LIKE "' . $city->city . '" ';
            $result = $conn->execute($query);
            $row = $result->fetchAll('assoc');
            echo json_encode(array('states' => $row, 'city' => $city));
        } else {
            echo json_encode('error');
        }
        exit();
    }

    public function editCities() {
        if ($this->request->is('post')) {

            $this->loadModel('TalentEventCities');
            $city = $this->TalentEventCities->get($this->request->data['city_id']);

            if ($city) {
                $check_if_exists = $this->TalentEventCities->find('all', ['conditions' => ['talent_event_id' => $city->talent_event_id, 'state_id' => $this->request->data['state_id'], 'city Like' => $this->request->data['city_name'], 'id !=' => $city->id]])->toArray();
                if (empty($check_if_exists)) {
                    $city->city = $this->request->data['city_name'];
                    $city->state_id = $this->request->data['state_id'];
                    $city->accommodation_price = $this->request->data['city_amount'];
                    if ($this->TalentEventCities->save($city)) {
                        $this->Flash->success('City updated');
                    } else {
                        $this->Flash->error('City can not be updated');
                    }
                } else {
                    $this->Flash->error('Sory cities duplication is not allowed');
                }
            } else {
                $this->Flash->error('invalid city');
            }
            if (!isset($this->request->data['pro_dashboard'])) {
                return $this->redirect('/EmployeeMembers/employeeFreeevents/' . $city->talent_event_id);
            } else {
                return $this->redirect('/Users/proDashboard');
            }
        }
    }

    public function booktype() {
        $this->loadModel('TalentEvents');
        $this->loadModel('EventTypes');
        $data = $_GET;

        $event_types = $this->EventTypes->find('all', [
                    'conditions' => ['talent_event_id' => $data['service_id'], 'event_type' => $data['event_type']]
                ])->first();
        if (isset($data['fetch_amount'])) {
            if ($event_types) {
                echo $event_types->amount;
            } else {
                echo 0;
            }
            exit();
        }

        $array_to_save = array();
        if ($event_types == null) {
            $event_types = $this->EventTypes->newEntity();
            $array_to_save['talent_event_id'] = $data['service_id'];
            $array_to_save['event_type'] = $data['event_type'];
            $array_to_save['amount'] = $data['set_amount'];
        } else {
            $array_to_save['amount'] = $data['set_amount'];
        }
        $event_types = $this->EventTypes->patchEntity($event_types, $array_to_save);
        if ($this->EventTypes->save($event_types)) {
            echo 1;
        } else {
            echo 0;
        }
        exit;
    }

    public function requestPayment() {
        $this->loadModel('Payments');
        $payment = $this->Payments->get($_GET['payment_id'], ['contain' => ['Bookings' => ['customers', 'talents']]]);
        $payment->is_requested = 1;
        if ($this->Payments->save($payment)) {
            $this->loadModel('TalentEvents');
            $t_e = $this->TalentEvents->get($payment->booking->talent_event_id, ['contain' => ['Eventcategories']]);

            // create notification
            $this->loadModel('Notifications');
            $notification = $this->Notifications->newEntity();
            $notification_array = array();
            $notification_array['booking_id'] = $payment->booking->id;
            $notification_array['talent_id'] = $payment->Talents['id'];
            $notification_array['customer_id'] = $payment->Customers['id'];
            $notification_array['activity_by'] = $payment->Talents['id'];
            $notification_array['message'] = ucwords($this->Auth->user('first_name') . ' ' . $this->Auth->user('last_name')) . ' requested for the payment of ' . $t_e->eventcategory->title . ' Event';
            $notification = $this->Notifications->patchEntity($notification, $notification_array);
            $this->Notifications->save($notification);

            // send emails
            $user = $payment->Customers;
            $talent = $payment->Talents;

            $this->loadModel('Users');
            $alertEmails = $this->Users->find('all', ['conditions' => ['role_id' => 1]])->toArray();
            //send mail to Customer
            $emailToTalent = new Email();
            $emailToTalent->template('payment_request_customer')->emailFormat('html')->to($user['email'])->from(['info@cyberclouds.com' => 'welvett.com'])->subject('Talent Payment Request')->viewVars(['content' => $user, 'talent' => $talent])->send();
            //sending mails to Super admins
            foreach ($alertEmails as $sendMail):
                $email = new Email();
                $email->template('payment_request_admin')->emailFormat('html')->to($sendMail->email)->from(['info@cyberclouds.com' => 'welvett.com'])->subject('Talent Payment Request')->viewVars(['admin' => $sendMail, 'customer' => $user, 'talent' => $talent])->send();
            endforeach;




            $success = 1;
        } else {
            $success = 0;
        }
        echo $success;
        exit;
    }

    public function releasePayment() {
        $this->loadModel('Payments');
        $payment = $this->Payments->get($_GET['payment_id'], ['contain' => ['Bookings' => ['customers', 'talents']]]);

        // save payment info
        $payment->status = 1; //released amount
        $payment->released_by = $payment->Customers['id']; //User id
        $payment->deducted_amount = ($payment->total_amount / 100 ) * $this->welvettCommission; //User id
        $payment->released_amount = $payment->total_amount - $payment->deducted_amount; //User id
        //        $payment->released_from = '';
        //        $payment->released_to = '';

        if ($this->Payments->save($payment)) {
            $this->loadModel('TalentEvents');
            $t_e = $this->TalentEvents->get($payment->booking->talent_event_id, ['contain' => ['Eventcategories']]);

            // create notification
            $this->loadModel('Notifications');
            $notification = $this->Notifications->newEntity();
            $notification_array = array();
            $notification_array['booking_id'] = $payment->booking->id;
            $notification_array['talent_id'] = $payment->Talents['id'];
            $notification_array['customer_id'] = $payment->Customers['id'];
            $notification_array['activity_by'] = $payment->Customers['id'];
            $notification_array['message'] = ucwords($this->Auth->user('first_name') . ' ' . $this->Auth->user('last_name')) . ' has released payment for ' . $t_e->eventcategory->title . ' Event';
            $notification = $this->Notifications->patchEntity($notification, $notification_array);
            $this->Notifications->save($notification);



            // send emails
            $user = $payment->Customers;
            $talent = $payment->Talents;

            $this->loadModel('Users');
            $alertEmails = $this->Users->find('all', ['conditions' => ['role_id' => 1]])->toArray();

            //send mail to Customer
            $emailToCust = new Email();
            $emailToCust->template('payment_released')->emailFormat('html')->to($user['email'])->from(['info@cyberclouds.com' => 'welvett.com'])->subject('Talent Payment Released')->viewVars(['content' => $user, 'talent' => $talent])->send();

            //send mail to Talent
            $emailToTalent = new Email();
            $emailToTalent->template('payment_released')->emailFormat('html')->to($user['email'])->from(['info@cyberclouds.com' => 'welvett.com'])->subject('Talent Payment Released')->viewVars(['content' => $talent, 'customer' => $user])->send();


            //sending mails to Super admins
            foreach ($alertEmails as $sendMail):
                $email = new Email();
                $email->template('payment_released')->emailFormat('html')->to($sendMail->email)->from(['info@cyberclouds.com' => 'welvett.com'])->subject('Talent Payment Released')->viewVars(['content' => $sendMail, 'customer' => $user, 'talent' => $talent])->send();
            endforeach;
            $success = 1;
        } else {
            $success = 0;
        }
        echo $success;
        exit;
    }

    public function saveDispute() {
        if ($this->request->is('post')) {
            $this->loadModel('Payments');
            $payment = $this->Payments->get($this->request->data['payment_id'], ['contain' => ['Bookings' => ['customers', 'talents']]]);

            // save payment info
            $payment->customer_issues = $this->request->data['customer_issue']; //released amount
            if ($this->Payments->save($payment)) {
                $this->loadModel('TalentEvents');
                $t_e = $this->TalentEvents->get($payment->booking->talent_event_id, ['contain' => ['Eventcategories']]);

                // create notification
                $this->loadModel('Notifications');
                $notification = $this->Notifications->newEntity();
                $notification_array = array();
                $notification_array['booking_id'] = $payment->booking->id;
                $notification_array['talent_id'] = $payment->Talents['id'];
                $notification_array['customer_id'] = $payment->Customers['id'];
                $notification_array['activity_by'] = $payment->Customers['id'];
                $notification_array['message'] = ucwords($this->Auth->user('first_name') . ' ' . $this->Auth->user('last_name')) . ' has disputed your payment for ' . $t_e->eventcategory->title . ' Event kindly check your email';
                $notification = $this->Notifications->patchEntity($notification, $notification_array);
                $this->Notifications->save($notification);

                // send emails
                $user = $payment->Customers;
                $talent = $payment->Talents;


                $this->loadModel('Users');
                $alertEmails = $this->Users->find('all', ['conditions' => ['role_id' => 1]])->toArray();
                //
                //                //send mail to Customer
                //                $emailToCust = new Email();
                //                $emailToCust->template('payment_released')
                //                        ->emailFormat('html')
                //                        ->to($user['email'])
                //                        ->from(['info@cyberclouds.com' => 'welvett.com'])
                //                        ->subject('Talent Payment Dispute')
                //                        ->viewVars(['content' => $user, 'talent' => $talent])
                //                        ->send();
                //send mail to Talent
                $emailToTalent = new Email();
                $emailToTalent->template('payment_disputed')
                        ->emailFormat('html')
                        ->to($talent['email'])
                        ->from(['info@cyberclouds.com' => 'welvett.com'])
                        ->subject('Talent Payment Dispute')
                        ->viewVars(['content' => $talent, 'customer' => $user, 'dispute_reason' => $this->request->data['customer_issue']])->send();


                //sending mails to Super admins
                foreach ($alertEmails as $sendMail):
                    $email = new Email();
                    $email->template('payment_disputed')->emailFormat('html')->to($sendMail->email)->from(['info@cyberclouds.com' => 'welvett.com'])->subject('Talent Payment Dispute')->viewVars(['content' => $sendMail, 'customer' => $user, 'talent' => $talent, 'dispute_reason' => $this->request->data['customer_issue']])->send();
                endforeach;
                $this->Flash->success(__('Request sent to admin.'));
                if ($this->Auth->user('role_id') == 3) {
                    return $this->redirect('/CorporateMembers/corporate_events');
                }
                if ($this->Auth->user('role_id') == 2) {
                    return $this->redirect('/Users/individual_events');
                }
            }
        }
    }

    public function saveTalentDispute() {
        if ($this->request->is('post')) {
            $this->loadModel('Payments');
            $payment = $this->Payments->get($this->request->data['payment_id'], ['contain' => ['Bookings' => ['customers', 'talents']]]);

            // save payment info
            $payment->talent_issues = $this->request->data['customer_issue']; //released amount
            if ($this->Payments->save($payment)) {
                $this->loadModel('TalentEvents');
                $t_e = $this->TalentEvents->get($payment->booking->talent_event_id, ['contain' => ['Eventcategories']]);

                // create notification
                $this->loadModel('Notifications');
                $notification = $this->Notifications->newEntity();
                $notification_array = array();
                $notification_array['booking_id'] = $payment->booking->id;
                $notification_array['talent_id'] = $payment->Talents['id'];
                $notification_array['customer_id'] = $payment->Customers['id'];
                $notification_array['activity_by'] = $payment->Talents['id'];
                $notification_array['message'] = ucwords($this->Auth->user('first_name') . ' ' . $this->Auth->user('last_name')) . ' has dispute payment for ' . $t_e->eventcategory->title . ' Event kindly check your email';
                $notification = $this->Notifications->patchEntity($notification, $notification_array);
                $this->Notifications->save($notification);

                // send emails
                $user = $payment->Customers;
                $talent = $payment->Talents;


                $this->loadModel('Users');
                $alertEmails = $this->Users->find('all', ['conditions' => ['role_id' => 1]])->toArray();
                //
                //                //send mail to Customer
                //                $emailToCust = new Email();
                //                $emailToCust->template('payment_released')
                //                        ->emailFormat('html')
                //                        ->to($user['email'])
                //                        ->from(['info@cyberclouds.com' => 'welvett.com'])
                //                        ->subject('Talent Payment Dispute')
                //                        ->viewVars(['content' => $user, 'talent' => $talent])
                //                        ->send();
                //send mail to Talent
                $emailToTalent = new Email();
                $emailToTalent->template('payment_disputed_talent')
                        ->emailFormat('html')
                        ->to($user['email'])
                        ->from(['info@cyberclouds.com' => 'welvett.com'])
                        ->subject('Talent Payment Dispute')
                        ->viewVars(['content' => $user, 'customer' => $talent, 'dispute_reason' => $this->request->data['customer_issue']])
                        ->send();


                //sending mails to Super admins
                foreach ($alertEmails as $sendMail):
                    $email = new Email();
                    $email->template('payment_disputed_talent')->emailFormat('html')->to($sendMail->email)->from(['info@cyberclouds.com' => 'welvett.com'])->subject('Talent Payment Dispute')->viewVars(['content' => $sendMail, 'customer' => $user, 'talent' => $talent, 'dispute_reason' => $this->request->data['customer_issue']])->send();
                endforeach;
                $this->Flash->success(__('Request sent to admin.'));
                if ($this->Auth->user('role_id') == 4) {
                    return $this->redirect('/EmployeeMembers/employee_events');
                }
            }
        }
    }

    public function fetchUsers() {
        $city = $_GET['field'];
        $this->loadModel('Users');
        $cities = $this->Users->find('list', ['keyField' => 'id', 'valueField' => function ($row) {
                        return $row['first_name'] . ' ' . $row['last_name'];
                    }, 'conditions' => ['CONCAT(first_name," ",last_name) LIKE' => '%' . $city . '%','role_id'=>4], 'limit' => 10, 'order' => 'first_name'])
                ->group('first_name')
                ->toArray();
        echo json_encode($cities);
        exit;
    }

    public function booktype_old() {
        $this->autoRender = false;
        $bookingamount = $_GET['bookingamount'];
        $event_type = $_GET['eventtype'];
        $eventtypewhole = $_GET['eventtypewhole'];

        $service = $_GET['service'];
        $subservice = $_GET['subservice'];
        $talentid = $_GET['talentid'];
        $user = $this->request->session()->read('Auth.User');
        $user = $user['id'];
        //echo json_encode(event_type);
        //exit;
        $role = 4;
        $condition = 'roles.id="' . $role . '"';
        $condition .= ' AND users.id="' . $user . '" AND talent_event_subcategories.talent_event_id="' . $talentid . '"';

        //$condition .= ' AND users.id="' . $user . '" AND talent_event_subcategories.eventcategory_id="' . $service . '" AND talent_event_subcategories.eventsubcategory_id="' . $subservice . '"';
        $conn = ConnectionManager::get('default');
        $query = $conn->execute('SELECT first_name,last_name,amount,payment_type,talent_event_subcategories.talent_event_id as talentid'
                . ' FROM roles '
                . 'left join users  ON roles.id=users.role_id '
                . 'left  join employee_members  ON users.id=employee_members.user_id '
                . 'left  join talent_event_subcategories  ON users.id=talent_event_subcategories.user_id '
                . 'left  join eventcategories  ON eventcategories.id=talent_event_subcategories.eventcategory_id '
                . 'left  join eventsubcategories  ON eventsubcategories.id=talent_event_subcategories.eventsubcategory_id '
                . 'left  join talent_events ON talent_events.id=talent_event_subcategories.talent_event_id '
                . 'where ' . $condition . ' group by users.id');

        $event_servic = $query->fetchAll('assoc');

        $this->loadModel('TalentEvents');
        $talentevent = $this->TalentEvents->newEntity();

        debug($event_servic);
        exit();
        if (!empty($event_servic[0]['talentid'])) {

            $talentid = $event_servic[0]['talentid'];

            $query = "UPDATE `talent_events` SET amount = '$bookingamount',payment_type= '$event_type' WHERE talent_events.id = '$talentid'";
            $result = $conn->execute($query);

            $role = 4;
            $condition = 'roles.id="' . $role . '"';
            $condition .= ' AND users.id="' . $user . '" AND talent_event_subcategories.talent_event_id="' . $talentid . '"';

            $conn = ConnectionManager::get('default');
            $query = $conn->execute('SELECT first_name,last_name,amount,payment_type,talent_event_subcategories.talent_event_id as talentid'
                    . ' FROM roles '
                    . 'left join users  ON roles.id=users.role_id '
                    . 'left  join employee_members  ON users.id=employee_members.user_id '
                    . 'left  join talent_event_subcategories  ON users.id=talent_event_subcategories.user_id '
                    . 'left  join eventcategories  ON eventcategories.id=talent_event_subcategories.eventcategory_id '
                    . 'left  join eventsubcategories  ON eventsubcategories.id=talent_event_subcategories.eventsubcategory_id '
                    . 'left  join talent_events ON talent_events.id=talent_event_subcategories.talent_event_id '
                    . 'where ' . $condition);

            $event_servic = $query->fetchAll('assoc');
            echo json_encode($event_servic);
        } else {
            $userId = $this->request->session()->read('Auth.User.id');
            $this->request->data['TalentEvents']['amount'] = $bookingamount;
            $this->request->data['TalentEvents']['eventcategory_id'] = $service;
            $this->request->data['TalentEvents']['payment_type'] = $event_type;
            $this->request->data['TalentEvents']['user_id'] = $userId;
            $eventcategory = $this->TalentEvents->patchEntity($talentevent, $this->request->data['TalentEvents']);
            if ($this->TalentEvents->save($eventcategory)) {
                $this->loadModel('TalentEventSubcategories');
                $talentevent_id = $talentevent->id;

                $eventsubcategory = $this->TalentEventSubcategories->newEntity();

                $this->request->data['TalentEventSubcategories']['user_id'] = $userId;
                $this->request->data['TalentEventSubcategories']['talent_event_id'] = $talentevent_id;
                $this->request->data['TalentEventSubcategories']['eventcategory_id'] = $service;
                $this->request->data['TalentEventSubcategories']['eventsubcategory_id'] = $subservice;
                $eventsubcategory = $this->TalentEventSubcategories->patchEntity($eventsubcategory, $this->request->data['TalentEventSubcategories']);

                $this->TalentEventSubcategories->save($eventsubcategory);

                $conn = ConnectionManager::get('default');
                $query = $conn->execute('SELECT first_name,last_name,amount,payment_type,talent_event_subcategories.talent_event_id as talentid'
                        . ' FROM roles '
                        . 'left join users  ON roles.id=users.role_id '
                        . 'left  join employee_members  ON users.id=employee_members.user_id '
                        . 'left  join talent_event_subcategories  ON users.id=talent_event_subcategories.user_id '
                        . 'left  join eventcategories  ON eventcategories.id=talent_event_subcategories.eventcategory_id '
                        . 'left  join eventsubcategories  ON eventsubcategories.id=talent_event_subcategories.eventsubcategory_id '
                        . 'left  join talent_events ON talent_events.id=talent_event_subcategories.talent_event_id '
                        . 'where ' . $condition);

                $event_servic = $query->fetchAll('assoc');
                echo json_encode($event_servic);
            }
            $this->Flash->error(__('The data could not be saved. Please, try again.'));
        }

        //echo json_encode($event_employees);
        exit;
    }

    public function addradius() {
        if ($this->request->is('post')) {
            $save_data = array();
            foreach ($this->request->data['name'] as $key => $value) {
                $save_data[$key]['talent_event_id'] = $this->request->data['talent'];
                $save_data[$key]['city'] = $value;
                $save_data[$key]['accommodation_price'] = 0;
            }

            $this->loadModel('TalentEventCities');
            $talentCalendar = $this->TalentEventCities->newEntities($save_data);
            if ($this->TalentEventCities->saveMany($talentCalendar)) {
                $this->Flash->success(__('Radius has been saved.'));
                return $this->redirect('/EmployeeMembers/employeeFreeevents');
            }
            exit();
        }
    }

    public function addcities($redirect_to = null) {
        if ($this->request->is('post')) {
            $this->loadModel('TalentEventCities');

            $get_cities = $this->TalentEventCities->find('list', ['keyField' => 'id', 'valueField' => 'city', 'conditions' => ['talent_event_id' => $this->request->data['talent']]])->toArray();

            $save_data = array();
            $delete = array();
            $this->loadModel('TalentEventCities');
            foreach ($this->request->data['name'] as $key => $value) {
                $tec = $this->TalentEventCities->find('all', ['conditions' => ['talent_event_id' => $this->request->data['talent'], 'city LIKE' => $value, 'state_id' => $this->request->data['state_id'][$key]]])->first();
                if ($tec) {
                    $delete[$tec->id]['city'] = $value;
                    $delete[$tec->id]['state_id'] = $this->request->data['state_id'][$key];
                    $delete[$tec->id]['accommodation_price'] = !empty($this->request->data['amount'][$key]) ? $this->request->data['amount'][$key] : 0;
                } else {
                    $save_data[$key]['talent_event_id'] = $this->request->data['talent'];
                    $save_data[$key]['city'] = $value;
                    $save_data[$key]['state_id'] = $this->request->data['state_id'][$key];
                    $save_data[$key]['accommodation_price'] = !empty($this->request->data['amount'][$key]) ? $this->request->data['amount'][$key] : 0;
                }
            }

            if ($delete) {
                $all_records = TableRegistry::get('TalentEventCities');
                foreach ($delete as $keyId => $update_record):
                    $record = $all_records->get($keyId);
                    $record->city = $update_record['city'];
                    $record->state_id = $update_record['state_id'];
                    $record->accommodation_price = $update_record['accommodation_price'];
                    $all_records->save($record);
                endforeach;
                //                $del = $this->TalentEventCities->deleteAll(['TalentEventCities.id IN' => $delete]);
            }

            if (!empty($save_data)) {
                $talentCalendar = $this->TalentEventCities->newEntities($save_data);
                if ($this->TalentEventCities->saveMany($talentCalendar)) {
                    $this->Flash->success(__('Cities has been saved.'));
                } else {
                    $this->Flash->error(__('Cities can not be added.'));
                }
            }
            if ($redirect_to) {
                return $this->redirect('/users/pro_dashboard');
            } else {
                return $this->redirect('/EmployeeMembers/employeeFreeevents/' . $this->request->data['talent']);
            }
            exit();
        }
    }

    public function clienttype($redirect_to = null) {
        if ($redirect_to) {
            if (isset($_GET['client_type'])) {
                if (count($_GET['client_type']) == 2) {
                    $client_type = 0;
                } else {
                    $client_type = $_GET['client_type'][0];
                }
            } else {
                $client_type = 0;
            }
            $talentid = $_GET['event_id'];
        } else {
            if (!empty($_GET['individual']) && !empty($_GET['corporate'])) {
                $client_type = 0;
            } else {
                if (!empty($_GET['individual'])) {
                    $client_type = $_GET['individual'];
                } elseif (!empty($_GET['corporate'])) {
                    $client_type = $_GET['corporate'];
                } else {
                    $client_type = 0;
                }
            }
            $talentid = $_GET['talentid'];
            $service = $_GET['service'];
            $subservice = $_GET['subservice'];
        }
        $user = $this->request->session()->read('Auth.User');
        $user = $user['id'];
        $this->loadModel('TalentEvents');
        $get_rec = $this->TalentEvents->get($talentid);
        $message = array();
        if ($get_rec) {
            //            debug($get_rec);exit();
            if ($client_type == 0) {
                $get_rec->client_type = null;
            } else {
                $get_rec->client_type = $client_type;
            }

            if ($this->TalentEvents->save($get_rec)) {
                $message = array('flag' => 1, 'message' => '<span class="success_message">Client type changed</span>');
            } else {
                $message = array('flag' => 0, 'message' => '<span class="error_message">Client type can not be changed</span>');
            }
        } else {
            $message = array('flag' => 0, 'message' => '<span class="error_message">Record not found</span>');
        }
        echo json_encode($message);
        exit;
    }

    public function clienttype_27_march() {
        $this->autoRender = false;

        $client_type = $_GET['clienttype'];
        $talentid = $_GET['talentid'];
        $service = $_GET['service'];
        $subservice = $_GET['subservice'];
        $user = $this->request->session()->read('Auth.User');
        $user = $user['id'];
        //echo json_encode(event_type);
        //exit;
        $role = 4;
        $condition = 'roles.id="' . $role . '"';
        $condition .= ' AND users.id="' . $user . '" AND talent_event_subcategories.talent_event_id="' . $talentid . '"';
        //$condition .= ' AND users.id="' . $user . '" AND talent_event_subcategories.eventcategory_id="' . $service . '" AND talent_event_subcategories.eventsubcategory_id="' . $subservice . '"';
        $conn = ConnectionManager::get('default');
        $query = $conn->execute('SELECT first_name,last_name,amount,payment_type,talent_event_subcategories.talent_event_id as talentid'
                . ' FROM roles '
                . 'left join users  ON roles.id=users.role_id '
                . 'left  join employee_members  ON users.id=employee_members.user_id '
                . 'left  join talent_event_subcategories  ON users.id=talent_event_subcategories.user_id '
                . 'left  join eventcategories  ON eventcategories.id=talent_event_subcategories.eventcategory_id '
                . 'left  join eventsubcategories  ON eventsubcategories.id=talent_event_subcategories.eventsubcategory_id '
                . 'left  join talent_events ON talent_events.id=talent_event_subcategories.talent_event_id '
                . 'where ' . $condition);

        $event_servic = $query->fetchAll('assoc');


        $this->loadModel('TalentEvents');
        $talentevent = $this->TalentEvents->newEntity();

        //echo $event_servic[0]['talentid'];exit;
        //echo $event_servic['payment_type'];exit;
        if (!empty($event_servic[0]['talentid'])) {

            $talentids = $event_servic[0]['talentid'];

            $query = "UPDATE `talent_events` SET client_type= '$client_type' WHERE talent_events.id = '$talentids'";

            $result = $conn->execute($query);
        } else {
            $userId = $this->request->session()->read('Auth.User.id');

            $this->request->data['TalentEvents']['eventcategory_id'] = $service;
            $this->request->data['TalentEvents']['client_type'] = $client_type;
            $this->request->data['TalentEvents']['user_id'] = $userId;
            $eventcategory = $this->TalentEvents->patchEntity($talentevent, $this->request->data['TalentEvents']);
            if ($this->TalentEvents->save($eventcategory)) {
                $this->loadModel('TalentEventSubcategories');
                $talentevent_id = $talentevent->id;

                $eventsubcategory = $this->TalentEventSubcategories->newEntity();

                $this->request->data['TalentEventSubcategories']['user_id'] = $userId;
                $this->request->data['TalentEventSubcategories']['talent_event_id'] = $talentevent_id;
                $this->request->data['TalentEventSubcategories']['eventcategory_id'] = $service;
                $this->request->data['TalentEventSubcategories']['eventsubcategory_id'] = $subservice;
                $eventsubcategory = $this->TalentEventSubcategories->patchEntity($eventsubcategory, $this->request->data['TalentEventSubcategories']);

                $this->TalentEventSubcategories->save($eventsubcategory);
            }
            $this->Flash->error(__('The data could not be saved. Please, try again.'));
        }

        //echo json_encode($event_employees);
        exit;
    }

    public function getDisputes() {
        if (isset($_GET['payment_id'])) {

            $this->loadModel('Payments');
            $getData = $this->Payments->get($_GET['payment_id']);
            if ($_GET['get_field'] == 'customer_issues') {
                echo $getData->customer_issues;
            } else {
                echo $getData->talent_issues;
            }
        }
        exit;
    }

    public function getBothDisputes() {
        if (isset($_GET['payment_id'])) {
            $this->loadModel('Payments');
            $getData = $this->Payments->get($_GET['payment_id']);
            //            debug($getData);
            $dis = array('talent' => $getData->talent_issues, 'customer' => $getData->customer_issues, 'admin' => $getData->admin_decision);
            echo json_encode($dis);
        }
        exit;
    }

    public function viewEmployee($event_id = null) {
        $this->loadModel('Users');
        $title = 'Talent Profile :: Welvet';
        //get Talent Service for which he will be booked
        $this->loadModel('TalentEvents');
        $service = $this->TalentEvents->get($event_id, ['contain' => ['RefrenceLinks', 'Eventcategories', 'EventTypes', 'TalentReviews', 'TalentReviews.Customers']]);

        $this->loadModel('EventTypes');
        $get_amount = $this->EventTypes->find('all')->where(['talent_event_id' => $event_id, 'event_type' => 1])->first();

        $userInfo = $this->Users->get($service->user_id, ['contain' => ['EmployeeMembers', 'TalentEvents' => function($te)use($event_id) {
                    $te->where(['id' => $event_id]);
                    return $te;
                }
        ]]);

//        debug($userInfo->email);
//        exit;
        $total_amount = 0;
        if (!empty($get_amount)) {
            $total_amount = $get_amount->amount;
        }
        if ($this->request->is('post')) {

            $this->loadModel('Bookings');
            $booking = $this->Bookings->newEntity();
            $this->request->data['talent_id'] = $service->user_id;
            $this->request->data['customer_id'] = $this->Auth->user('id');
            $this->request->data['event_type'] = $this->request->data['modal_event_type'];
            $this->request->data['from_time'] = date('H:i:s', strtotime($this->request->data['from_time']));
            $this->request->data['to_time'] = date('H:i:s', strtotime($this->request->data['to_time']));


            $time1 = strtotime($this->request->data['from_time']);
            $time2 = strtotime($this->request->data['to_time']);
            $total_hours = round(abs($time2 - $time1) / 3600, 2);

            $this->request->data['total_hours'] = $total_hours;

            if ($this->request->data['modal_event_type'] == 2) {
                $this->request->data['total_hours'] = 0;
                unset($this->request->data['from_time']);
                unset($this->request->data['to_time']);
            }
            unset($this->request->data['modal_event_type']);

            $this->request->data['from_date'] = date('Y-m-d', strtotime($this->request->data['from_date']));
            $this->request->data['to_date'] = date('Y-m-d', strtotime($this->request->data['to_date']));

            if ($this->request->data['event_type'] == 2) {
                unset($this->request->data['from_time']);
                unset($this->request->data['to_time']);
            }
            //            debug($this->request->data);
            //            exit();
            //
            //
            //            debug($this->request->data);
            //            exit;
            $this->request->data['status'] = 0;
            $this->request->data['is_completed'] = 'no';
            //            debug($this->request->data);
            //            exit();
            $booking = $this->Bookings->patchEntity($booking, $this->request->data);

            if ($this->Bookings->save($booking)) {
                //notify
                $this->loadModel('TalentEvents');
                $t_e = $this->TalentEvents->get($booking->talent_event_id, ['contain' => ['Eventcategories']]);

                $this->loadModel('Notifications');
                $notification = $this->Notifications->newEntity();
                $notification_array = array();
                $notification_array['booking_id'] = $booking->id;
                $notification_array['talent_id'] = $booking->talent_id;
                $notification_array['customer_id'] = $booking->customer_id;
                $notification_array['activity_by'] = $booking->customer_id;
                $notification_array['message'] = ucwords($this->Auth->user('first_name') . ' ' . $this->Auth->user('last_name')) . ' wants to book you for ' . $t_e->eventcategory->title . ' Service';
                $notification = $this->Notifications->patchEntity($notification, $notification_array);

                $this->Notifications->save($notification);


                $message = "You have a new Booking Request. Kindly go to your dashboard for further details.";

                $emailToTalent = new Email();
                $emailToTalent->template('new_booking')
                        ->emailFormat('html')->to($userInfo->email)
                        ->from(['info@cyberclouds.com' => 'welvett.com'])
                        ->subject('New Booking Request')
                        ->viewVars(['content' => $userInfo, 'message' => $message])
                        ->send();


                $this->Flash->success(__('Booking has been saved.'));
                if ($this->Auth->user('role_id') == 3) {
                    return $this->redirect('/corporateMembers/corporateEvents');
                }
                if ($this->Auth->user('role_id') == 2) {
                    return $this->redirect('/Users/individualEvents');
                }
            }
            $this->Flash->error(__('The employee member could not be saved. Please, try again.'));
        }


        $reviews = $service->talent_reviews;

        $this->loadModel('States');
        $states = $this->States->find('list')->toArray();

        $this->loadModel('TalentEventCities');
        $get_talent_cities = $this->TalentEventCities->find('all', ['conditions' => ['talent_event_id' => $event_id]])->toArray();

        $referenceLinks = $service->refrence_links;

        $this->set(compact('title', 'referenceLinks', 'total_amount', 'service', 'userInfo', 'reviews', 'states', 'get_talent_cities'));
        $this->viewBuilder()->setLayout('dashboard');
    }

    public function readNotifications() {
        $userId = $this->Auth->user('id');
        $roleId = $this->Auth->user('role_id');
        if ($roleId == 4) {
            $role = 'talent_id';
        } else {
            $role = 'customer_id';
        }

        $check = TableRegistry::get('Notifications')->updateAll(
                ["is_read" => 1], [$role => $userId, 'activity_by !=' => $userId]
        );
        if ($check) {
            echo 1;
        } else {
            echo 0;
        }
        exit();
    }

    public function editBooking() {

        if ($this->request->is('post')) {

            $bookingId = $this->request->data['booking_id'];
            $this->request->data['event_type'] = $this->request->data['modal_event_type'];
            $this->request->data['from_date'] = date('Y-m-d', strtotime($this->request->data['from_date']));
            $this->request->data['to_date'] = date('Y-m-d', strtotime($this->request->data['to_date']));
            $this->request->data['from_time'] = date('H:i:s', strtotime($this->request->data['from_time']));
            $this->request->data['to_time'] = date('H:i:s', strtotime($this->request->data['to_time']));
            if ($this->request->data['modal_event_type'] == 2) {
                $this->request->data['total_hours'] = 0;
                $this->request->data['from_time'] = null;
                $this->request->data['to_time'] = null;
            }
            $this->request->data['event_type'] = $this->request->data['modal_event_type'];
            unset($this->request->data['modal_event_type']);
            unset($this->request->data['booking_id']);
            $this->loadModel('Bookings');
            $booking = $this->Bookings->get($bookingId);
            if ($booking) {
                $booking = $this->Bookings->patchEntity($booking, $this->request->data);
                if ($this->Bookings->save($booking)) {
                    $this->Flash->success('Record updated successfully');
                } else {
                    $this->Flash->error('Record can not be updated');
                }
            } else {
                $this->Flash->error('Record not found');
            }
            if ($this->Auth->user('role_id') == 2) {
                return $this->redirect('/Users/individual_events');
            }
            if ($this->Auth->user('role_id') == 3) {
                return $this->redirect('/CorporateMembers/corporate_events');
            }
        }
    }

    public function validateBookings() {
        $post = $_GET;
        if (isset($post['talent'])) {
            $userId = $post['talent'];
            $from = date('Y-m-d', strtotime($post['from_date']));
            $to = date('Y-m-d', strtotime($post['to_date']));
            $this->loadModel('TalentCalendars');
            if ($post['event_type'] == 1) {

// cheking if whole event is booked on the given time frame
                $checkWholeEvent = $this->TalentCalendars->find('all')->contain(['Bookings'])->where(['Bookings.event_type' => 2, 'TalentCalendars.user_id' => $userId, 'TalentCalendars.date >=' => $from, 'TalentCalendars.date <=' => $to])->count();
                if ($checkWholeEvent > 0) {


                    $return_table = '<h6 style="color:#711A2A;">Talent Schedule on the given dates</h6><table class="table table-bordered">';
                    $return_table .= '<tr>'
                            . '<th>Date</th>'
                            . '<th>From Time</th>'
                            . '<th>To Time</th>'
                            . '</tr>'
                            . '<tr>'
                            . '<td colspan="3" style="color:red;font-size:14px;">Sorry Talent is unavailable in the given dates</td>'
                            . '</tr>'
                            . '</table>';



                    $response = array('event_type' => $post['event_type'], 'html' => $return_table, 'message' => 'Sorry The given date is reserved for whole event', 'is_success' => 0);
                } else {


                    if (isset($post['from_time']) && isset($post['to_time'])) {
                        $validate_date = $this->TalentCalendars->find('all')->contain(['Bookings'])->where(['Bookings.event_type' => $post['event_type'], 'TalentCalendars.user_id' => $userId, 'TalentCalendars.date >=' => $from, 'TalentCalendars.date <=' => $to,
                                    'OR' => [
                                        ['TalentCalendars.from_time < "' . $post['from_time'] . ':00" ', 'TalentCalendars.to_time > "' . $post['from_time'] . ':00"'],
                                        ['TalentCalendars.from_time < "' . $post['to_time'] . ':00" ', 'TalentCalendars.to_time > "' . $post['to_time'] . ':00"']
                                        , ['TalentCalendars.from_time BETWEEN "' . $post['from_time'] . ':00" AND "' . $post['to_time'] . ':00"', 'TalentCalendars.to_time BETWEEN "' . $post['from_time'] . ':00" AND "' . $post['to_time'] . ':00"']
                                    ]
                                ])->order('date DESC')->toArray();
                        if ($validate_date) {
                            $response = array('event_type' => $post['event_type'], 'html' => '', 'message' => 'There is a conflict in the booking time. Please change time you selected.', 'is_success' => 0);
                            echo json_encode($response);
                            exit;
                        }
                    }


                    $talent_dates = $this->TalentCalendars->find('all')->contain(['Bookings'])->where(['Bookings.event_type' => $post['event_type'], 'TalentCalendars.user_id' => $userId, 'TalentCalendars.date >=' => $from, 'TalentCalendars.date <=' => $to])->order('date DESC')->all();

                    $return_table = '<table class="table table-bordered">';
                    $return_table .= '<tr>'
                            . '<th>Date</th>'
                            . '<th>From Time</th>'
                            . '<th>To Time</th>'
                            . '</tr>';
                    if (count($talent_dates) > 0) {
                        foreach ($talent_dates as $td):
                            $return_table .= '<tr>'
                                    . '<td>' . date('M d,Y', strtotime($td->date)) . '</td>'
                                    . '<td>' . date('h:i a', strtotime($td->from_time)) . '</td>'
                                    . '<td>' . date('h:i a', strtotime($td->to_time)) . '</td>'
                                    . '</tr>';
                        endforeach;
                    }else {
                        $return_table .= '<tr>'
                                . '<td colspan="3" style="color:green;">Talent is available for all timings</td>'
                                . '</tr>';
                    }

                    $return_table .= '</table>';

                    $response = array('event_type' => $post['event_type'], 'html' => $return_table, 'message' => '', 'is_success' => 1);
                }
            } else {
                $checkWholeEvent = $this->TalentCalendars->find('all')->where(['TalentCalendars.user_id' => $userId, 'TalentCalendars.date >=' => $from, 'TalentCalendars.date <=' => $to])->count();
                if ($checkWholeEvent > 0) {
                    $response = array('event_type' => $post['event_type'], 'html' => '', 'message' => 'Talent can not be booked for whole event on the given dates', 'is_success' => 0);
                } else {
                    $response = array('event_type' => $post['event_type'], 'html' => '', 'is_success' => 1);
                }
            }
            echo json_encode($response);
        }
        exit;
    }

    public function calendar() {
        $this->viewBuilder()->layout('');
    }

    public function calendardates() {

        if (!empty($_REQUEST['year']) && !empty($_REQUEST['month'])) {
            $year = intval($_REQUEST['year']);
            $month = intval($_REQUEST['month']);

            $from = $year . '-' . $month . '-01';
            $to = date("Y-m-t", strtotime($from));
            $userId = intval($_REQUEST['talent_id']);
            $this->loadModel('TalentCalendars');
            $talent_dates = $this->TalentCalendars->find('all', ['conditions' => ['user_id' => $userId, 'date >=' => $from, 'date <=' => $to]])->toArray();

//            debug($talent_dates);
//            exit;
//            $lastday = intval(strftime('%d', mktime(0, 0, 0, ($month == 12 ? 1 : $month + 1), 0, ($month == 12 ? $year + 1 : $year))));
            $dates = array();
            $i = 0;
//            debug($talent_dates);
            foreach ($talent_dates as $value) {
                $d = $value->date;
                $date = date('Y-m-d', strtotime($d));
                $title = '';
                if ($value->booking_id == null) {
                    $title = 'Talent unavaiable';
                } else {
                    $title = 'This date is Booked';
                }
                $dates[$i] = array(
                    'date' => $date,
                    'badge' => true,
                    'title' => $title,
                );

                if (!empty($_REQUEST['grade'])) {
                    $dates[$i]['badge'] = false;
                    $dates[$i]['classname'] = 'grade-' . rand(1, 4);
                }

                if (!empty($_REQUEST['action'])) {
                    $dates[$i]['title'] = 'Action for ' . $date;
                    $dates[$i]['body'] = '<p>The footer of this modal window consists of two buttons. One button to close the modal window without further action.</p>';
                    $dates[$i]['body'] .= '<p>The other button [Go ahead!] fires myFunction(). The content for the footer was obtained with the AJAX request.</p>';
                    $dates[$i]['body'] .= '<p>The ID needed for the function can be retrieved with jQuery: <code>dateId = $(this).closest(\'.modal\').attr(\'dateId\');</code></p>';
                    $dates[$i]['body'] .= '<p>The second argument is true in this case, so the function can handle closing the modal window: <code>myFunction(dateId, true);</code></p>';
                    $dates[$i]['footer'] = '
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" onclick="dateId = $(this).closest(\'.modal\').attr(\'dateId\'); myDateFunction(dateId, true);">Go ahead!</button>
            ';
                }
                $i++;
            }
            if (isset($_REQUEST['booking_id'])) {
                $this->loadModel('Bookings');
                $get_dates = $this->Bookings->get($_REQUEST['booking_id']);

                if ($get_dates->status == 3 || $get_dates->status == 0) {
                    $booking_from_date = date("Y-m-d", strtotime($get_dates->from_date));
                    $booking_to_date = date("Y-m-d", strtotime($get_dates->to_date));
                    $period = new \DatePeriod(
                            new \DateTime($booking_from_date), new \DateInterval('P1D'), new \DateTime($booking_to_date)
                    );
//                debug($dates);
                    foreach ($period as $value) {
                        $date = $value->format('Y-m-d');
                        $dates[$i] = array(
                            'date' => $date,
                            'badge' => false,
                            'title' => 'Request for booking',
                            'class' => 'request'
                        );
                        $i++;
                    }
                    $dates[$i] = array(
                        'date' => $booking_to_date,
                        'badge' => false,
                        'title' => 'Request for booking',
                    );
                }
            }

            echo json_encode($dates);
        } else {
            echo json_encode(array());
        }
        exit();
    }

    public function getAmount() {
        $this->loadModel('EventTypes');
        $event_type = $this->EventTypes->find('all', ['conditions' => ['talent_event_id' => $_GET['event_id'], 'event_type LIKE' => '%' . $_GET['event_type'] . '%']])->first();
        if ($event_type) {
            echo '$ ' . $event_type->amount;
        } else {
            echo 'N/A';
        }
        exit();
    }

    public function showBooking() {
        $data = $_GET;
        if (isset($data['booking_id'])) {
            $this->loadModel('Bookings');
            $booking = $this->Bookings->get($data['booking_id'], [
                'contain' => ['TalentEventCities']
            ]);
            $this->loadModel('States');
            $states = $this->States->find('list')->toArray();

            $this->loadModel('EventTypes');
            $event_type = $this->EventTypes->find('all', ['conditions' => ['talent_event_id' => $booking->talent_event_id, 'event_type LIKE' => '%' . $booking->event_type . '%']])->first();

            if ($booking->event_type == 1) {
                $this->loadModel('TalentCalendars');
                $talent_dates = $this->TalentCalendars->find('all')->contain(['Bookings'])->where(['Bookings.event_type' => $booking->event_type, 'TalentCalendars.user_id' => $booking->talent_id, 'TalentCalendars.date >=' => $booking->from_date, 'TalentCalendars.date <=' => $booking->to_date])->order('date DESC')->toArray();
            }



            $this->set(compact('states', 'booking', 'event_type', 'talent_dates'));
        }
        $this->viewBuilder()->layout('');
    }

    public function validateForm() {
        $data = $_POST;
//        debug($data);exit();
        if (isset($data['talent_event_id'])) {
            $event_type = $data['modal_event_type'];
            $this->loadModel('TalentEvents');
            $talent_events = $this->TalentEvents->get($data['talent_event_id'], ['contain' => ['EventCategories', 'Users', 'EventTypes' => function($r)use ($event_type) {
                        $r->select([
                            'event_type',
                            'amount',
                            'talent_event_id'
                        ])->where(['EventTypes.event_type LIKE' => '%' . $event_type . '%']);
                        return $r;
                    }]]);
//        debug();
//        exit();
            $get_talent_cities = array('accommodation_price' => 0, 'city' => 'N/A');
            if (isset($data['talent_event_city_id'])) {
                $this->loadModel('TalentEventCities');
                $get_talent_cities = $this->TalentEventCities->get($data['talent_event_city_id'])->toArray();
            }
            $this->loadModel('States');
            $states = $this->States->find('list')->toArray();

            $this->set(compact('data', 'states', 'talent_events', 'get_talent_cities'));
        }
        $this->viewBuilder()->layout('');
    }

    public function saveUserInfo() {
        $this->autoRender = false;
        $userId = $this->request->session()->read('Auth.User.id');

        if ($this->request->is('post')) {
            $data = $this->request->data['data'];
            $columnName = $this->request->data['column_name'];
            $dbField = $columnName;

            if ($columnName == 'password') {
                $hasher = new DefaultPasswordHasher();
                $data = $hasher->hash($data);
            }
            $conn = ConnectionManager::get('default');
            if ($columnName == 'description') {
                $data = str_replace("'", "\'", $data);
                $query = "UPDATE `employee_members` SET `" . $columnName . "` = '$data' WHERE `user_id` = '$userId'";
                $result = $conn->execute($query);
                $getUserInfo = "SELECT `" . $dbField . "` FROM `employee_members` WHERE `user_id` = '$userId'";
            } else {
                $query = "UPDATE `users` SET `" . $columnName . "` = '$data' WHERE `id` = '$userId'";
                $result = $conn->execute($query);
                $getUserInfo = "SELECT `" . $dbField . "` FROM `users` WHERE `id` = '$userId'";
            }

//store log
            $this->loadModel('Logs');
            $this->loadModel('Users');
            $findRole = $this->Users->get($userId, [
                'contain' => ['Roles']
            ]);
            $roleName = $findRole->role->name;

            $activity = 'Profile Info Updated';
            $note = $roleName . ' update the profile information';
            $logs = $this->Logs->newEntity();
            $this->request->data['Log']['user_id'] = $userId;
            $this->request->data['Log']['activity'] = $activity;
            $this->request->data['Log']['note'] = $note;

            $logs = $this->Logs->patchEntity($logs, $this->request->data['Log']);

            $this->Logs->save($logs);

            $resultUserInfo = $conn->execute($getUserInfo);
            $row = $resultUserInfo->fetch('assoc');
            echo $columnName . ',' . $row[$dbField];
        }
    }

    public function blockDates() {

        if ($this->request->is('post')) {

            $booking_from_date = date("Y-m-d", strtotime($this->request->data['from_date']));
            $booking_to_date = date("Y-m-d", strtotime($this->request->data['to_date']));
            $period = new \DatePeriod(
                    new \DateTime($booking_from_date), new \DateInterval('P1D'), new \DateTime($booking_to_date)
            );
            $saveCalendar = array();
            $i = 0;
            foreach ($period as $value) {
                $saveCalendar[$i]['date'] = $value->format('Y-m-d');
                $saveCalendar[$i]['user_id'] = $this->Auth->user('id');
//                $saveCalendar[$i]['talent_event_id'] = $this->request->data['talent_event_id'];
//                $saveCalendar[$i]['booking_id'] = $booking->id;
                $saveCalendar[$i]['is_booked'] = 1;
                $i++;
            }
            $saveCalendar[$i]['date'] = $booking_to_date;
            $saveCalendar[$i]['user_id'] = $this->Auth->user('id');
//            $saveCalendar[$i]['talent_event_id'] = $booking->talent_event_id;
//            $saveCalendar[$i]['booking_id'] = $booking->id;
            $saveCalendar[$i]['is_booked'] = 1;
//            debug($this->request->data['talent_event_id']);exit;
            $this->loadModel('TalentCalendars');
            $talentCalendar = $this->TalentCalendars->newEntities($saveCalendar);
            if ($this->TalentCalendars->saveMany($talentCalendar)) {
                $this->Flash->success(__('The requested days are blocked successfully.'));
                return $this->redirect('/EmployeeMembers/employeeFreeevents/' . $this->request->data['talent_event_id']);
            }
        }
    }

    public function employeeEvents($status = null) {
        $title = 'Employee Events :: Welvet';
        $this->loadModel('Users');

        if ($this->request->is('post')) {
            $bookings = TableRegistry::get('Bookings');
            $booking = $bookings->get($this->request->data['booking_id'], ['contain' => ['Talents']]);

            if (isset($this->request->data['decline'])) {
                $status = 'declined';

                $booking->status = 1;
            }
            if (isset($this->request->data['accept'])) {
                $status = 'accepted';

//dates inserted in talent Event calendar 
                $booking_from_date = date("Y-m-d", strtotime($booking->from_date));
                $booking_to_date = date("Y-m-d", strtotime($booking->to_date));
                $period = new \DatePeriod(
                        new \DateTime($booking_from_date), new \DateInterval('P1D'), new \DateTime($booking_to_date)
                );
                $saveCalendar = array();
                $i = 0;
                foreach ($period as $value) {
                    $saveCalendar[$i]['date'] = $value->format('Y-m-d');
                    $saveCalendar[$i]['user_id'] = $this->Auth->user('id');
                    $saveCalendar[$i]['talent_event_id'] = $booking->talent_event_id;
                    $saveCalendar[$i]['from_time'] = date('H:i:s', strtotime($booking->from_time));
                    $saveCalendar[$i]['to_time'] = date('H:i:s', strtotime($booking->to_time));
                    $saveCalendar[$i]['booking_id'] = $booking->id;
                    $saveCalendar[$i]['is_booked'] = 1;
                    $i++;
                }
                $saveCalendar[$i]['date'] = $booking_to_date;
                $saveCalendar[$i]['user_id'] = $this->Auth->user('id');
                $saveCalendar[$i]['talent_event_id'] = $booking->talent_event_id;
                $saveCalendar[$i]['from_time'] = date('H:i:s', strtotime($booking->from_time));
                $saveCalendar[$i]['to_time'] = date('H:i:s', strtotime($booking->to_time));
                $saveCalendar[$i]['booking_id'] = $booking->id;
                $saveCalendar[$i]['is_booked'] = 1;
//                debug($saveCalendar);exit;
                $this->loadModel('TalentCalendars');
                $talentCalendar = $this->TalentCalendars->newEntities($saveCalendar);
                $this->TalentCalendars->saveMany($talentCalendar);


// data insertion in payments table
                $this->loadModel('Payments');
                $payments = $this->Payments->newEntity();
                $this->loadModel('EventTypes');
                $this->loadModel('TalentEventCities');
                $get_amount = $this->EventTypes->find('all', ['conditions' => ['talent_event_id' => $booking->talent_event_id, 'event_type' => $booking->event_type]])->first();
                $get_acc = $this->TalentEventCities->get($booking->talent_event_city_id);
                $total_amount = $get_amount->amount + $get_acc->accommodation_price;

                $payments->booking_id = $booking->id;
                $payments->status = 0; //on hold
                $payments->total_amount = $total_amount;
                $save_payments = $this->Payments->save($payments);

                $booking->status = 2;
            }
            if ($bookings->save($booking)) {
//save Notifications
                $this->loadModel('Notifications');
                $notification = $this->Notifications->newEntity();
                $notification_array = array();
                $notification_array['talent_id'] = $booking->talent_id;
                $notification_array['customer_id'] = $booking->customer_id;
                $notification_array['activity_by'] = $booking->talent_id;
                $notification_array['booking_id'] = $booking->id;
                $notification_array['message'] = ucwords($booking->talent->first_name . ' ' . $booking->talent->last_name) . ' has ' . $status . ' your booking request';

                $notification = $this->Notifications->patchEntity($notification, $notification_array);

                $this->Notifications->save($notification);

                $message = "Your request to book " . ucwords($booking->talent->first_name . ' ' . $booking->talent->last_name) . ' has been ' . $status . '. for more detail kindly visit your account.';
                $customerDetails = $this->Users->get($booking->customer_id);
                $emailToTalent = new Email();
                $emailToTalent->template('new_booking')
                        ->emailFormat('html')->to($customerDetails->email)
                        ->from(['info@cyberclouds.com' => 'welvett.com'])
                        ->subject('Booking Request Response')
                        ->viewVars(['content' => $customerDetails, 'message' => $message])
                        ->send();

                $this->Flash->success(__('Booking accepted.'));
                return $this->redirect('/EmployeeMembers/employee_events');
            }
        }
        $id = $this->Auth->user('id');
        $this->loadModel('States');
        $states = $this->States->find('list')->toArray();
        $user = $this->Users->get($id, ['contain' => ['TalentEvents' => ['Eventcategories'], 'EmployeeMembers', 'EmployeeMembers.Eventcategories.Eventsubcategories', 'Memberships', 'TalentEventSubcategories']]);

        $this->loadModel('Bookings');
        $conditions = '';
        if ($status == 'disputes') {
            $conditions = array('OR' => array('Payments.talent_issues IS NOT Null', 'Payments.customer_issues IS NOT Null'));
        }
        if ($status == 'accepted') {
            $conditions = array('Bookings.status' => 2);
        }
        if ($status == 'pending') {
            $conditions = array('Bookings.status' => 0);
        }

        if (is_numeric($status) == true) {

            $notificationId = $status;
            $notification = TableRegistry::get("Notifications");
            $query = $notification->query();
            $resultNotification = $query->update()->set(['is_read' => 1])->where(['id' => $notificationId])->execute();
            $this->loadModel('Notifications');
            $unread_notifications = $this->Notifications->find('all')->where(['talent_id' => $this->Auth->user('id'), 'is_read' => 0, 'activity_by !=' => $this->Auth->user('id')])->count();
            $this->set(compact('unread_notifications'));
        }
        $this->paginate = [
            'contain' => [
                'Payments',
                'TalentEvents' => ['Eventcategories'], 'CustomerReviews' => function($r)use ($id) {
                    $r->select([
                        'talent_event_id',
                        'review',
                        'talent_id'
                    ])->where(['CustomerReviews.talent_id' => $id]);
                    return $r;
                }, 'Customers', 'CustomerRatings'],
            'conditions' => ['Bookings.talent_id' => $id, $conditions],
            'group' => ['Bookings.id'],
            'order' => ['Bookings.id' => 'DESC'],
            'limit' => 15
        ];
        $bookings = $this->paginate($this->Bookings);


        $this->set(compact('title', 'user', 'bookings', 'states'));
        $this->viewBuilder()->setLayout('dashboard');
    }

    public function viewBooking() {
        $data = $_GET;
        if (isset($data['booking_id'])) {
            $this->loadModel('Bookings');
            $booking = $this->Bookings->get($data['booking_id'], [
                'contain' => ['TalentEventCities']
            ]);
            $this->loadModel('States');
            $states = $this->States->find('list')->toArray();

            $this->loadModel('EventTypes');
            $event_type = $this->EventTypes->find('all', ['conditions' => ['talent_event_id' => $booking->talent_event_id, 'event_type LIKE' => '%' . $booking->event_type . '%']])->first();

            if ($booking->event_type == 1) {
                $this->loadModel('TalentCalendars');
                $talent_dates = $this->TalentCalendars->find('all')->contain(['Bookings'])->where(['Bookings.event_type' => $booking->event_type, 'TalentCalendars.user_id' => $booking->talent_id, 'TalentCalendars.date >=' => $booking->from_date, 'TalentCalendars.date <=' => $booking->to_date])->order('date DESC')->toArray();
            }


            $this->set(compact('states', 'booking', 'event_type', 'talent_dates'));
        }
        $this->viewBuilder()->layout('');
    }

    public function employeeFreeevents($service_id = null) {
        if ($this->request->is('post')) {
            $this->loadModel('Memberships');
            $membership = $this->Memberships->newEntity();
            $new_member = array();
            $new_member['user_id'] = $this->Auth->user('id');
            $new_member['amount'] = 200;
            $new_member['pay_date'] = date('Y-m-d');
            $new_member['expiry_date'] = date('Y-m-d', strtotime('+1 year'));
            $new_member['status'] = 1;
            $membership = $this->Memberships->patchEntity($membership, $new_member);
            if ($this->Memberships->save($membership)) {
                $this->Flash->success(__('You are successfully subscribed to pro version.'));
                return $this->redirect('');
            }
        }
        $title = 'Dasboard :: Welvet';
        $id = $this->Auth->user('id');
        $this->loadModel('Users');
        $user = $this->Users->get($id, ['contain' => ['EmployeeMembers', 'EmployeeMembers.Eventcategories']]);
        $this->loadModel('TalentEvents');
//        debug();
        $from = date('Y-m-01');
        $to = date('Y-m-t');
        $this->loadModel('EventTypes');
        if ($service_id) {
            $talentEvent = $this->TalentEvents->get($service_id, ['contain' => ['RefrenceLinks', 'Eventcategories', 'EventTypes' => function($r) {
                        $r->order(['event_type'])->limit(1);
                        return $r;
                    }, 'Bookings' => function($r) use($from, $to) {
                        $r->contain('TalentEventCities')->where(['Bookings.created >' => $from, 'Bookings.created <' => $to]);
                        return $r;
                    }], 'conditions' => ['TalentEvents.user_id' => $this->Auth->user('id')]]);
        } else {
            $talentEvent = $this->TalentEvents->find('all', ['order' => 'TalentEvents.id', 'limit' => 1,
                        'contain' => ['EventTypes' => function($r) {
                                $r->order(['event_type'])->limit(1);
                                return $r;
                            }, 'Bookings' => function($r) use($from, $to) {
                                $r->contain('TalentEventCities')->where(['Bookings.created >' => $from, 'Bookings.created <' => $to]);
                                return $r;
                            }, 'Eventcategories'], 'conditions' => ['TalentEvents.user_id' => $this->Auth->user('id')]])->first();
        }
        $event_types = $this->EventTypes->find('list', ['keyField' => 'event_type', 'valueField' => 'amount', 'conditions' => ['talent_event_id' => $talentEvent->id]])->toArray();
        $totalEarning = 0;
//        debug($talentEvent->bookings);exit;
        foreach ($talentEvent->bookings as $b):

            if ($b->event_type == 1) {

                if ($b->talent_event_city != null) {

                    $totalEarning += $event_types[1] + $b->talent_event_city->accommodation_price;
                } else {
                    $totalEarning += $event_types[1] + 0;
                }
            } else {
                if ($b->talent_event_city != null) {

                    $totalEarning += $event_types[2] + $b->talent_event_city->accommodation_price;
                } else {
                    $totalEarning += $event_types[2] + 0;
                }
            }
        endforeach;
        $this->set(compact('title', 'totalEarning', 'user', 'bookings', 'talentEvent'));
        $this->viewBuilder()->setLayout('dashboard');
    }

    public function addReview() {
        if (isset($_GET['booking_id'])) {
            $this->viewBuilder()->layout('');
            $this->loadModel('Bookings');
            $booking = $this->Bookings->get($_GET['booking_id']);

            if ($booking) {
                $this->loadModel('CustomerReviews');
                $review = $this->CustomerReviews->newEntity();
                $newData = array();
                $newData['talent_id'] = $this->Auth->user('id');
                $newData['review'] = $_GET['review'];
                $newData['talent_event_id'] = $booking->talent_event_id;
                $newData['booking_id'] = $booking->id;
                $newData['customer_id'] = $booking->customer_id;
                $review = $this->CustomerReviews->patchEntity($review, $newData);
                if ($this->CustomerReviews->save($review)) {
                    $userId = $this->request->session()->read('Auth.User.id');
//store log
                    $this->loadModel('Logs');
                    $this->loadModel('Users');
                    $findRole = $this->Users->get($userId, [
                        'contain' => ['Roles']
                    ]);
                    $roleName = $findRole->role->name;

                    $activity = 'Review Added';
                    $note = $roleName . ' add a review.';
                    $logs = $this->Logs->newEntity();
                    $this->request->data['Log']['user_id'] = $userId;
                    $this->request->data['Log']['activity'] = $activity;
                    $this->request->data['Log']['note'] = $note;

                    $logs = $this->Logs->patchEntity($logs, $this->request->data['Log']);

                    $this->Logs->save($logs);
                }
            }
        }
    }

    /**
     * View method
     *
     * @param string|null $id Employee Member id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        $employeeMember = $this->EmployeeMembers->get($id, [
            'contain' => ['Users', 'Eventcategories']
        ]);

        $this->set('employeeMember', $employeeMember);
        $this->set('_serialize', ['employeeMember']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $employeeMember = $this->EmployeeMembers->newEntity();
        if ($this->request->is('post')) {
            $employeeMember = $this->EmployeeMembers->patchEntity($employeeMember, $this->request->getData());
            if ($this->EmployeeMembers->save($employeeMember)) {
                $this->Flash->success(__('The employee member has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The employee member could not be saved. Please, try again.'));
        }
        $users = $this->EmployeeMembers->Users->find('list', ['limit' => 200]);
        $eventcategories = $this->EmployeeMembers->Eventcategories->find('list', ['limit' => 200]);
        $this->set(compact('employeeMember', 'users', 'eventcategories'));
        $this->set('_serialize', ['employeeMember']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Employee Member id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $employeeMember = $this->EmployeeMembers->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $employeeMember = $this->EmployeeMembers->patchEntity($employeeMember, $this->request->getData());
            if ($this->EmployeeMembers->save($employeeMember)) {
                $this->Flash->success(__('The employee member has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The employee member could not be saved. Please, try again.'));
        }
        $users = $this->EmployeeMembers->Users->find('list', ['limit' => 200]);
        $eventcategories = $this->EmployeeMembers->Eventcategories->find('list', ['limit' => 200]);
        $this->set(compact('employeeMember', 'users', 'eventcategories'));
        $this->set('_serialize', ['employeeMember']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Employee Member id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $employeeMember = $this->EmployeeMembers->get($id);
        if ($this->EmployeeMembers->delete($employeeMember)) {
            $this->Flash->success(__('The employee member has been deleted.'));
        } else {
            $this->Flash->error(__('The employee member could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function talentReviews() {
        $this->loadModel('Users');
        $userId = $this->request->session()->read('Auth.User.id');
        $title = 'Corporate  Reviews :: Welvet';
        $userInfo = $this->Users->get($userId, [
            'contain' => ['Roles', 'TalentEvents' => ['Eventcategories']]
        ]);

        if ($userInfo->role_id != 4) {
            return $this->redirect(['controller' => 'pages', 'action' => 'home']);
        }


        $this->loadModel('TalentReviews');
        $this->loadModel('TalentRatings');
        $this->loadModel('States');
        $states = $this->States->find('list')->toArray();

        $this->paginate = [
            'contain' => ['Customers'],
            'conditions' => ['TalentReviews.talent_id' => $userId],
            'order' => ['TalentReviews.id' => 'DESC']
        ];
        $reviews = $this->paginate($this->TalentReviews);
        $this->paginate = [
            'contain' => ['Customers'],
            'conditions' => ['TalentRatings.talent_id' => $userId],
            'order' => ['TalentRatings.id' => 'DESC']
        ];
        $ratings = $this->paginate($this->TalentRatings);

        $this->set(compact('title', 'ratings', 'userInfo', 'reviews', 'states'));
        $this->viewBuilder()->setLayout('dashboard');
    }

    public function findServices() {
        $this->autoRender = false;
        $userId = $this->request->session()->read('Auth.User.id');

        if ($this->request->is('post')) {
            $serviceId = $this->request->data['service_id'];

            $this->loadModel('Eventsubcategories');
            $subCat = $this->Eventsubcategories->find('all', [
                        'contain' => ['TalentEventSubcategories' => ['conditions' => ['TalentEventSubcategories.user_id' => $userId]]],
                        'conditions' => ['Eventsubcategories.eventcategory_id' => $serviceId, 'Eventsubcategories.status' => 1]
                    ])->toArray();

            $data = '';
            foreach ($subCat as $cat) {
                if ($cat->talent_event_subcategories != null) {
                    $checked = "checked";
                } else {
                    $checked = "";
                }
                $data .= '<div class="col-md-6 col-lg-6">
                            <label for="sub_serive_' . $cat->id . '">
                                <input type="checkbox" name="sub_categories[]" id="sub_serive_' . $cat->id . '" value="' . $cat->id . '" ' . $checked . '>
                                ' . $cat->title . '
                            </label>

                        </div>';
            }

            echo json_encode(array($data));
        }
    }

    public function updateServices() {
        $this->autoRender = false;
        $userId = $this->request->session()->read('Auth.User.id');

        if ($this->request->is('post')) {
            $serviceId = $this->request->data['service_id'];
            $subServiceIds = $this->request->data['ids'];
            $idsArray = explode('_', $subServiceIds);
            $size = sizeof($idsArray);

            $dateTime = date('Y-m-d H:i:s');

            $conn = ConnectionManager::get('default');

            $queryCount = "SELECT COUNT(*) AS `count` FROM `talent_events` WHERE `user_id` = '$userId'";
            $resultCount = $conn->execute($queryCount);
            $rowCount = $resultCount->fetch('assoc');
            $count = $rowCount['count'];
            $success = 0;
            if ($count > 0) {
                $queryUpdate = "UPDATE `talent_events` SET `eventcategory_id` = '$serviceId', `modified` = '$dateTime' WHERE `user_id` = '$userId';";
                $resultUpdate = $conn->execute($queryUpdate);
                $success = 1;
            } else if ($count == 0) {
                $queryInsertService = "INSERT INTO `talent_events`(`user_id`, `eventcategory_id`, 
                `created`, `modified`) VALUES ('$userId', '$serviceId', '$dateTime', '$dateTime')";
                $resultInsertService = $conn->execute($queryInsertService);
                $success = 1;
            }

            $queryEventId = "SELECT `id` FROM `talent_events` WHERE `user_id` = '$userId';";
            $resultEventId = $conn->execute($queryEventId);
            $rowEventId = $resultEventId->fetch('assoc');
            $eventId = $rowEventId['id'];

            $queryDelete = "DELETE FROM `talent_event_subcategories` WHERE `user_id` = '$userId';";
            $resultDelete = $conn->execute($queryDelete);

            for ($serial = 0; $serial < $size - 1; $serial++) {
                $subServiceId = $idsArray[$serial];

                $queryInsertSubService = "INSERT INTO `talent_event_subcategories`(`user_id`,
                `talent_event_id`, `eventcategory_id`, `eventsubcategory_id`, `created`, `modified`)
                VALUES ('$userId', '$eventId', '$serviceId', '$subServiceId', '$dateTime', '$dateTime')";
                $resultInsertService = $conn->execute($queryInsertSubService);
                $success = 1;
            }

            echo $success;
        }
    }

    public function updateServicesDashboard() {
        $data = $_GET;

        $this->loadModel('TalentEvents');
        $this->loadModel('TalentEventSubcategories');
        $userId = $this->Auth->user('id');
        $this->loadModel('Users');
        $getUser = $this->Users->get($userId, [
            'contain' => ['Memberships']
        ]);
//        debug($getUser);
//        exit;
        if ($getUser) {
            $getUser->first_name = $data['first_name'];
            $getUser->last_name = $data['last_name'];
            $getUser->email = $data['email'];
            $getUser->phone1 = $data['phone'];
            $getUser->address1 = $data['address1'];
            $getUser->appartment = $data['appartment'];
            if ($this->Users->save($getUser)) {
                
            }
            $employee_member = $this->EmployeeMembers->find('all', ['conditions' => ['user_id' => $userId]])->first();
            $employee_member->description = $data['description'];
            if (isset($data['service_id'])) {
                $employee_member->eventcategory_id = $data['event_categories'];
                $serviceId = $data['service_id'];
            } else {
                $serviceId = 0;
            }
            $this->EmployeeMembers->save($employee_member);
            $message = array('flag' => 1, 'message' => "Infromation saved.");

            if ($serviceId > 0) {
                $service = $this->TalentEvents->get($serviceId);
                if ($service) {

                    $sub_cats = $this->TalentEventSubcategories->find('all', ['conditions' => ['talent_event_id' => $data['service_id']]])->toArray();
                    if ($sub_cats) {
                        $this->TalentEventSubcategories->deleteAll(['talent_event_id' => $data['service_id']]);
                    }
                    if (!empty($data['sub_categories'])) {
                        $service->eventcategory_id = $data['event_categories'];
                        $service->booking_requirement = $data['booking_requirement'];
                        $this->TalentEvents->save($service);

                        $save_data = array();
                        foreach ($data['sub_categories'] as $key => $sub):
                            $save_data[$key]['user_id'] = $userId;
                            $save_data[$key]['talent_event_id'] = $data['service_id'];
                            $save_data[$key]['eventcategory_id'] = $data['event_categories'];
                            $save_data[$key]['eventsubcategory_id'] = $sub;
                        endforeach;
                        if ($save_data) {
                            $savedata = $this->TalentEventSubcategories->newEntities($save_data);
                            if ($this->TalentEventSubcategories->saveMany($savedata)) {
                                $message = array('flag' => 1, 'message' => "Infromation saved.");
                            }
                        }
                    } else {
                        $message = array('flag' => 0, 'message' => "Please choose atleast one category");
                    }
                } else {
                    $message = array('flag' => 0, 'message' => "Record not found");
                }
            }

            echo json_encode($message);
            exit;
        }
    }

    public function findSubServices($from = null) {
        $userId = $this->request->session()->read('Auth.User.id');
        if ($from) {
            $this->loadModel('Eventsubcategories');
//            $sub = $this->Eventsubcategories->find('all', [
//                'contain' => ['TalentEventSubcategories' => ['conditions' => ['TalentEventSubcategories.user_id' => $userId]]],
//                'conditions' => ['Eventsubcategories.eventcategory_id' => $_POST['service_id'], 'Eventsubcategories.status' => 1]
//            ]);

            $subCat = $this->Eventsubcategories->find('all', [
                        'contain' => ['TalentEventSubcategories' => ['conditions' => ['TalentEventSubcategories.user_id' => $userId]]],
                        'conditions' => ['Eventsubcategories.eventcategory_id' => $_POST['service_id'], 'Eventsubcategories.status' => 1]
                    ])->toArray();

            $data = '';
            foreach ($subCat as $cat) {
                if ($cat->talent_event_subcategories != null) {
                    $checked = "checked";
                } else {
                    $checked = "";
                }
                $data .= '<div class="col-md-12 text-left my_checkbox">
                            <label for="sub_serive_' . $cat->id . '">
                                <input name="sub_categories[]" type="checkbox" id="sub_serive_' . $cat->id . '" value="' . $cat->id . '" ' . $checked . '>
                                ' . $cat->title . '
                            </label>

                        </div>';
            }


            echo json_encode($data);
            exit;
        }

        $this->autoRender = false;


        if ($this->request->is('post')) {

            $serviceId = $this->request->data['service_id'];

            $this->loadModel('Eventsubcategories');
            $subCat = $this->Eventsubcategories->find('all', [
                        'contain' => ['TalentEventSubcategories' => ['conditions' => ['TalentEventSubcategories.user_id' => $userId]]],
                        'conditions' => ['Eventsubcategories.eventcategory_id' => $serviceId, 'Eventsubcategories.status' => 1]
                    ])->toArray();

            $data = '';
            foreach ($subCat as $cat) {

                $data .= '<div class="col-md-5 col-lg-5 col-xl-5 form-group"> 
                                <label for="sub_serive_' . $cat->id . '">
                                    <input type="checkbox" name="sub_services[]" id="sub_serive_' . $cat->id . '" value="' . $cat->id . '"> ' . $cat->title . '
                                </label>
                            </div> ';
            }

            echo json_encode(array($data));
        }
    }

    public function ratings() {
        $this->loadModel('Bookings');
        $booking = $this->Bookings->get($_GET['booking_id']);

        $this->loadModel('CustomerRatings');
        $ifExists = $this->CustomerRatings->find('all', ['conditions' => ['booking_id' => $_GET['booking_id']]])->count();
        $response = array();
        if ($ifExists == 0) {
            $ratings = $this->CustomerRatings->newEntity();
            $arrayToSave = array();
            $arrayToSave['booking_id'] = $_GET['booking_id'];
            $arrayToSave['talent_id'] = $booking->talent_id;
            $arrayToSave['rate'] = $_GET['review'];
            $arrayToSave['customer_id'] = $booking->customer_id;
            $arrayToSave['talent_event_id'] = $booking->talent_event_id;
            $ratings = $this->CustomerRatings->patchEntity($ratings, $arrayToSave);

            if ($this->CustomerRatings->save($ratings)) {
                $response['flag'] = 1;
                $response['message'] = 'Thank you for your rating';
            } else {
                $response['flag'] = 0;
                $response['message'] = 'Sorry yor request cant not be completed';
            }
        } else {
            $response['flag'] = 0;
            $response['message'] = 'You have already rated this user';
        }
        echo json_encode($response);
        exit();
    }

    public function messages($bookingId = null) {
        $title = 'Message :: Welvet';
        $userId = $this->request->session()->read('Auth.User.id');
        $roleId = $this->request->session()->read('Auth.User.role_id');

        if ($roleId != 4) {
            return $this->redirect(['controller' => 'pages', 'action' => 'home']);
        }
        $this->loadModel('Users');
        $this->loadModel('TalentMessages');
        $this->loadModel('Bookings');

        $customerDiscussion = $this->Bookings->find('all', [
                    'contain' => ['Customers'],
                    'conditions' => ['Bookings.talent_id' => $userId, 'Bookings.status !=' => 1],
                    'order' => ['Bookings.id' => 'DESC']
                ])->toArray();

        if ($bookingId != null) {
            $booking_detail = $this->Bookings->get($bookingId);
            $customerInfo = $this->Bookings->find('all', [
                        'contain' => ['Customers'],
                        'conditions' => ['Bookings.id' => $bookingId, 'Bookings.status !=' => 1]
                    ])->toArray();

            if (count($customerInfo) > 0) {

                $talentCustomerMsgs = $this->TalentMessages->find('all', [
                            'contain' => ['Users'],
                            'conditions' => ['TalentMessages.booking_id' => $bookingId],
                            'order' => ['TalentMessages.id']
                        ])->toArray();
                TableRegistry::get('TalentMessages')->updateAll(
                        ["is_read" => 1], ["booking_id" => $bookingId, 'user_id !=' => $userId]
                );

                $this->set(compact('bookingId', 'booking_detail', 'customerInfo', 'talentCustomerMsgs'));
            }
        }

        if ($this->request->is('post')) {
            $message = $this->request->data['message'];
            $talentEventId = $this->request->data['talent_event_id'];
            $bId = $this->request->data['booking_id'];

            $sendMessage = $this->TalentMessages->newEntity();

            $this->request->data['TalentMessages']['user_id'] = $userId;
            $this->request->data['TalentMessages']['booking_id'] = $bId;
            $this->request->data['TalentMessages']['talent_event_id'] = $talentEventId;
            $this->request->data['TalentMessages']['message'] = $message;

            $sendMessage = $this->TalentMessages->patchEntity($sendMessage, $this->request->data['TalentMessages']);

            if ($this->TalentMessages->save($sendMessage)) {
//store log
                $this->loadModel('Logs');
                $this->loadModel('Users');
                $findRole = $this->Users->get($userId, [
                    'contain' => ['Roles']
                ]);
                $roleName = $findRole->role->name;

                $activity = 'Message Send';
                $note = $roleName . ' send a message.';
                $logs = $this->Logs->newEntity();
                $this->request->data['Log']['user_id'] = $userId;
                $this->request->data['Log']['activity'] = $activity;
                $this->request->data['Log']['note'] = $note;

                $logs = $this->Logs->patchEntity($logs, $this->request->data['Log']);

                if ($this->Logs->save($logs)) {
                    return $this->redirect(['action' => 'messages', $bId]);
                }
            }
        }
        $this->set(compact('title', 'customerDiscussion'));
        $this->viewBuilder()->setLayout('dashboard');
    }

    public function deleteService($id) {
        $this->loadModel('TalentEvents');
        $event = $this->TalentEvents->get($id, ['contain' => ['Bookings']]);
        if (!empty($event->bookings)) {
            $this->Flash->error(__('This service contain bookings so it can not be deleted.'));
            return $this->redirect(['controller' => 'EmployeeMembers', 'action' => 'services']);
        }

        if ($this->TalentEvents->delete($event)) {
//STORE LOGS
            $this->loadModel('Logs');

            $userId = $this->request->session()->read('Auth.User.id');
            $roleId = $this->request->session()->read('Auth.User.role_id');
            $this->loadModel('Users');
            $findRole = $this->Users->get($userId, [
                'contain' => ['Roles']
            ]);

            $roleName = $findRole->role->name;
            $activity = 'Service Deleted';
            $deletedUser = $event->id;
            $note = $findRole->first_name . ' ' . $findRole->last_name . '(' . $roleName . ') with user id (' . $findRole->id . ') has deleted the Employee Service with id (' . $deletedUser . ')';
            $logs = $this->Logs->newEntity();
            $this->request->data['Log']['user_id'] = $userId;
            $this->request->data['Log']['activity'] = $activity;
            $this->request->data['Log']['note'] = $note;

            $logs = $this->Logs->patchEntity($logs, $this->request->data['Log']);
            $this->Logs->save($logs);

            $this->Flash->success(__('The Service has been deleted.'));
            return $this->redirect(['controller' => 'EmployeeMembers', 'action' => 'services']);
        } else {
            $this->Flash->error(__('The Service could not be deleted. Please, try again.'));
        }
        return $this->redirect(['controller' => 'EmployeeMembers', 'action' => 'services']);
    }

    public function serviceVisibility($id = null, $status = null) {
        $events = TableRegistry::get('TalentEvents');
        $event = $events->get($id);

        if ($status == 'active') {
            $event->status = 1; //Active
            $message = 'The service will be Visible to users.';
        } else {
            $event->status = 0; //inactive
            $message = 'The service will be Invisible to users.';
        }

        if ($events->save($event)) {
//STORE LOGS
            $this->loadModel('Logs');

            $userId = $this->request->session()->read('Auth.User.id');
            $roleId = $this->request->session()->read('Auth.User.role_id');
            $this->loadModel('Users');
            $findRole = $this->Users->get($userId, [
                'contain' => ['Roles']
            ]);

            $roleName = $findRole->role->name;
            $activity = 'Service Status changed';
            $deletedUser = $event->id;
            $note = $findRole->first_name . ' ' . $findRole->last_name . '(' . $roleName . ') with user id (' . $findRole->id . ') has changed the status to(' . $status . ') of Employee Service with id (' . $deletedUser . ')';
            $logs = $this->Logs->newEntity();
            $this->request->data['Log']['user_id'] = $userId;
            $this->request->data['Log']['activity'] = $activity;
            $this->request->data['Log']['note'] = $note;

            $logs = $this->Logs->patchEntity($logs, $this->request->data['Log']);
            $this->Logs->save($logs);

            $this->Flash->success(__('The Staus of the service is changed. ' . $message));
            return $this->redirect(['controller' => 'EmployeeMembers', 'action' => 'services']);
        } else {
            $this->Flash->error(__('The Service status could not be changed. Please, try again.'));
        }
        return $this->redirect(['controller' => 'EmployeeMembers', 'action' => 'services']);
    }

    public function services() {
        $title = 'All Service :: Welvet';
        $this->loadModel('TalentEvents');

        if ($this->request->is(['patch', 'post', 'put'])) {

            $ifexists = $this->TalentEvents->find('all', ['conditions' => ['eventcategory_id' => $this->request->data['eventcategory_id'], 'user_id' => $this->Auth->user('id')]])->count();
            if ($ifexists == 0) {
                $talentEvent = $this->TalentEvents->newEntity();
                $new_talent_event = array();
//            $new_talent_event['amount'] = $this->request->data['amount'];
                $new_talent_event['user_id'] = $this->Auth->user('id');
                $new_talent_event['eventcategory_id'] = $this->request->data['eventcategory_id'];
                $new_talent_event['booking_requirement'] = $this->request->data['booking_requirement'];
//            debug($new_talent_event);exit();
                $talentEvent = $this->TalentEvents->patchEntity($talentEvent, $new_talent_event);
                if ($results = $this->TalentEvents->save($talentEvent)) {
                    $talentEventId = $results->id;
//                debug($talentEvent->id);exit();
                    $savedata = array();
                    foreach ($this->request->data['TalentEventSubcategories']['eventsubcategory_id'] as $k => $v):
                        $savedata[$k]['user_id'] = $this->Auth->user('id');
                        $savedata[$k]['talent_event_id'] = $talentEvent->id;
                        $savedata[$k]['eventcategory_id'] = $this->request->data['eventcategory_id'];
                        $savedata[$k]['eventsubcategory_id'] = $v;
                    endforeach;
//                 debug($savedata);exit();
                    $this->loadModel('TalentEventSubcategories');
                    $this->loadModel('TalentEventCities');
                    $this->TalentEventSubcategories->deleteAll(['talent_event_id' => $talentEvent->id]);
                    $subcategories = $this->TalentEventSubcategories->newEntities($savedata);
                    $result = $this->TalentEventSubcategories->saveMany($subcategories);

                    $eventCity = $this->TalentEventCities->newEntity();

                    $this->request->data['TalentEventCities']['talent_event_id'] = $talentEventId;

                    $this->request->data['TalentEventCities']['city'] = ucwords($this->request->session()->read('Auth.User.city'));
                    $this->request->data['TalentEventCities']['state_id'] = $this->request->session()->read('Auth.User.state');
                    $this->request->data['TalentEventCities']['accommodation_price'] = 0;
                    $eventCity = $this->TalentEventCities->patchEntity($eventCity, $this->request->data['TalentEventCities']);
                    $this->TalentEventCities->save($eventCity);


                    $this->Flash->success(__('New service has been created.'));
//debug($redirect);exit();
                    return $this->redirect('/EmployeeMembers/employeeFreeevents/' . $talentEventId);
                }
            }else {
                $this->Flash->error(__('You already have this service.'));
                return $this->redirect('/EmployeeMembers/services');
            }
//            $this->Flash->error(__('The talent event could not be saved. Please, try again.'));
        }

        $userId = $this->Auth->user('id');
        $talent_events = $this->TalentEvents->find('all', [
                    'contain' => [
                        'TalentEventSubcategories', 'Users', 'Eventcategories'],
                    'conditions' => ['TalentEvents.user_id' => $this->Auth->user('id'), 'TalentEvents.deleted' => 0]
                ])->toArray();

        $this->loadModel('Users');
        $user = $this->Users->get($this->Auth->user('id'));
        $this->loadModel('States');
        $states = $this->States->find('list')->toArray();
        $categories = $this->Eventcategories->find('list')->toArray();
        $subcategories = $this->Eventsubcategories->find('list')->toArray();
//        debug($subcategories);
//        exit();
        $this->set(compact('title', 'categories', 'talent_events', 'user', 'states', 'subcategories'));

        $categories = $this->Eventcategories->find('list')->toArray();
        $this->viewBuilder()->setLayout('dashboard');
    }

    public function addserviceEvents() {

        $title = 'Add Service Event:: Welvet';

        if ($this->request->is('post')) {
            $bookings = TableRegistry::get('Bookings');
            $booking = $bookings->get($this->request->data['booking_id']);
            if (isset($this->request->data['decline'])) {
                $booking->status = 1;
            }
            if (isset($this->request->data['accept'])) {
                $booking->status = 2;
            }
            if ($bookings->save($booking)) {
                $this->Flash->success(__('booking saved.'));
                return $this->redirect('/EmployeeMembers/employee_events');
            }
        }
        $id = $this->Auth->user('id');
        $this->loadModel('Users');
        $user = $this->Users->get($id, ['contain' => ['EmployeeMembers', 'EmployeeMembers.Eventcategories.Eventsubcategories', 'Memberships', 'TalentEventSubcategories']]);
        $this->loadModel('Bookings');

        $this->paginate = [
            'contain' => ['TalentEvents', 'Customers', 'CustomerReviews' => function($r)use ($id) {
                    $r->select([
                        'talent_event_id',
                        'review',
                        'talent_id'
                    ])->where(['CustomerReviews.talent_id' => $id]);
                    return $r;
                }],
            'conditions' => ['Bookings.talent_id' => $id]
        ];
        $bookings = $this->paginate($this->Bookings);


        $this->set(compact('title', 'user', 'bookings'));
        $this->viewBuilder()->setLayout('dashboard');
    }

    public function dashboardpro() {
        $this->autoRender = false;

        if ($this->request->is('post')) {

            $conn = ConnectionManager::get('default');
            $role = 4;
            $condition = 'roles.id="' . $role . '"';

            $service_id = $this->request->data['service_id'];
            $subservice = $this->request->data['subservice'];
            $userId = $this->request->session()->read('Auth.User.id');

//$search=str_replace(" ", "", $text);
            $condition .= ' AND 	talent_event_subcategories.eventcategory_id="' . $service_id . '" AND talent_event_subcategories.eventsubcategory_id="' . $subservice . '" AND talent_event_subcategories.user_id="' . $userId . '" LIMIT 1';




            $query = $conn->execute('SELECT talent_event_subcategories.talent_event_id,talent_event_subcategories.eventcategory_id,talent_event_subcategories.eventsubcategory_id,talent_event_subcategories.user_id'
                    . ' FROM roles '
                    . 'left join users  ON roles.id=users.role_id '
                    . 'left  join employee_members  ON users.id=employee_members.user_id '
                    . 'left  join talent_event_subcategories  ON users.id=talent_event_subcategories.user_id '
                    . 'left  join eventcategories  ON eventcategories.id=talent_event_subcategories.eventcategory_id '
                    . 'left  join eventsubcategories  ON eventsubcategories.id=talent_event_subcategories.eventsubcategory_id '
                    . 'left  join talent_events ON talent_events.id=talent_event_subcategories.talent_event_id '
//. 'left  join talent_calenders ON talent_events.id=talent_event_subcategories.talent_event_id '
                    . 'where ' . $condition);

            $city_event = $query->fetchAll('assoc');
//debug($city_event[0]['talent_event_id']);
            if (!empty($city_event[0]['talent_event_id']) && !empty($city_event[0]['eventcategory_id']) && !empty($city_event[0]['eventcategory_id'])) {
                $event_id = $city_event[0]['talent_event_id'];
                $eventcat_id = $city_event[0]['eventcategory_id'];
                $eventsubcat_id = $city_event[0]['eventsubcategory_id'];

                return $this->redirect(['controller' => 'EmployeeMembers', 'action' => 'employeeFreeevents', 'catid' => $eventcat_id, 'subcatid' => $eventsubcat_id, 'talentid' => $event_id]);
            } else {

                $this->loadModel('TalentEvents');
                $talentevent = $this->TalentEvents->newEntity();
                $userId = $this->request->session()->read('Auth.User.id');

                $this->request->data['TalentEvents']['eventcategory_id'] = $service_id;

                $this->request->data['TalentEvents']['user_id'] = $userId;
                $eventcategory = $this->TalentEvents->patchEntity($talentevent, $this->request->data['TalentEvents']);
//debug($service_id);
                if ($this->TalentEvents->save($eventcategory)) {
                    $this->loadModel('TalentEventSubcategories');
                    $talentevent_id = $talentevent->id;

                    $eventsubcategory = $this->TalentEventSubcategories->newEntity();

                    $this->request->data['TalentEventSubcategories']['user_id'] = $userId;
                    $this->request->data['TalentEventSubcategories']['talent_event_id'] = $talentevent_id;
                    $this->request->data['TalentEventSubcategories']['eventcategory_id'] = $service_id;
                    $this->request->data['TalentEventSubcategories']['eventsubcategory_id'] = $subservice;
                    $eventsubcategory = $this->TalentEventSubcategories->patchEntity($eventsubcategory, $this->request->data['TalentEventSubcategories']);

                    $this->TalentEventSubcategories->save($eventsubcategory);
                    return $this->redirect(['controller' => 'EmployeeMembers', 'action' => 'employeeFreeevents', 'catid' => $service_id, 'subcatid' => $subservice, 'talentid' => $talentevent_id]);
                    exit;
                }
                $this->Flash->error(__('The data could not be saved. Please, try again.'));
            }
        }
    }

    public function deleteAccoCity() {
        $this->autoRender = false;
        if ($this->request->is('post')) {
            $id = $this->request->data['id'];
            $conn = ConnectionManager::get('default');
            $query = $conn->execute("SELECT `talent_event_id` FROM `talent_event_cities` WHERE `id` = '$id'");
            $result = $query->fetch('assoc');
            $talentEventId = $result['talent_event_id'];

            $queryCount = $conn->execute("SELECT COUNT(*) AS `count` FROM `talent_event_cities` WHERE `talent_event_id` = '$talentEventId'");
            $resultCount = $queryCount->fetch('assoc');
            $count = $resultCount['count'];

            if ($count > 1) {

                $queryDeleteCity = $conn->execute("DELETE FROM `talent_event_cities` WHERE `id` = '$id'");

                $queryCities = $conn->execute("SELECT `id`, `city`, `accommodation_price` FROM `talent_event_cities`
            WHERE `talent_event_id` = '$talentEventId'");
                $resultCities = $queryCities->fetchAll('assoc');

                $data = '';
                foreach ($resultCities as $city) {
                    $data = $data . '<tr style="">
                                            <td style="width:60px;">' . $city['city'] . '</td>
                                            <td style="width:60px;">' . $city['accommodation_price'] . '</td>
                                            <td style="width:60px;">
                                                <input type="hidden" class="event_city_id" value="' . $city['id'] . '">
                                                <i class="fa fa-trash-o delete_acco_city cities_links"></i>
                                                <i class="fa fa-edit cities_links" onclick="edit_city(' . $city['id'] . ')"></i>
</td>
</tr>';
                }

                echo json_encode(array('success', $data));
            } else {
                echo json_encode(array('error'));
            }
        }
    }

    public function profile() {

        $userId = $this->request->session()->read('Auth.User.id');
        $title = 'Profile :: Welvet';
        $this->loadModel('Users');
        $userInfo = $this->Users->get($userId, ['contain' => ['TalentEvents' => ['Eventcategories'], 'EmployeeMembers', 'EmployeeMembers.Eventcategories.Eventsubcategories', 'Memberships', 'TalentEventSubcategories']]);
//        debug($userInfo);
        if ($userInfo->role_id != 4) {
            return $this->redirect(['controller' => 'pages', 'action' => 'home']);
        }

        $this->set(compact('title', 'userInfo'));
        $this->viewBuilder()->setLayout('dashboard');
    }

}
