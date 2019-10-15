<?php

use Cake\Datasource\ConnectionManager;

/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */

namespace App\Controller;

use Cake\Core\Configure;
use Cake\Http\Exception\ForbiddenException;
use Cake\Http\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;
use Cake\Datasource\ConnectionManager;
use Cake\ORM\Query;
use Cake\ORM\TableRegistry;
use Cake\Auth\DefaultPasswordHasher;
use Cake\Mailer\Email;

/**
 * Static content controller
 *
 * This controller will render views from Template/Pages/
 *
 * @link https://book.cakephp.org/3.0/en/controllers/pages-controller.html
 */
class PagesController extends AppController {

    public function home() {
        $title = 'Welcome :: Welvet';
        $this->set(compact('title'));
        $this->viewBuilder()->setLayout('frontend');

        if ($this->request->is('post')) {
            //            debug($this->request->data['role']);
            if ($this->request->data['role'] == 'individual') {
                return $this->redirect(['controller' => 'Pages', 'action' => 'registerindividual']);
            }
            if ($this->request->data['role'] == 'corporate') {
                return $this->redirect(['controller' => 'Pages', 'action' => 'registercorporate']);
            }
            if ($this->request->data['role'] == 'employee') {
                return $this->redirect(['controller' => 'Pages', 'action' => 'registeremployee']);
            }
        }
        $categories = $this->Eventcategories->find('all')->toArray();
        $this->set(compact('categories'));
    }

    public function alertemail($user = null) {
        $this->loadModel('Users');
        $alertEmails = $this->Users->find('all', ['conditions' => ['role_id' => 1]])->toArray();
        //send mail to talent
        $emailToTalent = new Email();
        $emailToTalent->template('talent')
                ->emailFormat('html')
                ->to($user->email)
                ->from(['info@cyberclouds.com' => 'welvett.com'])
                ->subject('Talent registration successfully completed')
                ->viewVars(['content' => $user])
                ->send();
        //sending mails to Super admins
        foreach ($alertEmails as $sendMail):
            $email = new Email();
            $email->template('admin')
                    ->emailFormat('html')
                    ->to($sendMail->email)
                    ->from(['info@cyberclouds.com' => 'welvett.com'])
                    ->subject('New Talent Registered at Welvet Website')
                    ->viewVars(['content' => $user, 'admin' => $sendMail])
                    ->send();
        endforeach;
    }

    public function Subservice() {
        $this->autoRender = false;
        if ($this->request->is('post')) {
            $this->loadModel('Eventsubcategories');
            $id = $this->request->data['eventcategory_id'];
            $serivce = $this->Eventsubcategories->find('all', [
                        'conditions' => ['Eventsubcategories.eventcategory_id' => $id]
                    ])->toArray();

            if (count($serivce) > 0) {
                $option = '<option value="">Sub Services</option>';
                foreach ($serivce as $key => $data) {

                    $option .= '<option value="' . $data->id . '">' . $data->title . '</option>';
                }
            } else {
                $option = '<option value="">Select Sub Services</option>';
            }

            echo $option;
        }
    }

