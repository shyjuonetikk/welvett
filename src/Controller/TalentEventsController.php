<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Mailer\Email;
use Cake\Datasource\ConnectionManager;

/**
 * TalentEvents Controller
 *
 * @property \App\Model\Table\TalentEventsTable $TalentEvents
 *
 * @method \App\Model\Entity\TalentEvent[] paginate($object = null, array $settings = [])
 */
class TalentEventsController extends AppController {

    public function isAuthorized($user) {
        return true;

        if (in_array($this->request->action, ['viewevents'])) {
            $id = (int) $this->request->params['pass'][0];
            if ($id == $user['id']) {
                return true;
            }
        }
        if (in_array($this->request->action, ['logout'])) {
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
        $talentEvents = $this->paginate($this->TalentEvents);

        $this->set(compact('talentEvents'));
        $this->set('_serialize', ['talentEvents']);
    }

    public function viewevents($user_id = null) {
        $this->set('content_title', 'Talent Services');

        $permission = $this->viewVars['actionPermission'];
        if ($permission == 1 || $permission == 2) {
            
        } else {
            return $this->redirect(['controller' => 'Pages', 'action' => 'welcome']);
        }
        $this->viewBuilder()->layout('backend');
        $this->paginate = [
            'contain' => ['Users', 'Eventcategories', 'TalentEventCities', 'TalentEventSubcategories', 'TalentEventSubcategories.Eventsubcategories', 'Bookings' => function($q) {
                    $q->select([
                                'Bookings.talent_event_id',
                                'total' => $q->func()->count('Bookings.talent_event_id')
                            ])
                            ->group(['Bookings.talent_event_id']);

                    return $q;
                }],
            'conditions' => ['TalentEvents.user_id' => $user_id, 'TalentEvents.deleted' => 0]
        ];
        $talentEvents = $this->paginate($this->TalentEvents);

        $this->set(compact('talentEvents', 'permission'));
    }

    public function getPayments() {
        $this->loadModel('Payments');
        $payment = $this->Payments->get($_GET['payment_id']);
        $user = '';
        if ($payment->released_by) {

//            debug($this->Auth->user('id'));exit;
            $this->loadModel('Users');
            $user = $this->Users->get($payment->released_by);
        }
        $this->set(compact('payment', 'user'));
        $this->viewBuilder()->layout('');
    }

    public function paymentApprove() {
        if ($this->request->is('post')) {
            $status = $this->request->data['status'];
            $id = $this->request->data['payment'];
            $admin_decision = $this->request->data['admin_decision'];

            $this->loadModel('Payments');
            $payment = $this->Payments->get($id, ['contain' => ['Bookings' => ['customers', 'talents']]]);
            $payment->admin_decision = $admin_decision;
            $message = '';
            if ($status == 'approve') {
                // save payment info
                $payment->status = 1; //released amount
                $payment->released_by = $this->Auth->user('id'); //User id
                $payment->deducted_amount = ($payment->total_amount / 100 ) * $this->welvettCommission; //User id
                $payment->released_amount = $payment->total_amount - $payment->deducted_amount; //User id
                //$payment->released_from = '';
                //$payment->released_to = '';
                $payment->dispute_resolved = 1; //Dispute resolved


                if ($this->Payments->save($payment)) {
                    $this->loadModel('TalentEvents');
                    $t_e = $this->TalentEvents->get($payment->booking->talent_event_id, ['contain' => ['Eventcategories']]);
                    $message = 'The Despute on ' . $t_e->eventcategory->title . ' Event has been resolved Kindly check your email.';
                }
            } elseif ($status == 'role_back') {
                $payment->status = 2; // 2 refunded
                $payment->dispute_resolved = 1; //Dispute resolved

                if ($this->Payments->save($payment)) {
                    $this->loadModel('TalentEvents');
                    $t_e = $this->TalentEvents->get($payment->booking->talent_event_id, ['contain' => ['Eventcategories']]);
                    $message = 'The Despute on ' . $t_e->eventcategory->title . ' Event has been resolved Kindly check your email.';
                }
            } else {
                $this->Flash->error('Invalid Status');
            }

            if ($message) {
                // create notification
                $this->loadModel('Notifications');
                $notification = $this->Notifications->newEntity();
                $notification_array = array();
                $notification_array['booking_id'] = $payment->booking->id;
                $notification_array['talent_id'] = $payment->Talents['id'];
                $notification_array['customer_id'] = $payment->Customers['id'];
                $notification_array['activity_by'] = $this->Auth->user('id');
                $notification_array['message'] = $message;
                $notification = $this->Notifications->patchEntity($notification, $notification_array);
                $this->Notifications->save($notification);

                // send emails
                $user = $payment->Customers;
                $talent = $payment->Talents;

                $this->loadModel('Users');
                $alertEmails = $this->Users->find('all', ['conditions' => ['role_id' => 1]])->toArray();

                //send mail to Customer
                $emailToCust = new Email();
                $emailToCust->template('dispute_resolved')->emailFormat('html')->to($user['email'])->from(['info@cyberclouds.com' => 'welvett.com'])->subject('Payment dispute resolved')->viewVars(['content' => $user, 'talent' => $talent, 'status' => $status, 'admin_decision' => $admin_decision])->send();

                //send mail to Talent
                $emailToTalent = new Email();
                $emailToTalent->template('dispute_resolved')->emailFormat('html')->to($user['email'])->from(['info@cyberclouds.com' => 'welvett.com'])->subject('Payment dispute resolved')->viewVars(['content' => $talent, 'customer' => $user, 'status' => $status, 'admin_decision' => $admin_decision])->send();


                //sending mails to Super admins
                foreach ($alertEmails as $sendMail):
                    $email = new Email();
                    $email->template('dispute_resolved')->emailFormat('html')->to($sendMail->email)->from(['info@cyberclouds.com' => 'welvett.com'])->subject('Payment dispute resolved')->viewVars(['content' => $sendMail, 'customer' => $user, 'talent' => $talent, 'status' => $status, 'admin_decision' => $admin_decision])->send();
                endforeach;
            }

            return $this->redirect(['action' => 'viewbookings', $payment->booking->talent_event_id, $payment->booking->talent_id]);
        }
    }

    public function viewbookings($user_id = null, $redirect = null) {
        $this->set('content_title', 'Talent Bookings');

        $permission = $this->viewVars['actionPermission'];
        if ($permission == 1 || $permission == 2) {
            
        } else {
            return $this->redirect(['controller' => 'Pages', 'action' => 'welcome']);
        }
        $this->viewBuilder()->layout('backend');
        $this->loadModel('Bookings');
        $this->paginate = [
            'contain' => ['Payments', 'Talents', 'Customers', 'TalentMessages' => function($q) {
                    $q->select([
                                'TalentMessages.booking_id',
                                'total' => $q->func()->count('TalentMessages.talent_event_id')
                            ])
                            ->group(['TalentMessages.booking_id']);

                    return $q;
                }],
            'conditions' => ['Bookings.talent_event_id' => $user_id]
        ];
        $talentEvents = $this->paginate($this->Bookings);

        $this->set(compact('talentEvents', 'permission'));
    }

    public function allBookings($user_id = null, $redirect = null) {
        $this->set('content_title', 'Talent Bookings');

        $permission = $this->viewVars['actionPermission'];
        if ($permission == 1 || $permission == 2) {
            
        } else {
            return $this->redirect(['controller' => 'Pages', 'action' => 'welcome']);
        }
        $this->viewBuilder()->layout('backend');
        $conditions = '';
        if (isset($_GET['status'])) {
            if ($_GET['status'] == 'all_disputes') {
                $conditions = array('OR' => array('Payments.customer_issues IS NOT NULL', 'Payments.talent_issues IS NOT NULL'));
            }
            if ($_GET['status'] == 'pending_disputes') {
                $conditions = array('Payments.dispute_resolved IS NULL', 'OR' => array('Payments.customer_issues IS NOT NULL', 'Payments.talent_issues IS NOT NULL'));
            }
        }

        $this->loadModel('Bookings');
        $this->paginate = [
            'contain' => ['Payments', 'Talents', 'Customers'],
            'conditions' => $conditions
        ];
        $talentEvents = $this->paginate($this->Bookings);
//        debug($talentEvents);
//        exit;
        $this->set(compact('talentEvents', 'permission'));
    }

    public function reports() {
        $this->set('content_title', 'Reports');

        $permission = $this->viewVars['actionPermission'];
        if ($permission == 1 || $permission == 2) {
            
        } else {
            return $this->redirect(['controller' => 'Pages', 'action' => 'welcome']);
        }
        $this->viewBuilder()->layout('backend');
        $conditions2 = '';
        if (isset($_GET['search'])) {
            $conditions2 = ' WHERE talent_events.deleted=0 ';
            if (!empty($_GET['status'])) {
                if ($_GET['status'] == 'all_disputes') {
                    $conditions2 .= ' AND (payments.customer_issues IS NOT NULL OR payments.talent_issues IS NOT NULL)';
                }
                if ($_GET['status'] == 'pending_disputes') {
                    $conditions2 .= ' AND Payments.dispute_resolved IS NULL AND (payments.customer_issues IS NOT NULL OR payments.talent_issues IS NOT NULL)';
                }
            }
            if (!empty($_GET['categories'])) {
                $conditions2 .= ' AND talent_events.eventcategory_id=' . $_GET['categories'];
            }
            if (!empty($_GET['event_type'])) {
                $conditions2 .= ' AND bookings.event_type=' . $_GET['event_type'];
            }
            if (!empty($_GET['name'])) {
                $conditions2 .= ' AND (talents.first_name like "%' . $_GET['name'] . '%" OR talents.last_name like "%' . $_GET['name'] . '%" OR customers.first_name like "%' . $_GET['name'] . '%" OR customers.last_name like "%' . $_GET['name'] . '%")';
            }
            if (!empty($_GET['from_time']) && !empty($_GET['to_time'])) {
                $_GET['from_time'] = str_replace('-', '/', $_GET['from_time']);
                $_GET['to_time'] = str_replace('-', '/', $_GET['to_time']);
                $conditions2 .= ' AND (bookings.from_date  BETWEEN "' . date('Y-m-d', strtotime($_GET['from_time'])) . '" AND "' . date('Y-m-d', strtotime($_GET['to_time'])) . '" OR bookings.to_date  BETWEEN "' . date('Y-m-d', strtotime($_GET['from_time'])) . '" AND "' . date('Y-m-d', strtotime($_GET['to_time'])) . '")';
            }
        }
        $this->loadModel('Eventcategories');
        $cats = $this->Eventcategories->find('list')->toArray();

        $conn = ConnectionManager::get('default');
        $query = $conn->execute('SELECT bookings.status,bookings.id as booking_id,CONCAT(talents.first_name, " " ,talents.last_name) as talent_name,CONCAT(customers.first_name, " ",customers.last_name) as customer_name,talents.id as talent_id,customers.id as customer_id, payments.total_amount,payments.deducted_amount,payments.released_amount,payments.released_by,payments.customer_issues,payments.talent_issues '
                . ' FROM bookings '
                . 'JOIN users AS talents ON bookings.talent_id=talents.id '
                . 'JOIN users AS customers ON bookings.customer_id=customers.id '
                . 'LEFT JOIN payments AS payments ON bookings.id=payments.booking_id '
                . 'JOIN talent_events AS talent_events ON bookings.talent_event_id=talent_events.id '
                . $conditions2 . ' GROUP BY bookings.id'
        );
        $talentEvents = $query->fetchAll('assoc');
//        debug($talentEvents);
//        exit;
//        $this->loadModel('Bookings');
//        $talentEvents = $this->Bookings->find('all')
//                ->contain(['Payments', 'TalentEvents', 'Talents', 'Customers'])
//                ->where($conditions)
//                ->toArray();
        $this->loadModel('Users');

        $users_list = $this->Users->find('list', ['contain' => 'Roles', "keyField" => "id", 'valueField' => function ($row) {
                        return $row['first_name'] . ' ' . $row['last_name'];
                    }])->toArray();

        $this->set(compact('talentEvents', 'permission', 'cats', 'users_list'));
    }

    public function bookings($user_id = null, $redirect = null) {
        $permission = $this->viewVars['actionPermission'];
        if ($permission == 1 || $permission == 2) {
            
        } else {
            return $this->redirect(['controller' => 'Pages', 'action' => 'welcome']);
        }
        $this->loadModel('Users');
        $user = $this->Users->get($user_id);
        if ($user->role_id == 4) {
            $roleName = 'Talent';
            $field = 'talent_id';
        }
        if ($user->role_id == 3) {
            $roleName = 'Corporate';
            $field = 'customer_id';
        }
        if ($user->role_id == 2) {
            $roleName = 'Individual';
            $field = 'customer_id';
        }
        $contentText = 'Booking of ' . ucwords($user->first_name . ' ' . $user->last_name) . ' <small>(' . $roleName . ')</small>';
        $this->set('content_title', $contentText);

        $this->viewBuilder()->layout('backend');

        $this->loadModel('Bookings');
        $this->paginate = [
            'contain' => ['Payments', 'Talents', 'Customers'],
            'conditions' => [$field => $user_id]
        ];
        $talentEvents = $this->paginate($this->Bookings);

        $this->set(compact('talentEvents', 'permission'));
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

    public function fetchCity() {
        $this->loadModel('TalentEventCities');
        $city = $this->TalentEventCities->get($_GET['city_id'], ['fields' => ['id', 'city', 'accommodation_price']])->toArray();
        echo json_encode($city);
        exit();
    }

    public function fetchCategory() {
        $this->viewBuilder()->layout('');
        $this->loadModel('TalentEventSubcategories');
        $city = $this->TalentEventSubcategories->get($_GET['id'], ['contain' => [
                        'Users', 'TalentEvents', 'Eventcategories', 'Eventsubcategories'
            ]])->toArray();

        $this->set('category', $city);
    }

    public function getCategories() {
        $this->viewBuilder()->layout('');
        $this->loadModel('Eventcategories');
        $categories = $this->Eventcategories->find('list')->toArray();
        echo json_encode($categories);
        exit();
    }

    public function getTelentService() {
        $this->viewBuilder()->layout('');
        $this->loadModel('TalentEvents');
        $this->loadModel('TalentEventsubcategories');

        $t_event = $this->TalentEvents->get($_GET['service_id'], ['contain' => ['TalentEventsubcategories', 'EventCategories']]);
        $sub_cats = $this->Eventsubcategories->find('list', ['conditions' => ['eventcategory_id' => $t_event->eventcategory_id]])->toArray();
        $categories = $this->Eventcategories->find('list')->toArray();
        //        debug($t_event);exit;
        $my_cats = array();
        foreach ($t_event->talent_event_subcategories as $s):
            array_push($my_cats, $s->eventsubcategory_id);
        endforeach;
        //        debug();exit();
        $this->set(compact('sub_cats', 'my_cats', 'categories', 't_event'));
    }

    public function getSubcategories() {
        $this->viewBuilder()->layout('');
        $userId = $this->request->session()->read('Auth.User.id');
        $this->loadModel('Eventsubcategories');
        $categories = $this->Eventsubcategories->find('list')
                ->where(['Eventcategory_id' => $_GET['cat_id']])
                ->toArray();
        $catId = $_GET['cat_id'];
        $t_event = $this->TalentEvents->find('all', [
                    'conditions' => ['TalentEvents.eventcategory_id' => $catId, 'TalentEvents.user_id' => $userId]
                ])->first();

        $this->set('categories', $categories);
        $this->set('t_event', $t_event);
    }

    public function fetchSubcategories() {
        $this->viewBuilder()->layout('');
        $this->loadModel('TalentEvents');
        $this->loadModel('TalentEventsubcategories');

        $t_event = $this->TalentEvents->get($_GET['service_id'], ['contain' => ['TalentEventsubcategories', 'EventCategories']]);
        $sub_cats = $this->Eventsubcategories->find('list', ['conditions' => ['eventcategory_id' => $t_event->eventcategory_id]])->toArray();

        $my_cats = array();
        foreach ($t_event->talent_event_subcategories as $s):
            array_push($my_cats, $s->eventsubcategory_id);
        endforeach;
        $this->set(compact('sub_cats', 'my_cats'));
    }

    public function messages($event_id = null) {
        $permission = $this->viewVars['actionPermission'];
        if ($permission == 1 || $permission == 2) {
            
        } else {
            return $this->redirect(['controller' => 'Pages', 'action' => 'welcome']);
        }
        $this->set('content_title', 'Event Disccusion');
        $this->viewBuilder()->layout('backend');
        $this->loadModel('TalentMessages');
        $this->paginate = [
            'contain' => ['Users', 'TalentEvents'],
            'conditions' => ['booking_id' => $event_id],
            'order' => ['id' => 'DESC'],
            'limit' => 10
        ];

        $talentmessages = $this->paginate($this->TalentMessages);
        $this->set(compact('permission'));
        $this->set('messages', $talentmessages);
    }

    public function fetchMessages() {
        $this->viewBuilder()->layout('');
        $this->loadModel('TalentMessages');
        $this->paginate = [
            'contain' => ['Users', 'TalentEvents'],
            'conditions' => ['booking_id' => $_GET['id']],
            'order' => ['id' => 'DESC'],
            'limit' => 10
        ];

        $talentmessages = $this->paginate($this->TalentMessages);
        //debug($talentmessages);exit();
        $this->set('messages', $talentmessages);
    }

    public function editCity() {
        $cities = TableRegistry::get('TalentEventCities');
        $city = $cities->get($_GET['id']);
        $city->city = $_GET['city'];
        $city->accommodation_price = $_GET['accommodation_price'];

        if ($cities->save($city)) {
            echo json_encode($_GET);
        } else {
            echo 'error';
        }
        exit();
    }

    public function editMsg() {
        $cities = TableRegistry::get('TalentMessages');
        $city = $cities->get($_GET['id']);
        $city->message = $_GET['message'];
        if ($cities->save($city)) {
            echo json_encode($_GET);
        } else {
            echo 'error';
        }
        exit();
    }

    /**
     * View method
     *
     * @param string|null $id Talent Event id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        $talentEvent = $this->TalentEvents->get($id, [
            'contain' => ['Users', 'Eventcategories', 'Bookings', 'CustomerReviews', 'TalentCalendars', 'TalentEventCities', 'TalentMessages', 'TalentReviews']
        ]);

        $this->set('talentEvent', $talentEvent);
        $this->set('_serialize', ['talentEvent']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $talentEvent = $this->TalentEvents->newEntity();
        if ($this->request->is('post')) {
            $talentEvent = $this->TalentEvents->patchEntity($talentEvent, $this->request->getData());
            if ($this->TalentEvents->save($talentEvent)) {
                $this->Flash->success(__('The talent event has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The talent event could not be saved. Please, try again.'));
        }
        $users = $this->TalentEvents->Users->find('list', ['limit' => 200]);
        $eventcategories = $this->TalentEvents->Eventcategories->find('list', ['limit' => 200]);
        $this->set(compact('talentEvent', 'users', 'eventcategories'));
        $this->set('_serialize', ['talentEvent']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Talent Event id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $talentEvent = $this->TalentEvents->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {

            $talentEvent = $this->TalentEvents->patchEntity($talentEvent, $this->request->getData());
            if ($this->TalentEvents->save($talentEvent)) {
                $this->Flash->success(__('The talent event has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The talent event could not be saved. Please, try again.'));
        }
        $users = $this->TalentEvents->Users->find('list', ['limit' => 200]);
        $eventcategories = $this->TalentEvents->Eventcategories->find('list', ['limit' => 200]);
        $this->set(compact('talentEvent', 'users', 'eventcategories'));
        $this->set('_serialize', ['talentEvent']);
    }

    public function eventEditFrontend($id = null) {
        if ($this->request->is(['patch', 'post', 'put'])) {
            $id = $this->request->data['id'];
            unset($this->request->data['id']);
            $userId = $this->Auth->user('id');
            $talentEvent = $this->TalentEvents->find('all', [
                        'conditions' => ['id !=' => $id, 'eventcategory_id' => $this->request->data['TalentEvent']['eventcategory_id'], 'user_id' => $userId]
                    ])->count();
            if ($talentEvent) {

                $this->Flash->error(__('Sorry you already have this service.'));
                return $this->redirect('/EmployeeMembers/services');
            }

            $talentEvent = $this->TalentEvents->get($id, [
                'contain' => ['Users', 'TalentEventSubcategories', 'TalentEventSubcategories.Eventcategories', 'TalentEventSubcategories.Eventsubcategories']
            ]);

            $talentEvent = $this->TalentEvents->patchEntity($talentEvent, $this->request->data['TalentEvent']);
            if ($this->TalentEvents->save($talentEvent)) {
                $savedata = array();
                foreach ($this->request->data['TalentEventSubcategories']['eventsubcategory_id'] as $k => $v):
                    $savedata[$k]['user_id'] = $talentEvent->user->id;
                    $savedata[$k]['talent_event_id'] = $talentEvent->id;
                    $savedata[$k]['eventcategory_id'] = $this->request->data['TalentEvent']['eventcategory_id'];
                    $savedata[$k]['eventsubcategory_id'] = $v;
                endforeach;
                //                 debug($savedata);exit();
                $this->loadModel('TalentEventSubcategories');
                $this->TalentEventSubcategories->deleteAll(['talent_event_id' => $talentEvent->id]);
                $subcategories = $this->TalentEventSubcategories->newEntities($savedata);
                $result = $this->TalentEventSubcategories->saveMany($subcategories);

                $this->Flash->success(__('Your service has been edited.'));
                //debug($redirect);exit();
                return $this->redirect('/EmployeeMembers/services');
            }
            //            $this->Flash->error(__('The talent event could not be saved. Please, try again.'));
        }
        echo "Internal Server Error";
        exit();
    }

    public function eventedit($id = null, $redirect = null) {
        $this->viewBuilder()->layout('backend');
        $this->set('content_title', 'Edit Talent Event');
        $this->loadModel('Eventcategories');
        $talentEvent = $this->TalentEvents->get($id, [
            'contain' => ['Users', 'TalentEventSubcategories', 'TalentEventSubcategories.Eventcategories', 'TalentEventSubcategories.Eventsubcategories']
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {
            //debug($this->request->data['TalentEvent']['eventcategory_id']);exit();
            $talentEvent = $this->TalentEvents->patchEntity($talentEvent, $this->request->data['TalentEvent']);
            if ($this->TalentEvents->save($talentEvent)) {
                $savedata = array();
                foreach ($this->request->data['TalentEventSubcategories']['eventsubcategory_id'] as $k => $v):
                    $savedata[$k]['user_id'] = $talentEvent->user->id;
                    $savedata[$k]['talent_event_id'] = $talentEvent->id;
                    $savedata[$k]['eventcategory_id'] = $this->request->data['TalentEvent']['eventcategory_id'];
                    $savedata[$k]['eventsubcategory_id'] = $v;
                endforeach;
                //                 debug($savedata);exit();
                $this->loadModel('TalentEventSubcategories');
                $this->TalentEventSubcategories->deleteAll(['talent_event_id' => $talentEvent->id]);
                $subcategories = $this->TalentEventSubcategories->newEntities($savedata);
                $result = $this->TalentEventSubcategories->saveMany($subcategories);

                $this->Flash->success(__('The talent event has been saved.'));
                //debug($redirect);exit();
                return $this->redirect('/TalentEvents/viewevents/' . $redirect);
            }
            //            $this->Flash->error(__('The talent event could not be saved. Please, try again.'));
        }
        $this->loadModel('Eventsubcategories');
        $this->loadModel('TalentEventsubcategories');
        $eventcategories = $this->TalentEvents->Eventcategories->find('list', ['limit' => 200]);
        $eventsubcategories = $this->Eventsubcategories->find('list', ['conditions' => ['eventcategory_id' => $talentEvent->eventcategory_id], 'limit' => 200]);
        $talenteventsubcategories = $this->TalentEventsubcategories->find('list', ['conditions' => ['talent_event_id' => $talentEvent->id], 'keyField' => 'id', 'valueField' => 'eventsubcategory_id', 'limit' => 200])->toArray();
        $this->set(compact('talentEvent', 'users', 'eventcategories', 'eventsubcategories', 'talenteventsubcategories'));
        $this->set('_serialize', ['talentEvent']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Talent Event id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function deleteEvent($id = null, $redirect = null) {

        $permission = $this->viewVars['actionPermission'];
        if ($permission == 2) {
            
        } else {
            return $this->redirect(['controller' => 'Pages', 'action' => 'welcome']);
        }
        $this->set(compact('permission'));

        $this->request->allowMethod(['post', 'delete', 'get']);
        $events = TableRegistry::get('TalentEvents');
        $event = $events->get($id);
        $event->deleted = 1;
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
            $activity = 'User Deleted';
            $deletedUser = $event->id;
            $note = $roleName . ' deleted the Employee Event (' . $deletedUser . ')';
            $logs = $this->Logs->newEntity();
            $this->request->data['Log']['user_id'] = $userId;
            $this->request->data['Log']['activity'] = $activity;
            $this->request->data['Log']['note'] = $note;

            $logs = $this->Logs->patchEntity($logs, $this->request->data['Log']);

            if ($this->Logs->save($logs)) {
                $this->Flash->success(__('The user has been deleted.'));
                return $this->redirect(['controller' => 'TalentEvents', 'action' => 'viewevents', $redirect]);
            } else {
                $this->Flash->success(__('The user has been deleted.'));
                return $this->redirect(['controller' => 'TalentEvents', 'action' => 'viewevents', $redirect]);
            }
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }
        return $this->redirect(['controller' => 'TalentEvents', 'action' => 'viewevents', $redirect]);
    }

    public function deleteMessage($id = null, $redirect = null) {

        $permission = $this->viewVars['actionPermission'];
        if ($permission == 2) {
            
        } else {
            return $this->redirect(['controller' => 'Pages', 'action' => 'welcome']);
        }
        $this->set(compact('permission'));

        $this->request->allowMethod(['post', 'delete', 'get']);
        $this->loadModel('TalentMessages');
        $message = $this->TalentMessages->get($id);

        if ($this->TalentMessages->delete($message)) {
            //STORE LOGS
            $this->loadModel('Logs');

            $userId = $this->request->session()->read('Auth.User.id');
            $roleId = $this->request->session()->read('Auth.User.role_id');
            $this->loadModel('Users');
            $findRole = $this->Users->get($userId, [
                'contain' => ['Roles']
            ]);

            $roleName = $findRole->role->name;
            $activity = 'User Deleted';
            $deletedUser = $message->id;
            $note = $roleName . ' deleted the Employee Message (' . $deletedUser . ')';
            $logs = $this->Logs->newEntity();
            $this->request->data['Log']['user_id'] = $userId;
            $this->request->data['Log']['activity'] = $activity;
            $this->request->data['Log']['note'] = $note;

            $logs = $this->Logs->patchEntity($logs, $this->request->data['Log']);

            if ($this->Logs->save($logs)) {
                $this->Flash->success(__('The Message has been deleted.'));
                return $this->redirect('/TalentEvents/message' . $redirect);
            } else {
                $this->Flash->success(__('The Message has been deleted.'));
                return $this->redirect('/TalentEvents/message' . $redirect);
            }
        } else {
            $this->Flash->error(__('The Message could not be deleted. Please, try again.'));
        }
        return $this->redirect('/TalentEvents/message' . $redirect);
    }

    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $talentEvent = $this->TalentEvents->get($id);
        if ($this->TalentEvents->delete($talentEvent)) {
            $this->Flash->success(__('The talent event has been deleted.'));
        } else {
            $this->Flash->error(__('The talent event could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

}