    public function dasboardtest() {
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
                    . 'join users  ON roles.id=users.role_id '
                    . ' join employee_members  ON users.id=employee_members.user_id '
                    . ' join talent_event_subcategories  ON users.id=talent_event_subcategories.user_id '
                    . ' join eventcategories  ON eventcategories.id=talent_event_subcategories.eventcategory_id '
                    . ' join eventsubcategories  ON eventsubcategories.id=talent_event_subcategories.eventsubcategory_id '
                    . ' join talent_events ON talent_events.id=talent_event_subcategories.talent_event_id '
                    //. ' join talent_calendars ON talent_events.id=talent_event_subcategories.talent_event_id '
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

    public function registeremployee() {

        $title = 'Employee Register :: Welvet';
        $this->loadModel('Eventcategories');
        $eventcategories = $this->Eventcategories->find('list')->toArray();
        $this->set(compact('title', 'eventcategories'));
        $this->loadModel('States');
        //        debug($states);exit();
        if ($this->request->is('post')) {
            $this->loadModel('Users');
            $this->loadModel('EmployeeMembers');

            //set user table fields
            $user = $this->Users->newEntity();
            $rand = str_pad(rand(1, 9999999), 7, STR_PAD_LEFT);
            $this->request->data['User']['role_id'] = 4;
            $this->request->data['User']['first_name'] = ucwords(strtolower($this->request->data['first_name']));
            $this->request->data['User']['last_name'] = ucwords(strtolower($this->request->data['last_name']));
            $this->request->data['User']['phone1'] = $this->request->data['phone'];
            $this->request->data['User']['address1'] = strtolower($this->request->data['address']);
            $this->request->data['User']['appartment'] = strtolower($this->request->data['appartment']);
            $this->request->data['User']['city'] = strtolower($this->request->data['city']);
            $this->request->data['User']['state'] = strtolower($this->request->data['state']);
            $this->request->data['User']['zip'] = strtolower($this->request->data['zipcode']);
            $this->request->data['User']['loginwithsocial'] = $this->request->data['googleid'];
            $this->request->data['User']['password'] = $this->request->data['password'];
            $this->request->data['User']['profile_image'] = $this->request->data['photo'];
            $this->request->data['User']['howtologin'] = $this->request->data['howtologin'];

            if (!empty($this->request->data['profile']) && !empty($this->request->data['facebookurl'])) {
                $this->request->data['User']['profile_link'] = $this->request->data['facebookurl'] . $this->request->data['profile'];
                //debug($this->request->data['User']['profile_link']);exit;
            } else

            if (!empty($this->request->data['profile'])) {
                $this->request->data['User']['profile_link'] = $this->request->data['profile'];
            }

            $this->request->data['User']['email'] = $this->request->data['email'];
            $this->request->data['User']['user_name'] = $this->request->data['first_name'] . ' ' . $rand;
            $this->request->data['User']['status'] = 0;
            $user = $this->Users->patchEntity($user, $this->request->data['User']);
            // print_r($user);exit;

            if ($result = $this->Users->save($user)) {
                $userId = $result->id;
                $employee = $this->EmployeeMembers->newEntity();
                $this->request->data['EmployeeMembers']['user_id'] = $userId;
                $this->request->data['EmployeeMembers']['eventcategory_id'] = $this->request->data['eventcategory_id'];
                $this->request->data['EmployeeMembers']['description'] = $this->request->data['job'];


                $employee = $this->EmployeeMembers->patchEntity($employee, $this->request->data['EmployeeMembers']);

                if ($this->EmployeeMembers->save($employee)) {

                    $this->loadModel('TalentEvents');
                    $talentEvent = $this->TalentEvents->newEntity();
                    $this->request->data['TalentEvents']['user_id'] = $userId;
                    $this->request->data['TalentEvents']['eventcategory_id'] = $this->request->data['eventcategory_id'];

                    $talentEvent = $this->TalentEvents->patchEntity($talentEvent, $this->request->data['TalentEvents']);

                    if ($resultTE = $this->TalentEvents->save($talentEvent)) {
                        $this->loadModel('TalentEventCities');
                        $t_cities = $this->TalentEventCities->newEntity();
                        $saveTalentcities = array();
                        $saveTalentcities['talent_event_id'] = $resultTE->id;
                        $saveTalentcities['state_id'] = $this->request->data['state'];
                        $saveTalentcities['eventcategory_id'] = $this->request->data['eventcategory_id'];
                        $saveTalentcities['city'] = $this->request->data['city'];
                        $saveTalentcities['accommodation_price'] = 0;
                        $t_cities = $this->TalentEventCities->patchEntity($t_cities, $saveTalentcities);

                        $this->TalentEventCities->save($t_cities);

                        $talentEventId = $resultTE->id;

                        $this->loadModel('TalentEventSubcategories');
                        for ($serial = 0; $serial < sizeof($this->request->data['sub_services']); $serial++) {
                            $currentSubService = $this->request->data['sub_services'][$serial];
                            $talentEventSub = $this->TalentEventSubcategories->newEntity();
                            $this->request->data['TalentEventSubcategories']['user_id'] = $userId;
                            $this->request->data['TalentEventSubcategories']['talent_event_id'] = $talentEventId;
                            $this->request->data['TalentEventSubcategories']['eventcategory_id'] = $this->request->data['eventcategory_id'];
                            $this->request->data['TalentEventSubcategories']['eventsubcategory_id'] = $currentSubService;

                            $talentEventSub = $this->TalentEventSubcategories->patchEntity($talentEventSub, $this->request->data['TalentEventSubcategories']);
                            $this->TalentEventSubcategories->save($talentEventSub);
                        }

                        //STORE LOGS
                        $this->loadModel('Logs');

                        $findRole = $this->Users->get($userId, [
                            'contain' => ['Roles']
                        ]);
                        $roleName = $findRole->role->name;

                        $activity = 'Employee Member Registered';
                        $updatedUserName = $this->request->data['first_name'] . ' ' . $this->request->data['last_name'];
                        $note = 'An/A ' . $roleName . ' member (' . $updatedUserName . ') have been registered successfully';

                        $logs = $this->Logs->newEntity();
                        $this->request->data['Log']['user_id'] = $userId;
                        $this->request->data['Log']['activity'] = $activity;
                        $this->request->data['Log']['note'] = $note;

                        $logs = $this->Logs->patchEntity($logs, $this->request->data['Log']);

                        if ($this->Logs->save($logs)) {
                            $this->alertemail($user);

                            $this->Flash->success(__('You have registered successfully. Some one will contact you shortly.'));
                            return $this->redirect('/corporateMembers/waitingForApproval');
                        }
                    }
                }
            } else {
                $this->set(compact('user'));
            }
        }
        $this->set(compact('title', 'eventcategories'));
        $this->viewBuilder()->setLayout('frontend');
    }

    public function privacyPolicy() {

        $title = 'Employee Privacy policy :: Welvet';
        $this->set(compact('title'));
        $this->viewBuilder()->setLayout('');
    }

    public function instagramauth() {
        $this->viewBuilder()->setLayout('');
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

    public function registercorporate() {
        $title = 'Corporate Register :: Welvet';
        $this->set(compact('title'));

        if ($this->request->is('post')) {
            $this->loadModel('Users');
            $this->loadModel('CorporateMembers');

            //set user table fields
            $user = $this->Users->newEntity();
            $rand = str_pad(rand(1, 9999999), 7, STR_PAD_LEFT);
            $this->request->data['User']['role_id'] = 3;
            $this->request->data['User']['first_name'] = ucwords(strtolower($this->request->data['first_name']));
            $this->request->data['User']['last_name'] = ucwords(strtolower($this->request->data['last_name']));
            $this->request->data['User']['phone1'] = $this->request->data['phone'];
            $this->request->data['User']['address1'] = strtolower($this->request->data['company_address']);
            $this->request->data['User']['password'] = $this->request->data['password'];
            $this->request->data['User']['email'] = $this->request->data['email'];
            $this->request->data['User']['user_name'] = $this->request->data['first_name'] . ' ' . $rand;
            $this->request->data['User']['status'] = 0;

            $user = $this->Users->patchEntity($user, $this->request->data['User'], [
                'validate' => 'IndivisualCheck'
            ]);
            //            debug($user->email);

            if ($result = $this->Users->save($user)) {

                $userId = $result->id;
                $corporate = $this->CorporateMembers->newEntity();
                $this->request->data['CorporateMembers']['user_id'] = $userId;
                $this->request->data['CorporateMembers']['job_title'] = $this->request->data['job_title'];
                $this->request->data['CorporateMembers']['company_name'] = $this->request->data['company_name'];
                $this->request->data['CorporateMembers']['is_authorize'] = $this->request->data['authorise_company'];
                $this->request->data['CorporateMembers']['authorizer_first_name'] = $this->request->data['auth_fname'];
                $this->request->data['CorporateMembers']['authorizer_last_name'] = $this->request->data['auth_lname'];
                $this->request->data['CorporateMembers']['authorizer_job_title'] = $this->request->data['auth_job_title'];
                $this->request->data['CorporateMembers']['authorizer_email'] = $this->request->data['auth_email'];
                $this->request->data['CorporateMembers']['authorizer_phone'] = $this->request->data['auth_phone'];

                $corporate = $this->CorporateMembers->patchEntity($corporate, $this->request->data['CorporateMembers']);

                if ($this->CorporateMembers->save($corporate)) {

                    $this->alertemail($user);
                    //STORE LOGS
                    $this->loadModel('Logs');

                    $findRole = $this->Users->get($userId, [
                        'contain' => ['Roles']
                    ]);
                    $roleName = $findRole->role->name;

                    $activity = 'Corporate Member Registered';
                    $updatedUserName = $this->request->data['first_name'] . ' ' . $this->request->data['last_name'];

                    $note = 'An/A ' . $roleName . ' member (' . $updatedUserName . ') have been registered successfully';

                    $logs = $this->Logs->newEntity();
                    $this->request->data['Log']['user_id'] = $userId;
                    $this->request->data['Log']['activity'] = $activity;
                    $this->request->data['Log']['note'] = $note;

                    $logs = $this->Logs->patchEntity($logs, $this->request->data['Log']);

                    if ($this->Logs->save($logs)) {
                        $this->Flash->success(__('You have registered successfully. Some one will contact you shortly.'));
                        return $this->redirect('/corporateMembers/waitingForApproval');
                    }
                }
            }
        }

        $this->viewBuilder()->setLayout('frontend');
    }

    public function freeaccount() {
        $title = 'Corporate Register :: Welvet';
        $this->set(compact('title'));

        if ($this->request->is('post')) {
            $this->loadModel('Users');
            $this->loadModel('CorporateMembers');

            //set user table fields
            $user = $this->Users->newEntity();
            $rand = str_pad(rand(1, 9999999), 7, STR_PAD_LEFT);
            $this->request->data['User']['role_id'] = 3;
            $this->request->data['User']['first_name'] = ucwords(strtolower($this->request->data['first_name']));
            $this->request->data['User']['last_name'] = ucwords(strtolower($this->request->data['last_name']));
            $this->request->data['User']['phone1'] = $this->request->data['phone'];
            $this->request->data['User']['address1'] = strtolower($this->request->data['company_address']);
            $this->request->data['User']['password'] = $this->request->data['password'];
            $this->request->data['User']['email'] = $this->request->data['email'];
            $this->request->data['User']['user_name'] = $this->request->data['first_name'] . ' ' . $rand;
            $this->request->data['User']['status'] = 1;

            $user = $this->Users->patchEntity($user, $this->request->data['User'], [
                'validate' => 'IndivisualCheck'
            ]);

            if ($result = $this->Users->save($user)) {
                $userId = $result->id;
                $corporate = $this->CorporateMembers->newEntity();
                $this->request->data['CorporateMembers']['user_id'] = $userId;
                $this->request->data['CorporateMembers']['job_title'] = $this->request->data['job_title'];
                $this->request->data['CorporateMembers']['company_name'] = $this->request->data['company_name'];
                $this->request->data['CorporateMembers']['is_authorize'] = $this->request->data['authorise_company'];
                $this->request->data['CorporateMembers']['authorizer_first_name'] = $this->request->data['auth_fname'];
                $this->request->data['CorporateMembers']['authorizer_last_name'] = $this->request->data['auth_lname'];
                $this->request->data['CorporateMembers']['authorizer_job_title'] = $this->request->data['auth_job_title'];
                $this->request->data['CorporateMembers']['authorizer_email'] = $this->request->data['auth_email'];
                $this->request->data['CorporateMembers']['authorizer_phone'] = $this->request->data['auth_phone'];

                $corporate = $this->CorporateMembers->patchEntity($corporate, $this->request->data['CorporateMembers']);

                if ($this->CorporateMembers->save($corporate)) {
                    //STORE LOGS
                    $this->loadModel('Logs');

                    $findRole = $this->Users->get($userId, [
                        'contain' => ['Roles']
                    ]);
                    $roleName = $findRole->role->name;

                    $activity = 'Corporate Member Registered';
                    $updatedUserName = $this->request->data['first_name'] . ' ' . $this->request->data['last_name'];

                    $note = $roleName . ' Inserted the user profile of (' . $updatedUserName . ')';

                    $logs = $this->Logs->newEntity();
                    $this->request->data['Log']['user_id'] = $userId;
                    $this->request->data['Log']['activity'] = $activity;
                    $this->request->data['Log']['note'] = $note;

                    $logs = $this->Logs->patchEntity($logs, $this->request->data['Log']);

                    if ($this->Logs->save($logs)) {
                        $this->Flash->success(__('The user has been saved.'));

                        return $this->redirect('/login');
                    }
                }
            }
        }

        $this->viewBuilder()->setLayout('frontend');
    }

    public function registerindividual() {
        include(ROOT . DS . 'vendor' . DS . 'aws' . DS . 'sms.php');

        $title = 'Individual Register :: Welvet';
        include(ROOT . DS . 'vendor' . DS . 'googlelogin' . DS . 'index.php');

        if (isset($_GET['userid']) && $_GET['userid'] !== 'undefined') {
            $userid = $_GET['userid'];
            $email = $_GET['email'];
            $firstname = $_GET['firstname'];
            $lastname = $_GET['lastname'];
            $rand = str_pad(rand(1, 9999999), 7, STR_PAD_LEFT);
            $userName = $firstname . ' ' . $rand;
            $roleId = 2;
            $conn = ConnectionManager::get('default');
            $modified = date('Y-m-d H:i:s');

            $query_users = $conn->execute('SELECT * from users where loginwithsocial="' . $userid . '"');


            $details_users = $query_users->fetchAll('assoc');




            if (empty($details_users)) {
                //        $query = $conn->execute("INSERT INTO `users`(`role_id`, `first_name`, `last_name`, `address1`,
                //        `profile_image`, `gender`, `user_name`, `email`, `status`, `modified`) 
                //        VALUES ('$roleId', '$firstname', '$lastname', '$address', '$photo', '$gender', '$userName', '$email', 1, '$modified')");
                $this->loadModel('Users');
                $user = $this->Users->newEntity();
                $this->request->data['User']['loginwithsocial'] = $userid;
                $this->request->data['User']['role_id'] = $roleId;
                $this->request->data['User']['first_name'] = $firstname;
                $this->request->data['User']['last_name'] = $lastname;
                $this->request->data['User']['user_name'] = $userName;
                $this->request->data['User']['email'] = $email;
                $this->request->data['User']['profile_image'] = $_GET['photo'];
                $this->request->data['User']['password'] = 'emp@tal';
                $this->request->data['User']['status'] = 1;
                $user = $this->Users->patchEntity($user, $this->request->data['User'], [
                    'validate' => 'IndivisuallCheck'
                ]);

                $this->Users->save($user);
            }

            $this->request->data['loginwithsocial'] = $userid;
            $this->request->data['password'] = 'emp@tal';
            $this->Auth->config('authenticate', [
                'Form' => [
                    'fields' => ['username' => 'loginwithsocial']
                ]
            ]);
            $this->Auth->constructAuthenticate();
            $user = $this->Auth->identify();

            if ($user) {
                $roleId = $user['role_id'];
                $this->loadModel('Roles');
                $userRole = $this->Roles->get($roleId);
                if ($user['status'] == 0) {
                    $this->Flash->error('Your account has been deactivated, contact web admin');
                    return $this->redirect($this->Auth->logout());
                }


                $this->Auth->setUser($user);
                $session = $this->request->session();

                //STORE LOGS
                $this->loadModel('Logs');
                $this->loadModel('Users');

                $userId = $this->request->session()->read('Auth.User.id');
                $roleId = $this->request->session()->read('Auth.User.role_id');

                $findRole = $this->Users->get($userId, [
                    'contain' => ['Roles']
                ]);

                $roleName = $findRole->role->name;
                $activity = $roleName . ' Login';

                $note = 'User logged in with the role of ' . $roleName;

                $logs = $this->Logs->newEntity();
                $this->request->data['Log']['user_id'] = $userId;
                $this->request->data['Log']['activity'] = $activity;
                $this->request->data['Log']['note'] = $note;

                $logs = $this->Logs->patchEntity($logs, $this->request->data['Log']);

                if ($this->Logs->save($logs)) {

                    $this->Flash->success(__('Logged in successfully'));
                    if ($roleId == 3) {
                        return $this->redirect('/CorporateMembers/corporate_events/edit');
                    } else if ($roleId == 2) {
                        return $this->redirect(['controller' => 'Users', 'action' => 'individualEvents/edit']);
                    } else if ($roleId == 4) {
                        return $this->redirect('/EmployeeMembers/employeeFreeevents/edit');
                    }
                }
            }
        }
        // Google api integration
        if (isset($_GET['code'])) {
            try {


                // Get the access token 
                $data = $gapi->GetAccessToken(CLIENT_ID, CLIENT_REDIRECT_URL, CLIENT_SECRET, $_GET['code']);
                //print_r($data);
                // Access Tokem
                $access_token = $data['access_token'];

                // Get user information
                $user_info = $gapi->GetUserProfileInfo($access_token);


                $social = $user_info['id'];
                $email = $user_info['emails'][0]['value'];
                $firstname = $user_info['name']['givenName'];
                $lastname = $user_info['name']['familyName'];
                $photo = $user_info['image']['url'];
                if (!empty($user_info['placesLived'][0]['value'])) {
                    $address = $user_info['placesLived'][0]['value'];
                } else {
                    $address = "";
                }

                if (!empty($user_info['gender'])) {
                    $gender = $user_info['gender'];
                } else {
                    $gender = "";
                }

                $this->request->session()->write('email', $email);
                $this->request->session()->write('first_name', $firstname);
                $this->request->session()->write('last_name', $lastname);
                //$this->request->session()->write('profile_image', $photo);
                $this->request->session()->write('address', $address);
                $this->request->session()->write('gender', $gender);

                $rand = str_pad(rand(1, 9999999), 7, STR_PAD_LEFT);
                $userName = $firstname . ' ' . $rand;
                $roleId = 2;
                $conn = ConnectionManager::get('default');
                $modified = date('Y-m-d H:i:s');

                $query_users = $conn->execute('SELECT * from users where loginwithsocial="' . $social . '"');



                $details_users = $query_users->fetchAll('assoc');




                if (empty($details_users)) {
                    //        $query = $conn->execute("INSERT INTO `users`(`role_id`, `first_name`, `last_name`, `address1`,
                    //        `profile_image`, `gender`, `user_name`, `email`, `status`, `modified`) 
                    //        VALUES ('$roleId', '$firstname', '$lastname', '$address', '$photo', '$gender', '$userName', '$email', 1, '$modified')");
                    $this->loadModel('Users');
                    $user = $this->Users->newEntity();
                    $this->request->data['User']['role_id'] = $roleId;
                    $this->request->data['User']['first_name'] = $firstname;
                    $this->request->data['User']['last_name'] = $lastname;
                    $this->request->data['User']['user_name'] = $userName;
                    $this->request->data['User']['user_name'] = $userName;
                    $this->request->data['User']['email'] = $email;
                    $this->request->data['User']['loginwithsocial'] = $social;
                    $this->request->data['User']['profile_image'] = $photo;
                    $this->request->data['User']['password'] = 'emp@tal';
                    $this->request->data['User']['status'] = 1;
                    $user = $this->Users->patchEntity($user, $this->request->data['User'], [
                        'validate' => 'IndivisuallCheck'
                    ]);

                    $this->Users->save($user);
                    ?>

                <?php }
                ?>

                <?php

                $this->request->data['loginwithsocial'] = $social;
                $this->request->data['password'] = 'emp@tal';
                $this->Auth->config('authenticate', [
                    'Form' => [
                        'fields' => ['username' => 'loginwithsocial']
                    ]
                ]);
                $this->Auth->constructAuthenticate();
                $user = $this->Auth->identify();

                if ($user) {
                    $roleId = $user['role_id'];
                    $this->loadModel('Roles');
                    $userRole = $this->Roles->get($roleId);
                    if ($user['status'] == 0) {
                        $this->Flash->error('Your account has been deactivated, contact web admin');
                        return $this->redirect($this->Auth->logout());
                    }


                    $this->Auth->setUser($user);
                    $session = $this->request->session();

                    //STORE LOGS
                    $this->loadModel('Logs');
                    $this->loadModel('Users');

                    $userId = $this->request->session()->read('Auth.User.id');
                    $roleId = $this->request->session()->read('Auth.User.role_id');

                    $findRole = $this->Users->get($userId, [
                        'contain' => ['Roles']
                    ]);

                    $roleName = $findRole->role->name;
                    $activity = $roleName . ' Login';

                    $note = 'User logged in with the role of ' . $roleName;

                    $logs = $this->Logs->newEntity();
                    $this->request->data['Log']['user_id'] = $userId;
                    $this->request->data['Log']['activity'] = $activity;
                    $this->request->data['Log']['note'] = $note;

                    $logs = $this->Logs->patchEntity($logs, $this->request->data['Log']);

                    if ($this->Logs->save($logs)) {

                        $this->Flash->success(__('Logged in successfully'));
                        if ($roleId == 3) {
                            return $this->redirect('/CorporateMembers/corporate_events/edit');
                        } else if ($roleId == 2) {
                            return $this->redirect(['controller' => 'Users', 'action' => 'individualEvents/edit']);
                        } else if ($roleId == 4) {
                            return $this->redirect('/EmployeeMembers/employeeFreeevents/edit');
                        }
                    }
                }
                // Now that the user is logged in you may want to start some session variables
                $_SESSION['logged_in'] = 1;

                // You may now want to redirect the user to the home page of your website
                // header('Location: home.php');
            } catch (Exception $e) {
                echo $e->getMessage();
                exit();
            }
        }

        // Google api integration

        $this->set(compact('title'));
        $this->loadModel('Roles');
        $roleList = $this->Roles->find('list', [
                    'keyField' => 'id',
                    'valueField' => 'name'
                ])->toArray();
        $this->loadModel('Users');
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {

            $this->request->data['User']['role_id'] = 2;

            $this->request->data['User']['first_name'] = ucwords(strtolower($this->request->data['first_name']));
            $this->request->data['User']['last_name'] = ucwords(strtolower($this->request->data['last_name']));
            $rand1 = str_pad(rand(1, 9999999), 7, STR_PAD_LEFT);
            $rand2 = str_pad(rand(1, 9999), 4, STR_PAD_LEFT);
            $name = $rand1 . $rand2 . $this->request->data['first_name'];

            $this->request->data['User']['user_name'] = $name;
            $this->request->data['User']['email'] = strtolower($this->request->data['email']);
            $this->request->data['User']['password'] = $this->request->data['password'];
            $this->request->data['User']['phone1'] = $this->request->data['phone1'];
            $this->request->data['User']['verification_code'] = $rand2;
            //            debug($this->request->data);
            //            exit;
            $this->request->data['User']['status'] = 1;
            $user = $this->Users->patchEntity($user, $this->request->data['User'], [
                'validate' => 'IndivisualCheck'
            ]);



            if ($result = $this->Users->save($user)) {

                //STORE LOGS
                $this->loadModel('Logs');

                $userId = $result->id;
                $roleId = $this->request->session()->read('Auth.User.role_id');

                $findRole = $this->Users->get($userId, [
                    'contain' => ['Roles']
                ]);
                $roleName = $findRole->role->name;

                $activity = 'Individual member is registered';
                $updatedUserName = $this->request->data['first_name'] . ' ' . $this->request->data['last_name'];

                $note = 'An/A ' . $roleName . ' member (' . $updatedUserName . ') have been registered successfully';

                $logs = $this->Logs->newEntity();
                $this->request->data['Log']['user_id'] = $userId;
                $this->request->data['Log']['activity'] = $activity;
                $this->request->data['Log']['note'] = $note;

                $logs = $this->Logs->patchEntity($logs, $this->request->data['Log']);

                if ($this->Logs->save($logs)) {

                    //                    $email = new Email();
                    //                    $email->template('verify')
                    //                            ->emailFormat('html')
                    //                            ->to($user->email)
                    //                            ->from(['info@cyberclouds.com' => 'welvett.com'])
                    //                            ->subject('welvett.com - Verification')
                    //                            ->viewVars(['content' => $user])
                    //                            ->send();


                    $message = 'Your Welvett account verification code is W-' . $rand2;
                    $phone = $this->request->data['phone1'];

                    try {
                        $result = $SnSclient->publish([
                            'Message' => $message,
                            'PhoneNumber' => $phone,
                        ]);
                        if ($result) {
                            $log2 = $this->Logs->newEntity();
                            $this->request->data['Log']['activity'] = 'Verification code sent';
                            $this->request->data['Log']['note'] = 'A verification message hasbeen sent to ' . $roleName . ' member (' . $updatedUserName . ') on (' . $this->request->data['phone1'] . ')';
                            $log2 = $this->Logs->patchEntity($log2, $this->request->data['Log']);
                            $this->Logs->save($log2);
                        }
                    } catch (AwsException $e) {
                        // output error message if fails
                        error_log($e->getMessage());
                    }


                    if ($user->role_id == 2) {
                        $this->Flash->success(__('We have sent you a verification code on your phone number, please enter the verification code below to complete the registration.'));
                        $userId = base64_encode(base64_encode($user->id));
                        return $this->redirect('/Users/verification/' . $userId);
                    }
                }
            }
            if ($user->errors()) {
                $model_error = $user->errors();
                if (isset($model_error['email']['_isUnique']) != "") {
                    $this->Flash->error(__($model_error['email']['_isUnique']));
                }
            } else {
                $this->Flash->error(__('The user could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('user'));
        $this->set(compact('roleList', 'companyList'));
        $this->viewBuilder()->setLayout('backend');
        $this->viewBuilder()->setLayout('frontend');
    }

    public function contact($isSuccess = null) {
        $this->set('title', 'Contact us:: Welvett');
        if ($this->request->is('post')) {
            $this->loadModel('Contacts');
            $contact = $this->Contacts->newEntity();
            $this->request->data['status'] = 1;
            $contact = $this->Contacts->patchEntity($contact, $this->request->data);
            if ($this->Contacts->save($contact)) {
                //                $email = new Email();
                //                $email->template('contact')
                //                        ->emailFormat('html')
                //                        ->to('naqeebullah6222@gmail.com')
                //                        ->from(['info@cyberclouds.com' => 'welvett.com'])
                //                        ->subject('New Talent Registered at Welvet Website')
                //                        ->viewVars(['content' => $user, 'admin' => $sendMail])
                //                        ->send();

                $this->Flash->success('Your Request hasbeen forwarded');
                return $this->redirect(['action' => 'contact/success']);
            }
        }
        $this->viewBuilder()->setLayout('frontend');
    }

    public function welcome() {
        $this->set('content_title', 'Dashboard');
        $this->viewBuilder()->setLayout('backend');
    }

    public function searchtext() {

        $search = $_GET['value'];

        $role = 4;
        $condition = 'roles.id="' . $role . '"';
        if (!empty($search)) {


            $search = str_replace(" ", "", $search);
            $condition .= ' AND CONCAT(first_name, last_name) like "%' . $search . '%"';
            $conn = ConnectionManager::get('default');
            $query = $conn->execute('SELECT CONCAT(first_name, last_name),first_name,last_name,eventsubcategories.title as sub,image_icon,profile_image, loginwithsocial'
                    . ' FROM roles '
                    . 'join users  ON roles.id=users.role_id '
                    . ' join employee_members  ON users.id=employee_members.user_id '
                    . ' join talent_event_subcategories  ON users.id=talent_event_subcategories.user_id '
                    . ' join eventcategories  ON eventcategories.id=talent_event_subcategories.eventcategory_id '
                    . ' join eventsubcategories  ON eventsubcategories.id=talent_event_subcategories.eventsubcategory_id '
                    . ' join talent_events ON talent_events.id=talent_event_subcategories.talent_event_id '
                    . ' join event_types ON talent_events.id=event_types.talent_event_id '
                    . 'where ' . $condition . ' AND (client_type="" OR client_type is NULL OR client_type="' . $this->Auth->user('role_id') . '")  GROUP BY users.id');
            $event_employees = $query->fetchAll('assoc');


            echo json_encode($event_employees);
            exit;
        }
    }

    public function categoriesDesign() {
        $title = 'Categories :: Welvet';

        $this->set(compact('title'));
        $this->viewBuilder()->setLayout('dashboard');
    }

    public function categories($text = null, $category_id = null, $id = null) {
        $roleId = $this->request->session()->read('Auth.User.role_id');
        if ($roleId == 2 || $roleId == 3) {
            
        } else {
            return $this->redirect(['action' => 'home']);
        }
        $this->viewBuilder()->setLayout('dashboard');
        if (isset($_GET['category_id'])) {
            $category_id = $_GET['category_id'];
        }
        $title = 'Categories :: Welvet';
        $this->set(compact('title'));
        $this->loadModel('Eventcategories');
        $this->loadModel('Eventsubcategories');

        $eventcategories = $this->Eventcategories->find('all');

        if (!empty($_GET['category_id'])) {
            $category_id = $_GET['category_id'];
            $eventsubcategories = $this->Eventsubcategories->find('all', [
                'conditions' => ['Eventsubcategories.eventcategory_id' => $category_id]
            ]);
            $this->set(compact('eventsubcategories'));
        } else {

            $eventsubcategories = '';
            $this->set(compact('eventsubcategories'));
        }

        $eventcateg = $this->Eventcategories->find('list');
        $eventsubcateg = $this->Eventsubcategories->find('list');
        $this->set(compact('eventsubcateg', 'eventcateg'));

        $conn = ConnectionManager::get('default');
        $role = 4;
        $subc = "";
        if ($this->request->is('post')) {
//            debug($this->request->data);
//            exit;
            $condition = 'roles.id="' . $role . '"';
            if (!empty($_GET['text'])) {

                $text = $_GET['text'];

                $search = str_replace(" ", "", $text);
                $condition .= ' AND CONCAT(first_name, last_name) like "%' . $search . '%"';
            }
            if (!empty($this->request->data['search'])) {

                $search = $this->request->data['search'];
                $search = str_replace(" ", "", $search);
                $condition .= ' AND CONCAT(first_name, last_name) like "%' . $search . '%"';
            }

            if (!empty($this->request->data['category'])) {
                if (isset($this->request->data['category2'])) {
                    $this->request->data['category'] = $this->request->data['category2'];
                }

                $category = $this->request->data['category'];

                $condition .= ' AND eventcategories.id="' . $category . '"';

                $eventsubcategories = $this->Eventsubcategories->find('all', [
                    'conditions' => ['Eventsubcategories.eventcategory_id' => $category]
                ]);
                $subc = 'talent_event_subcategories.eventsubcategory_id ,';

                $this->set(compact('eventsubcategories'));
            }
            if (!empty($this->request->data['city'])) {
                $condition .= ' AND tec.city LIKE "' . $this->request->data['city'] . '"';
            }
            if (!empty($this->request->data['state_id'])) {
                $condition .= ' AND tec.state_id  ="' . $this->request->data['state_id'] . '"';
            }
            if (!empty($this->request->data['date'])) {
                $date = date('Y-m-d', strtotime($this->request->data['date']));
                $condition .= ' AND (tcal.date NOT LIKE "' . $date . '" OR tcal.date IS Null) ';
            }
            if (!empty($this->request->data['subcategory'])) {

                $subcategory = $this->request->data['subcategory'];
                $condition .= ' AND eventsubcategories.id="' . $subcategory . '"';
                if (!empty($this->request->data['category'])) {
                    $eventsubcategories = $this->Eventsubcategories->find('all', [
                        'conditions' => ['Eventsubcategories.id' => $subcategory, 'Eventsubcategories.eventcategory_id' => $category]
                    ]);
                    $this->set(compact('eventsubcategories'));
                } else {
                    $eventsubcategories = $this->Eventsubcategories->find('all', [
                        'conditions' => ['Eventsubcategories.id' => $subcategory]
                    ]);
                    $this->set(compact('eventsubcategories'));
                    $subc = 'talent_event_subcategories.eventsubcategory_id ,';
                }
            }

            if (!empty($this->request->data['max-price'])) {
                $maxprice = $this->request->data['max-price'];
                $condition .= ' AND event_types.amount <= ' . $maxprice;
            }
            if (!empty($this->request->data['name'])) {
                $name = $this->request->data['name'];
                $condition = ' CONCAT(first_name, " ",last_name) LIKE "%' . $name . '%"';
            }
            $query = $conn->execute('SELECT (SELECT GROUP_CONCAT(event_types.event_type," ",event_types.amount) FROM event_types WHERE event_types.talent_event_id=talent_events.id) AS type,(SELECT AVG(rate) FROM talent_ratings WHERE talent_event_id=talent_events.id) as rate,tcal.date,users.id as user_id,talent_events.id as event_id,client_type,event_types.amount ,talent_event_subcategories.eventsubcategory_id,CONCAT(first_name," ", last_name) as full_name,first_name,last_name,eventsubcategories.title as sub,image_icon,profile_image, loginwithsocial'
                    . ' FROM roles '
                    . 'join users  ON roles.id=users.role_id '
                    . ' join employee_members  ON users.id=employee_members.user_id '
                    . ' join talent_events ON users.id=talent_events.user_id'
                    . ' left join talent_ratings as tr ON talent_events.id=tr.talent_event_id'
                    . ' join talent_event_subcategories  ON talent_events.id=talent_event_subcategories.talent_event_id '
                    . ' join eventcategories  ON eventcategories.id=talent_event_subcategories.eventcategory_id '
                    . ' join eventsubcategories  ON eventsubcategories.id=talent_event_subcategories.eventsubcategory_id '
                    . ' join talent_event_cities as tec ON talent_events.id=tec.talent_event_id '
                    . ' join event_types ON talent_events.id=event_types.talent_event_id '
                    . ' left join talent_calendars AS tcal ON talent_events.id=tcal.talent_event_id '
                    . 'where ' . $condition . ' AND talent_events.deleted=0 AND talent_events.status=1 AND (client_type="" OR client_type is NULL OR client_type="' . $this->Auth->user('role_id') . '" ) GROUP BY ' . $subc . '  users.id ORDER BY rate  DESC');

            $allRecords = $conn->execute('SELECT (SELECT GROUP_CONCAT(event_types.event_type," ",event_types.amount) FROM event_types WHERE event_types.talent_event_id=talent_events.id) AS type,talent_events.status,(SELECT AVG(rate) FROM talent_ratings WHERE talent_event_id=talent_events.id) as rate,tcal.date,users.id as user_id,talent_events.id as event_id,client_type,event_types.amount ,talent_event_subcategories.eventsubcategory_id,CONCAT(first_name, " ",last_name) as full_name,first_name,last_name,eventsubcategories.title as sub,image_icon,profile_image, loginwithsocial'
                    . ' FROM roles '
                    . 'join users  ON roles.id=users.role_id '
                    . ' join employee_members  ON users.id=employee_members.user_id '
                    . ' join talent_events ON users.id=talent_events.user_id'
                    . ' left join talent_ratings as tr ON talent_events.id=tr.talent_event_id'
                    . ' join talent_event_subcategories  ON talent_events.id=talent_event_subcategories.talent_event_id '
                    . ' join eventcategories  ON eventcategories.id=talent_event_subcategories.eventcategory_id '
                    . ' join eventsubcategories  ON eventsubcategories.id=talent_event_subcategories.eventsubcategory_id '
                    . ' join talent_event_cities as tec ON talent_events.id=tec.talent_event_id '
                    . ' join event_types ON talent_events.id=event_types.talent_event_id '
                    . ' left join talent_calendars AS tcal ON talent_events.id=tcal.talent_event_id '
                    . 'where ' . $condition . ' AND talent_events.deleted=0 AND talent_events.status=1 AND (client_type="" OR client_type is NULL OR client_type="' . $this->Auth->user('role_id') . '" ) GROUP BY users.id ORDER BY rate  DESC');



            $statesquery = 'SELECT s.id,s.statename FROM `cities` AS `c` JOIN `states` as `s` ON c.state_code=s.state_abbrv WHERE c.city LIKE "' . $this->request->data['city'] . '" ';
            $states_result = $conn->execute($statesquery);
            $row = $states_result->fetchAll('assoc');

            $this->set('posted_search', $row);
            $event_employees = $query->fetchAll('assoc');
            $allRecords = $allRecords->fetchAll('assoc');
            //            debug($event_employees);
//            debug($condition);
//            debug($allRecords);
//            exit;

            $serviceId = '';
            $subCatId = '';
            if (isset($this->request->data['category'])) {
                $serviceId = $this->request->data['category'];
            }
            if (isset($this->request->data['subcategory'])) {
                $subCatId = $this->request->data['subcategory'];
            }
            $this->set(compact('subCatId', 'serviceId'));
        }
        $this->set(compact('eventcategories'));
        $this->set(compact('event_employees', 'allRecords'));

        //debug($event_employess);exit;
    }

    public function corporateEvents() {

        $title = 'Corporate Events :: Welvet';

        $this->set(compact('title'));
        $this->viewBuilder()->setLayout('frontend');
    }

    /**
     * Displays a view
     *
     * @param array ...$path Path segments.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Http\Exception\ForbiddenException When a directory traversal attempt.
     * @throws \Cake\Http\Exception\NotFoundException When the view file could not
     *   be found or \Cake\View\Exception\MissingTemplateException in debug mode.
     */
    public function display(...$path) {
        $count = count($path);
        if (!$count) {
            return $this->redirect('/');
        }
        if (in_array('..', $path, true) || in_array('.', $path, true)) {
            throw new ForbiddenException();
        }
        $page = $subpage = null;

        if (!empty($path[0])) {
            $page = $path[0];
        }
        if (!empty($path[1])) {
            $subpage = $path[1];
        }
        $this->set(compact('page', 'subpage'));

        try {
            $this->render(implode('/', $path));
        } catch (MissingTemplateException $exception) {
            if (Configure::read('debug')) {
                throw $exception;
            }
            throw new NotFoundException();
        }
    }

    public function comingSoon() {
        $title = 'Coming Soon';
        $this->set(compact('title'));
        $this->viewBuilder()->setLayout('frontend');
    }

    public function about() {
        $title = 'About';
        $this->set(compact('title'));
        $this->viewBuilder()->setLayout('frontend');
    }

    public function faq() {
        $title = 'About';
        $this->set(compact('title'));
        $this->viewBuilder()->setLayout('frontend');
    }

    public function welvettIos() {
        $title = 'About';
        $this->set(compact('title'));
        $this->viewBuilder()->setLayout('frontend');
    }

    public function welvettAndroid() {
        $title = 'About';
        $this->set(compact('title'));
        $this->viewBuilder()->setLayout('frontend');
    }

    public function termofUse() {
        $title = 'About';
        $this->set(compact('title'));
        $this->viewBuilder()->setLayout('frontend');
    }

}
