<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Datasource\ConnectionManager;
use Cake\ORM\TableRegistry;
use Cake\Http\Client;
use Cake\Auth\DefaultPasswordHasher;
use Cake\Mailer\Email;
use Cake\Routing\Router;

/**
 * Users Controller
 *
 *
 * @method \App\Model\Entity\User[] paginate($object = null, array $settings = [])
 */
class UsersController extends AppController {

    public function isAuthorized($user) {
        return true;

        if (in_array($this->request->action, ['editUser'])) {
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

        $permission = $this->viewVars['actionPermission'];

        if ($permission == 1 || $permission == 2) {
            
        } else {
            return $this->redirect(['controller' => 'Pages', 'action' => 'welcome']);
        }
        $this->set(compact('permission'));

        $users = $this->paginate($this->Users);

        $this->set(compact('users'));
        $this->set('_serialize', ['users']);
    }

    public function dashboard() {
        $this->loadModel('Memberships');
        $membership = $this->Memberships->find('all', [
                    'conditions' => ['user_id' => $this->Auth->user('id'), 'expiry_date >' => date('Y-m-d')]
                ])->first();

        if ($membership) {
            return $this->redirect('/Users/pro_dashboard');
        } else {
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
                    $this->Flash->success(__('You have been successfully upgraded to a PRO member.'));
                    return $this->redirect('/Users/pro_dashboard');
                }
            }
            $title = 'Dashboard :: Welvet';
            $userId = $this->Auth->user('id');

            $user = $this->Users->get($userId, ['contain' => ['EmployeeMembers', 'TalentEvents' => function($t) {
                        $t->order('TalentEvents.id')
                                ->limit(1);
                        return $t;
                    }, 'TalentEvents.TalentEventCities' => function($c) {
                        $c->order('TalentEventCities.id')
                                ->limit(1);
                        return $c;
                    }, 'TalentEvents.RefrenceLinks'
                    , 'TalentEvents.EventTypes' => function($r) {
                        $r->order(['EventTypes.event_type'])->limit(1);
                        return $r;
                    }
                    , 'EmployeeMembers.Eventcategories', 'EmployeeMembers.Eventcategories.Eventsubcategories', 'TalentEventSubcategories']]);

            $referenceLinks = $user->talent_events[0]->refrence_links;
            $this->loadModel('Eventsubcategories');
            $this->loadModel('TalentEventsubcategories');
            $services = $this->Eventcategories->find('list', ['keyField' => 'id', 'valueField' => 'title'])->toArray();
            $sub = $this->Eventsubcategories->find('list', ['conditions' => ['eventcategory_id' => $user->talent_events[0]->eventcategory_id]])->toArray();
            $mysub = $this->TalentEventsubcategories->find('list', ['keyField' => 'id', 'valueField' => 'eventsubcategory_id', 'conditions' => ['talent_event_id' => $user->talent_events[0]->id]])->toArray();

            $this->set(compact('title', 'referenceLinks', 'user', 'services', 'sub', 'mysub'));
            $this->viewBuilder()->setLayout('first_dashboard');
        }
    }

    public function proDashboard() {
        $this->loadModel('Memberships');
        $membership = $this->Memberships->find('all', [
                    'conditions' => ['user_id' => $this->Auth->user('id'), 'expiry_date >' => date('Y-m-d')]
                ])->first();
        if ($membership) {
            $title = 'Dashboard :: Welvet';
            $userId = $this->Auth->user('id');

            $user = $this->Users->get($userId, ['contain' => ['EmployeeMembers', 'TalentEvents' => function($t) {
                        $t->order('TalentEvents.id')
                                ->limit(1);
                        return $t;
                    }
                    , 'TalentEvents.RefrenceLinks'
                    , 'TalentEvents.TalentEventCities' => function($c) {
                        $c->order('TalentEventCities.id')
                                ->limit(1);
                        return $c;
                    }, 'TalentEvents.EventTypes' => function($r) {
                        $r->order(['EventTypes.event_type'])->limit(1);
                        return $r;
                    }
                    , 'EmployeeMembers.Eventcategories', 'EmployeeMembers.Eventcategories.Eventsubcategories', 'TalentEventSubcategories']]);

            $referenceLinks = $user->talent_events[0]->refrence_links;

            $this->loadModel('TalentEventCities');
            $cities = $this->TalentEventCities->find('all')
                    ->where(['talent_event_id' => $user->talent_events[0]->id])
                    ->toArray();
            $this->loadModel('States');
            $states = $this->States->find('list')->toArray();
            $this->loadModel('Eventcategories');
            $this->loadModel('Eventsubcategories');
            $this->loadModel('TalentEventsubcategories');
            $services = $this->Eventcategories->find('list', ['keyField' => 'id', 'valueField' => 'title'])->toArray();
            $sub = $this->Eventsubcategories->find('list', ['conditions' => ['eventcategory_id' => $user->talent_events[0]->eventcategory_id]])->toArray();
            $mysub = $this->TalentEventsubcategories->find('list', ['keyField' => 'id', 'valueField' => 'eventsubcategory_id', 'conditions' => ['talent_event_id' => $user->talent_events[0]->id]])->toArray();
            $this->set(compact('title', 'user', 'referenceLinks', 'cities', 'states', 'services', 'sub', 'mysub'));
            $this->viewBuilder()->setLayout('first_dashboard');
        } else {
            return $this->redirect('/Users/dashboard');
        }
    }

    public function ratings() {
        $this->loadModel('Bookings');
        $booking = $this->Bookings->get($_GET['booking_id']);

        $this->loadModel('TalentRatings');
        $ifExists = $this->TalentRatings->find('all', ['conditions' => ['booking_id' => $_GET['booking_id']]])->count();
        $response = array();
        if ($ifExists == 0) {
            $ratings = $this->TalentRatings->newEntity();
            $arrayToSave = array();
            $arrayToSave['booking_id'] = $_GET['booking_id'];
            $arrayToSave['talent_id'] = $booking->talent_id;
            $arrayToSave['rate'] = $_GET['review'];
            $arrayToSave['customer_id'] = $this->Auth->user('id');
            $arrayToSave['talent_event_id'] = $booking->talent_event_id;
            $ratings = $this->TalentRatings->patchEntity($ratings, $arrayToSave);

            if ($this->TalentRatings->save($ratings)) {
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

    public function individuals($status = null) {
        $this->set('content_title', 'Individuals');
        $permission = $this->viewVars['actionPermission'];

        if ($permission == 1 || $permission == 2) {
            
        } else {
            return $this->redirect(['controller' => 'Pages', 'action' => 'welcome']);
        }
        $statusCond = '';
        if ($status == 'active') {
            $statusCond = array('Users.status' => 1);
        }
        if ($status == 'pending') {
            $statusCond = array('Users.status' => 0);
        }
        $this->set(compact('permission'));
        $this->viewBuilder()->layout('backend');
        $this->paginate = ['conditions' => ['Users.role_id' => 2, $statusCond]];
        $users = $this->paginate($this->Users);
        $this->set(compact('users'));
        $this->set('_serialize', ['users']);
    }

    public function corporate($status = null) {
        $permission = $this->viewVars['actionPermission'];

        if ($permission == 1 || $permission == 2) {
            
        } else {
            return $this->redirect(['controller' => 'Pages', 'action' => 'welcome']);
        }
        $statusCond = '';
        if ($status == 'active') {
            $statusCond = array('Users.status' => 1);
        }
        if ($status == 'pending') {
            $statusCond = array('Users.status' => 0);
        }
        $this->set(compact('permission'));
        $this->viewBuilder()->layout('backend');
        $this->set('content_title', "Corporate Members");
        $this->paginate = [
            'contain' => ['CorporateMembers'],
            'conditions' => ['Users.role_id' => 3, $statusCond]
        ];
        $users = $this->paginate($this->Users);
        $this->set(compact('users'));
        $this->set('_serialize', ['users']);
    }

    public function employee($status = null) {
        $permission = $this->viewVars['actionPermission'];
        if ($permission == 1 || $permission == 2) {
            
        } else {
            return $this->redirect(['controller' => 'Pages', 'action' => 'welcome']);
        }
        $condition = '';
        if ($this->request->is('post')) {
            $condition = array('TalentEvents.eventcategory_id' => $this->request->data['category_id']);
            //            exit;
        }

        $this->set(compact('permission'));
        $this->viewBuilder()->layout('backend');
        $this->set('content_title', "Employee Members");
        $this->loadModel('Eventcategories');
        $eventcategories = $this->Eventcategories->find('list', ['keyField' => 'id', 'valueField' => 'title'])->toArray();
        $statusCond = '';
        if ($status == 'active') {
            $statusCond = array('Users.status' => 1);
        }
        if ($status == 'pending') {
            $statusCond = array('Users.status' => 0);
        }
        $this->paginate = [
            'contain' => ['EmployeeMembers', 'TalentEvents' => function($a)use($condition) {
                    $a->where(['deleted' => 0, $condition]);
                    return $a;
                }, 'TalentReviews' => function($q) {
                    $q->select([
                                'TalentReviews.talent_id',
                                'total' => $q->func()->count('TalentReviews.talent_id')
                            ])
                            ->group(['TalentReviews.talent_id']);
                    return $q;
                }, 'TalentCalendars' => function($r) {
                    $r->select([
                                'TalentCalendars.user_id',
                                'total_calendars' => $r->func()->count('TalentCalendars.user_id')
                            ])
                            ->group(['TalentCalendars.user_id']);
                    return $r;
                }],
            'conditions' => ['Users.role_id' => 4, $statusCond]
        ];
        $users = $this->paginate($this->Users);

//                debug($users);exit;
        $this->loadModel('States');
        $states = $this->States->find('list', ['keyField' => 'id', 'valueField' => 'statename'])->toArray();
        $this->set(compact('users', 'eventcategories', 'states'));
        $this->set('_serialize', ['users']);
    }

    public function viewcalendar($user_id = null) {
        $this->viewBuilder()->layout('backend');
        $permission = $this->viewVars['actionPermission'];

        if ($permission == 2) {
            
        } else {
            return $this->redirect(['controller' => 'Pages', 'action' => 'welcome']);
        }
        $this->set('content_title', 'Calendar Edit');
        $this->loadModel('TalentCalendars');
        $this->paginate = [
            'contain' => ['Users', 'TalentEvents.Eventcategories', 'TalentEvents.TalentEventSubcategories.Eventsubcategories' => function($r) {
                    $r->select([
                                'title' => 'group_concat(title)'
                            ])
                            ->group(['title']);
                    return $r;
                }],
            'conditions' => ['TalentCalendars.user_id' => $user_id]
        ];
        $calendars = $this->paginate($this->TalentCalendars);
        //                debug($calendars);
        //                exit();
        $this->set(compact('calendars', 'permission'));
    }

    public function getdate() {
        $this->loadModel('TalentCalendars');
        $date = $this->TalentCalendars->get($_GET['id']);
        echo json_encode(date('m/d/Y', strtotime($date->date)));
        exit();
    }

    public function editcalendar() {
        $calendars = TableRegistry::get('TalentCalendars');
        $calandar = $calendars->get($_GET['id']);

        $calandar->date = date('Y-m-d', strtotime($_GET['message']));
        //        debug($cities);
        //        exit;
        if ($calendars->save($calandar)) {
            $_GET['message'] = date("M d, Y", strtotime($_GET['message']));
            echo json_encode($_GET);
        } else {
            echo 'error';
        }
        exit();
    }

    public function viewreviews($user_id = null) {
        $this->viewBuilder()->layout('backend');
        $permission = $this->viewVars['actionPermission'];

        if ($permission == 1 || $permission == 2) {
            
        } else {
            return $this->redirect(['controller' => 'Pages', 'action' => 'welcome']);
        }
        $this->set('content_title', 'Service Reviews');
        $this->set(compact('permission'));
        $this->loadModel('TalentReviews');
        $this->paginate = [
            'contain' => ['TalentEvents', 'TalentEvents.Eventcategories'],
            'conditions' => ['talent_id' => $user_id]
        ];
        $reviews = $this->paginate($this->TalentReviews);
        $users_list = $this->Users->find('list', ["keyField" => "id", 'valueField' => function ($row) {
                        return $row['first_name'] . ' ' . $row['last_name'];
                    }])->toArray();


        $this->set(compact('users_list', 'reviews'));
    }

    public function editReview() {
        $cities = TableRegistry::get('TalentReviews');
        $city = $cities->get($_GET['id']);

        $city->review = $_GET['message'];
        //        debug($cities);
        //        exit;
        if ($cities->save($city)) {
            echo json_encode($_GET);
        } else {
            echo 'error';
        }
        exit();
    }

    public function viewcorporate($id = null) {
        $permission = $this->viewVars['actionPermission'];

        if ($permission == 1 || $permission == 2) {
            
        } else {
            return $this->redirect(['controller' => 'Pages', 'action' => 'welcome']);
        }
        $this->set(compact('permission'));
        $user = $this->Users->get($id, [
            'contain' => ['CorporateMembers']
        ]);
        //debug($user);exit;
        $this->set('user', $user);
        $this->viewBuilder()->setLayout('backend');
    }

    public function viewemployee($id = null) {
        $this->loadModel('Eventcategories');
        $eventcategories = $this->Eventcategories->find('list', ['keyField' => 'id', 'valueField' => 'title'])->toArray();

        $user = $this->Users->get($id, [
            'contain' => ['EmployeeMembers']
        ]);
        //        debug($user);
        //        exit;
        $this->set(compact('user', 'eventcategories'));
        $this->viewBuilder()->setLayout('backend');
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {

        $permission = $this->viewVars['actionPermission'];

        if ($permission == 1 || $permission == 2) {
            
        } else {
            return $this->redirect(['controller' => 'Pages', 'action' => 'welcome']);
        }
        $this->set(compact('permission'));

        $user = $this->Users->get($id, [
            'contain' => []
        ]);

        $this->set('user', $user);
        $this->set('_serialize', ['user']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add() {

        $permission = $this->viewVars['actionPermission'];

        if ($permission == 2) {
            
        } else {
            return $this->redirect(['controller' => 'Pages', 'action' => 'welcome']);
        }
        $this->set(compact('permission'));

        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {

        $permission = $this->viewVars['actionPermission'];

        if ($permission == 2) {
            
        } else {
            return $this->redirect(['controller' => 'Pages', 'action' => 'welcome']);
        }
        $this->set(compact('permission'));

        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {

        $permission = $this->viewVars['actionPermission'];

        if ($permission == 2) {
            
        } else {
            return $this->redirect(['controller' => 'Pages', 'action' => 'welcome']);
        }
        $this->set(compact('permission'));

        $this->request->allowMethod(['post', 'delete', 'get']);
        $user = $this->Users->get($id);

        if ($this->Users->delete($user)) {
            //STORE LOGS
            $this->loadModel('Logs');

            $userId = $this->request->session()->read('Auth.User.id');
            $roleId = $this->request->session()->read('Auth.User.role_id');

            $findRole = $this->Users->get($userId, [
                'contain' => ['Roles']
            ]);

            $roleName = $findRole->role->name;
            $activity = 'User Deleted';
            $deletedUser = $user->full_name;
            $note = $roleName . ' deleted the user (' . $deletedUser . ')';
            $logs = $this->Logs->newEntity();
            $this->request->data['Log']['user_id'] = $userId;
            $this->request->data['Log']['activity'] = $activity;
            $this->request->data['Log']['note'] = $note;

            $logs = $this->Logs->patchEntity($logs, $this->request->data['Log']);

            if ($this->Logs->save($logs)) {
                $this->Flash->success(__('The user has been deleted.'));
                return $this->redirect(['controller' => 'users', 'action' => 'users_list']);
            } else {
                $this->Flash->success(__('The user has been deleted.'));
                return $this->redirect(['controller' => 'users', 'action' => 'users_list']);
            }
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function deleteEmployee($id = null) {
        //        debug($id);exit();

        $permission = $this->viewVars['actionPermission'];
        if ($permission == 2) {
            
        } else {
            return $this->redirect(['controller' => 'Pages', 'action' => 'welcome']);
        }
        $this->set(compact('permission'));

        $this->request->allowMethod(['post', 'delete', 'get']);
        $user = $this->Users->get($id);

        if ($this->Users->delete($user)) {

            //STORE LOGS
            $this->loadModel('Logs');

            $userId = $this->request->session()->read('Auth.User.id');
            $roleId = $this->request->session()->read('Auth.User.role_id');

            $findRole = $this->Users->get($userId, [
                'contain' => ['Roles']
            ]);
            $roleName = $findRole->role->name;
            $activity = 'User Deleted';
            $deletedUser = $user->full_name;
            $note = $roleName . ' deleted the Employee (' . $deletedUser . ')';
            $logs = $this->Logs->newEntity();
            $this->request->data['Log']['user_id'] = $userId;
            $this->request->data['Log']['activity'] = $activity;
            $this->request->data['Log']['note'] = $note;

            $logs = $this->Logs->patchEntity($logs, $this->request->data['Log']);

            if ($this->Logs->save($logs)) {
                $this->Flash->success(__('The user has been deleted.'));
                return $this->redirect(['controller' => 'users', 'action' => 'employee']);
            } else {
                $this->Flash->success(__('The user has been deleted.'));
                return $this->redirect(['controller' => 'users', 'action' => 'employee']);
            }
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'employee']);
    }

    public function addAdmin() {
        $permission = $this->viewVars['actionPermission'];

        if ($permission == 2) {
            
        } else {
            return $this->redirect(['controller' => 'Pages', 'action' => 'welcome']);
        }


        $this->loadModel('Roles');
        $this->loadModel('Companies');
        $roleList = $this->Roles->find('list', [
                    'keyField' => 'id',
                    'valueField' => 'name',
                    'conditions' => [
                        'Roles.name NOT IN' => ['INDIVIDUAL MEMBER', 'CORPORATE MEMBER', 'EMPLOYEE']
                    ]
                ])->toArray();

        $companyList = $this->Companies->find('list', [
                    'keyField' => 'id',
                    'valueField' => 'companyname'
                ])->toArray();
        $this->loadModel('States');
        $states = $this->States->find('list')->toArray();


        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {

            if (isset($this->request->data['photo']['name']) && $this->request->data['photo']['name'] != "") {
                $ext = strrchr($this->request->data['photo']['name'], '.');
                $user_image = $this->request->data['first_name'] . time() . $ext;
                $source = $this->request->data['photo']['tmp_name'];
                $destination = WWW_ROOT . 'img' . DS . 'users' . DS . $user_image;
                $this->request->data['User']['profile_image'] = $user_image;
            } else {

                $this->request->data['User']['profile_image'] = "nouser.jpg";
            }


            $this->request->data['User']['role_id'] = $this->request->data['role_id'];
            $this->request->data['User']['first_name'] = ucwords(strtolower($this->request->data['first_name']));
            $this->request->data['User']['last_name'] = ucwords(strtolower($this->request->data['last_name']));
            $this->request->data['User']['user_name'] = $this->request->data['user_name'];
            $this->request->data['User']['email'] = strtolower($this->request->data['email']);
            $this->request->data['User']['password'] = $this->request->data['password'];
            $this->request->data['User']['phone1'] = $this->request->data['phone1'];
            $this->request->data['User']['address1'] = strtolower($this->request->data['address1']);
            $this->request->data['User']['address2'] = strtolower($this->request->data['address2']);
            $this->request->data['User']['city'] = ucwords(strtolower($this->request->data['city']));
            $this->request->data['User']['state'] = strtoupper($this->request->data['state']);
            $this->request->data['User']['zip'] = $this->request->data['zip'];
            $this->request->data['User']['phone2'] = $this->request->data['phone2'];
            $this->request->data['User']['gender'] = $this->request->data['gender'];
            //            $this->request->data['User']['status'] = 1;

            $user = $this->Users->patchEntity($user, $this->request->data['User']);
            if ($this->Users->save($user)) {
                $this->generate_thumb($source, $destination, 200, 200);
                //STORE LOGS
                $this->loadModel('Logs');

                $userId = $this->request->session()->read('Auth.User.id');
                $roleId = $this->request->session()->read('Auth.User.role_id');

                $findRole = $this->Users->get($userId, [
                    'contain' => ['Roles']
                ]);

                $roleName = $findRole->role->name;
                $userName = $this->request->data['user_name'];
                $activity = 'User Added';

                $note = $roleName . ' added a user (' . $userName . ').';

                $logs = $this->Logs->newEntity();
                $this->request->data['Log']['user_id'] = $userId;
                $this->request->data['Log']['activity'] = $activity;
                $this->request->data['Log']['note'] = $note;

                $logs = $this->Logs->patchEntity($logs, $this->request->data['Log']);

                if ($this->Logs->save($logs)) {
                    $this->Flash->success(__('The user has been saved.'));

                    return $this->redirect(['controller' => 'users', 'action' => 'users_list']);
                }

                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['controller' => 'users', 'action' => 'users_list']);
            }
            if ($user->errors()) {
                $model_error = $user->errors();

                if ($model_error['user_name']['_isUnique'] != "") {
                    $this->Flash->error(__($model_error['user_name']['_isUnique']));
                } elseif ($model_error['email']['_isUnique'] != "") {
                    $this->Flash->error(__($model_error['email']['_isUnique']));
                }
            } else {
                $this->Flash->error(__('The user could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('user'));
        $this->set(compact('roleList', 'companyList', 'states'));
        $this->viewBuilder()->setLayout('backend');
    }

    public function fetchCities() {
        $city = $_GET['field'];
        $this->loadModel('Cities');
        $cities = $this->Cities->find('list', ['keyField' => 'id', 'valueField' => 'city', 'conditions' => ['city LIKE' => '%' . $city . '%'], 'limit' => 10, 'order' => 'city'])
                ->group('city')
                ->toArray();
        echo json_encode($cities);
        exit;
    }

    public function searchStates() {
        $conn = ConnectionManager::get('default');
        $query = 'SELECT s.id,s.statename FROM `cities` AS `c` JOIN `states` as `s` ON c.state_code=s.state_abbrv WHERE c.city LIKE "' . $_GET['field'] . '" ';
        $result = $conn->execute($query);
        $row = $result->fetchAll('assoc');
        echo json_encode($row);
        exit();
    }

    public function editUser($id = null) {
        $user = $this->Users->get($id);
        $permission = $this->viewVars['actionPermission'];

        if ($permission == 2) {
            
        } else {
            return $this->redirect(['controller' => 'Pages', 'action' => 'welcome']);
        }
        $this->loadModel('States');
        $states = $this->States->find('list')->toArray();

        $this->set(compact('permission', 'states'));

        $this->loadModel('Roles');
        $roleList = $this->Roles->find('list', [
                    'keyField' => 'id',
                    'valueField' => 'name'
                ])->toArray();
        if ($this->request->is(['patch', 'post', 'put'])) {

            if (isset($this->request->data['image']['name']) && $this->request->data['image']['name'] != "") {
                $ext = strrchr($this->request->data['image']['name'], '.');
                $user_image = $this->request->data['first_name'] . time() . $ext;
                $source = $this->request->data['image']['tmp_name'];
                $destination = WWW_ROOT . 'img' . DS . 'users' . DS . $user_image;
                $this->request->data['User']['profile_image'] = $user_image;
            }
            if ($this->request->data['image']['name'] == "") {
                unset($this->request->data['User']['profile_image']);
            }
            if ($this->request->data['phone2'] == "") {
                unset($this->request->data['User']['phone2']);
            }


            $this->request->data['User']['role_id'] = $this->request->data['role_id'];
            $this->request->data['User']['first_name'] = ucwords(strtolower($this->request->data['first_name']));
            $this->request->data['User']['last_name'] = ucwords(strtolower($this->request->data['last_name']));
            $this->request->data['User']['user_name'] = $this->request->data['user_name'];
            $this->request->data['User']['email'] = strtolower($this->request->data['email']);
            $this->request->data['User']['password'] = $this->request->data['pwd'];
            $this->request->data['User']['phone1'] = $this->request->data['phone1'];
            $this->request->data['User']['address1'] = strtolower($this->request->data['address1']);
            $this->request->data['User']['address2'] = strtolower($this->request->data['address2']);
            $this->request->data['User']['city'] = ucwords(strtolower($this->request->data['city']));
            $this->request->data['User']['state'] = strtoupper($this->request->data['state']);
            $this->request->data['User']['zip'] = $this->request->data['zip'];

            $this->request->data['User']['gender'] = $this->request->data['gender'];
            //            $this->request->data['User']['status'] = $this->request->data['status'];
            if ($this->request->data['pwd'] == "") {
                unset($this->request->data['User']['password']);
            }

            $user = $this->Users->patchEntity($user, $this->request->data['User']);


            if ($this->Users->save($user)) {
                if (isset($this->request->data['image']['name']) && $this->request->data['image']['name'] != "") {
                    $this->generate_thumb($source, $destination, 200, 200);
                }

                //STORE LOGS
                $this->loadModel('Logs');

                $userId = $this->request->session()->read('Auth.User.id');
                $roleId = $this->request->session()->read('Auth.User.role_id');

                $findRole = $this->Users->get($userId, [
                    'contain' => ['Roles']
                ]);
                $roleName = $findRole->role->name;

                $activity = 'User Profile Updated';
                $updatedUserName = $this->request->data['first_name'] . ' ' . $this->request->data['last_name'];

                $note = $roleName . ' updated the user profile of (' . $updatedUserName . ')';

                $logs = $this->Logs->newEntity();
                $this->request->data['Log']['user_id'] = $userId;
                $this->request->data['Log']['activity'] = $activity;
                $this->request->data['Log']['note'] = $note;

                $logs = $this->Logs->patchEntity($logs, $this->request->data['Log']);

                if ($this->Logs->save($logs)) {
                    $this->Flash->success(__('The user has been saved.'));

                    return $this->redirect(['controller' => 'users', 'action' => 'users_list']);
                }

                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['controller' => 'users', 'action' => 'users_list']);
            }
            if ($user->errors()) {
                $model_error = $user->errors();
                if ($model_error['user_name']['_isUnique'] != "") {
                    $this->Flash->error(__($model_error['user_name']['_isUnique']));
                } elseif ($model_error['email']['_isUnique'] != "") {
                    $this->Flash->error(__($model_error['email']['_isUnique']));
                }
            } else {
                $this->Flash->error(__('The user could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('user'));
        $this->set(compact('roleList', 'companyList'));
        $this->viewBuilder()->setLayout('backend');
    }

    public function editcorporate($id = null) {
        $this->loadModel('CorporateMembers');
        $user = $this->Users->get($id, ['contain' => ['CorporateMembers']]);

        $this->set('content_title', 'Edit corporate');
        $permission = $this->viewVars['actionPermission'];

        if ($permission == 2) {
            
        } else {
            return $this->redirect(['controller' => 'Pages', 'action' => 'welcome']);
        }
        $this->set(compact('permission'));

        $this->loadModel('Roles');
        $roleList = $this->Roles->find('list', [
                    'keyField' => 'id',
                    'valueField' => 'name'
                ])->toArray();
        if ($this->request->is(['patch', 'post', 'put'])) {
            if (isset($this->request->data['image']['name']) && $this->request->data['image']['name'] != "") {
                $ext = strrchr($this->request->data['image']['name'], '.');
                $user_image = $this->request->data['company_name'] . time() . $ext;
                $source = $this->request->data['image']['tmp_name'];
                $destination = WWW_ROOT . 'img' . DS . 'users' . DS . $user_image;
                $this->request->data['User']['profile_image'] = $user_image;
            } else {
                unset($this->request->data['User']['profile_image']);
            }
            if ($this->request->data['password']) {
                $hasher = new DefaultPasswordHasher();
                $this->request->data['User']['password'] = $hasher->hash($this->request->data['password']);
            } else {
                unset($this->request->data['password']);
            }
            $this->request->data['User']['email'] = $this->request->data['email'];
            $user = $this->Users->patchEntity($user, $this->request->data['User']);
            if ($this->Users->save($user)) {
                if (isset($this->request->data['image']['name']) && $this->request->data['image']['name'] != "") {
                    $this->generate_thumb($source, $destination, 200, 200);
                }
            }

            $this->request->data['CorporateMembers']['job_title'] = $this->request->data['job_title'];
            $this->request->data['CorporateMembers']['company_name'] = $this->request->data['company_name'];
            $this->request->data['CorporateMembers']['company_address'] = $this->request->data['company_address'];
            $this->request->data['CorporateMembers']['company_phone'] = $this->request->data['company_phone'];
            $this->request->data['CorporateMembers']['is_authorize'] = $this->request->data['is_authorized'];
            $this->request->data['CorporateMembers']['authorizer_first_name'] = $this->request->data['authorizer_first_name'];
            $this->request->data['CorporateMembers']['authorizer_last_name'] = $this->request->data['authorizer_last_name'];
            $this->request->data['CorporateMembers']['authorizer_job_title'] = $this->request->data['authorizer_job_title'];
            $this->request->data['CorporateMembers']['authorizer_email'] = $this->request->data['authorizer_email'];
            $this->request->data['CorporateMembers']['authorizer_phone'] = $this->request->data['authorizer_phone'];

            $corporate_member = $this->CorporateMembers->patchEntity($user->corporate_member, $this->request->data['CorporateMembers']);

            $this->CorporateMembers->save($corporate_member);
            //STORE LOGS
            $this->loadModel('Logs');
            $userId = $this->request->session()->read('Auth.User.id');
            $findRole = $this->Users->get($userId, [
                'contain' => ['Roles']
            ]);
            $roleName = $findRole->role->name;

            $activity = 'Corporate Profile Updated';
            $updatedUserName = $this->request->data['company_name'];

            $note = $roleName . ' updated the user profile of (' . $updatedUserName . ')';

            $logs = $this->Logs->newEntity();
            $this->request->data['Log']['user_id'] = $userId;
            $this->request->data['Log']['activity'] = $activity;
            $this->request->data['Log']['note'] = $note;

            $logs = $this->Logs->patchEntity($logs, $this->request->data['Log']);

            if ($this->Logs->save($logs)) {
                $this->Flash->success(__('The user has been saved.'));
                if ($user->role_id == 2) {
                    return $this->redirect(['controller' => 'users', 'action' => 'individuals']);
                } elseif ($user->role_id == 3) {
                    return $this->redirect(['controller' => 'users', 'action' => 'corporate']);
                } else {
                    return $this->redirect(['controller' => 'users', 'action' => 'users_list']);
                }
            }
        }
        $this->set(compact('user'));
        $this->set(compact('roleList', 'companyList'));
        $this->viewBuilder()->setLayout('backend');
    }

    public function editemployee($id = null) {
        $this->loadModel('EmployeeMembers');
        $user = $this->Users->get($id, ['contain' => ['EmployeeMembers']]);

        $this->set('content_title', 'Edit Employee');
        $permission = $this->viewVars['actionPermission'];

        if ($permission == 2) {
            
        } else {
            return $this->redirect(['controller' => 'Pages', 'action' => 'welcome']);
        }
        $this->set(compact('permission'));

        $this->loadModel('Roles');
        $roleList = $this->Roles->find('list', [
                    'keyField' => 'id',
                    'valueField' => 'name'
                ])->toArray();
        $this->loadModel('Eventcategories');
        $eventcategories = $this->Eventcategories->find('list', ['keyField' => 'id', 'valueField' => 'title'])->toArray();

        if ($this->request->is(['patch', 'post', 'put'])) {
            if (isset($this->request->data['Users']['image']['name']) && $this->request->data['Users']['image']['name'] != "") {
                $ext = strrchr($this->request->data['Users']['image']['name'], '.');
                $user_image = $this->request->data['Users']['first_name'] . time() . $ext;
                $source = $this->request->data['Users']['image']['tmp_name'];
                $destination = WWW_ROOT . 'img' . DS . 'users' . DS . $user_image;
                $this->request->data['Users']['profile_image'] = $user_image;
            } else {
                unset($this->request->data['Users']['profile_image']);
            }
            if ($this->request->data['Users']['password']) {
                $hasher = new DefaultPasswordHasher();
                $this->request->data['Users']['password'] = $hasher->hash($this->request->data['Users']['password']);
            } else {
                unset($this->request->data['password']);
            }

            $user = $this->Users->patchEntity($user, $this->request->data['Users']);
            if ($this->Users->save($user)) {

                if (isset($this->request->data['Users']['image']['name']) && $this->request->data['Users']['image']['name'] != "") {
                    $this->generate_thumb($source, $destination, 200, 200);
                }
            }

            $employee_member = $this->EmployeeMembers->patchEntity($user->employee_member, $this->request->data['EmployeeMembers']);

            $this->EmployeeMembers->save($employee_member);
            //STORE LOGS
            $this->loadModel('Logs');
            $userId = $this->request->session()->read('Auth.User.id');
            $findRole = $this->Users->get($userId, [
                'contain' => ['Roles']
            ]);
            $roleName = $findRole->role->name;

            $activity = 'Employee Profile Updated';
            $updatedUserName = $this->request->data['Users']['first_name'] . ' ' . $this->request->data['Users']['last_name'];

            $note = $roleName . ' updated the user profile of (' . $updatedUserName . ')';

            $logs = $this->Logs->newEntity();
            $this->request->data['Log']['user_id'] = $userId;
            $this->request->data['Log']['activity'] = $activity;
            $this->request->data['Log']['note'] = $note;

            $logs = $this->Logs->patchEntity($logs, $this->request->data['Log']);

            if ($this->Logs->save($logs)) {
                $this->Flash->success(__('The user has been saved.'));
                if ($user->role_id == 2) {
                    return $this->redirect(['controller' => 'users', 'action' => 'individuals']);
                } elseif ($user->role_id == 3) {
                    return $this->redirect(['controller' => 'users', 'action' => 'corporate']);
                } elseif ($user->role_id == 4) {
                    return $this->redirect(['controller' => 'users', 'action' => 'employee']);
                } else {
                    return $this->redirect(['controller' => 'users', 'action' => 'users_list']);
                }
            }
        }
        $this->set(compact('user', 'eventcategories'));
        $this->set(compact('roleList', 'companyList'));
        $this->viewBuilder()->setLayout('backend');
    }

    public function usersList() {
        $permission = $this->viewVars['actionPermission'];

        if ($permission == 1 || $permission == 2) {
            
        } else {
            return $this->redirect(['controller' => 'Pages', 'action' => 'welcome']);
        }
        $this->set(compact('permission'));

        $userId = $this->request->session()->read('Auth.User.id');

        $findRole = $this->Users->get($userId, [
            'contain' => ['Roles']
        ]);

        $loginRole = $findRole->role->name;

        if ($loginRole == "SUPERADMIN") {
            $this->paginate = [
                'contain' => ['Roles'],
                'conditions' => ['Users.status' => 1]];
        } else {
            $this->paginate = [
                'contain' => ['Roles' => ['conditions' => ['Roles.name !=' => 'SUPERADMIN']]],
                'conditions' => ['Users.status' => 1]];
        }

        $users = $this->paginate($this->Users);

        $this->set(compact('users'));
        $this->viewBuilder()->setLayout('backend');
    }

    public function viewProfile($id = null) {

        $permission = $this->viewVars['actionPermission'];

        if ($permission == 1 || $permission == 2) {
            
        } else {
            return $this->redirect(['controller' => 'Pages', 'action' => 'welcome']);
        }
        $this->set(compact('permission'));

        $user = $this->Users->get($id, [
            'contain' => ['Roles']
        ]);

        $this->set('user', $user);
        $this->viewBuilder()->setLayout('backend');
    }

    public function changeStatus($id = null, $status = null) {
        $users = TableRegistry::get('Users');
        $user = $users->get($id);
        $user->status = $status;
        if ($users->save($user)) {

            if ($user->status == 1) {
                $email = new Email();
                $email->template('default', 'default')
                        ->emailFormat('html')
                        ->to($user->email)
                        ->from(['info@cyberclouds.com' => 'welvett.com'])
                        ->subject('Welvet Account Verified')
                        ->viewVars(['content' => $user])
                        ->send();
            }
            $this->Flash->success('status changed');
        } else {
            $this->Flash->error('status not changed');
        }
        if ($user->role_id == 3) {
            return $this->redirect('/Users/corporate');
        } else {
            return $this->redirect('/Users/employee');
        }
    }

    public function login() {
        if ($this->request->is('Post')) {

            $user = $this->Auth->identify();


            if ($user) {

                $roleId = $user['role_id'];

                $this->loadModel('Roles');
                $userRole = $this->Roles->get($roleId);
                $controller = strtolower($userRole['name']);

                if ($user['status'] == 0) {
                    $this->Flash->error('Your account has been deactivated, contact web admin');
                    return $this->redirect($this->Auth->logout());
                }


                $this->Auth->setUser($user);
                $session = $this->request->session();
                $roleId = $user['role_id'];

                //                debug($this->permissionsList($roleId));
                //                exit();
                //STORE LOGS
                $this->loadModel('Logs');

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
                    //$this->Flash->success(__('Logged in successfully'));

                    return $this->redirect(['controller' => 'pages', 'action' => 'welcome']);
                } else {
                    //$this->Flash->success(__('Logged in successfully'));
                    return $this->redirect(['controller' => 'pages', 'action' => 'welcome']);
                }
            }
            $this->Flash->error('Incorrect Login');
        }
        $this->viewBuilder()->setLayout('login');
    }

    public function getFlightInfo() {
        
    }

    public function customerLogin($user_type = null) {
        //        debug($user_type);
        //        exit;

        include(ROOT . DS . 'vendor' . DS . 'googlelogin2' . DS . 'index.php');

        if (isset($_GET['userid']) && $_GET['userid'] !== 'undefined') {
            $_GET['userid'];
            $userid = $_GET['userid'];
            $this->request->data['loginwithsocial'] = $userid;
            $this->request->data['password'] = 'emp@tal';

            //login by Email address
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
                    $this->Flash->error('Your account is pending for admin approval');
                    return $this->redirect('/');
                }
                $this->Auth->setUser($user);
                $session = $this->request->session();

                //STORE LOGS
                $this->loadModel('Logs');

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

                    //$this->Flash->success(__('Logged in successfully'));
                    if ($roleId == 3) {
                        return $this->redirect('/Pages/categories');
                    } else if ($roleId == 2) {
                        return $this->redirect('/Pages/categories');
                    } else if ($roleId == 4) {
                        if (!$user['post_verification']) {
                            $userUpdate = $this->Users->get($user['id']);
                            $userUpdate->post_verification = 1;
                            $this->Users->save($userUpdate);

                            return $this->redirect('/Users/dashboard');
                        } else {
                            //                            $this->loadModel('Memberships');
                            //                            $membership = $this->Memberships->find('all', [
                            //                                        'conditions' => ['user_id' => $this->Auth->user('id'), 'expiry_date >' => date('Y-m-d')]
                            //                                    ])->first();
                            //                            if ($membership) {
                            //                                return $this->redirect('/EmployeeMembers/services');
                            //                            }
                            return $this->redirect('/EmployeeMembers/employee_events');
                        }
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


                $url = 'registeremployee';
                $userid = $user_info['id'];

                $this->request->data['loginwithsocial'] = $userid;
                $this->request->data['password'] = 'emp@tal';

                //login by Email address
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
                        $this->Flash->error('Your account is pending for admin approval');
                        return $this->redirect('/');
                    }


                    $this->Auth->setUser($user);
                    $session = $this->request->session();

                    //STORE LOGS
                    $this->loadModel('Logs');

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

                        //$this->Flash->success(__('Logged in successfully'));
                        if ($roleId == 3) {
                            return $this->redirect('/Pages/categories');
                        } else if ($roleId == 2) {
                            return $this->redirect('/Pages/categories');
                        } else if ($roleId == 4) {
                            if (!$user['post_verification']) {

                                $userUpdate = $this->Users->get($user['id']);
                                //                debug($user);
                                $userUpdate->post_verification = 1;
                                $this->Users->save($userUpdate);

                                return $this->redirect('/Users/dashboard');
                            } else {
                                //                                $this->loadModel('Memberships');
                                //                                $membership = $this->Memberships->find('all', [
                                //                                            'conditions' => ['user_id' => $this->Auth->user('id'), 'expiry_date >' => date('Y-m-d')]
                                //                                        ])->first();
                                //                                if ($membership) {
                                //                                    return $this->redirect('/EmployeeMembers/services');
                                //                                }
                                return $this->redirect('/EmployeeMembers/employee_events');
                            }
                        }
                    }
                } else {
                    return $this->redirect('/');
                }

                exit;
            } catch (Exception $e) {
                echo $e->getMessage();
                exit();
            }
        }

        // Google api integration
        if ($this->request->is('Post')) {
//        if (true) {
//            $this->request->data['email'] = 'mathews@cyber.co';
//            $this->request->data['password'] = 'cyber@1';
            //login by Email address
            $this->Auth->config('authenticate', [
                'Form' => [
                    'fields' => ['username' => 'email']
                ]
            ]);
            $this->Auth->constructAuthenticate();
            $user = $this->Auth->identify();
            if ($user) {
                $roleId = $user['role_id'];
                $this->loadModel('Roles');
                $userRole = $this->Roles->get($roleId);
                if ($user['status'] == 0) {
                    $this->Flash->error('Your account is pending for admin approval');
                    return $this->redirect('/');
                }


                $this->Auth->setUser($user);
                $session = $this->request->session();

                //STORE LOGS
                $this->loadModel('Logs');

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

                    if ($roleId == 3) {
                        return $this->redirect('/Pages/categories');
                    } else if ($roleId == 2) {
                        if ($user['verification_code']) {
                            $userId = base64_encode(base64_encode($user['id']));
                            return $this->redirect('/Users/verification/' . $userId);
                        }

                        return $this->redirect('/Pages/categories');
                    } else if ($roleId == 4) {
                        if (!$user['post_verification']) {

                            $userUpdate = $this->Users->get($user['id']);
                            //                debug($user);
                            $userUpdate->post_verification = 1;
                            $this->Users->save($userUpdate);

                            return $this->redirect('/Users/dashboard');
                        } else {
                            $this->loadModel('Memberships');
                            $membership = $this->Memberships->find('all', [
                                        'conditions' => ['user_id' => $this->Auth->user('id'), 'expiry_date >' => date('Y-m-d')]
                                    ])->first();
                            if ($membership) {
                                return $this->redirect('/EmployeeMembers/services');
                            }
                            return $this->redirect('/EmployeeMembers/employeeFreeevents');
                        }
                    }
                }
            }
            $this->Flash->error('Incorrect Login');
        }
        if (isset($_GET['url'])) {
            $url = $_GET['url'];
        } else if (!empty($_SERVER['HTTP_REFERER'])) {
            $urlArray = explode('/', $_SERVER['HTTP_REFERER']);
            $url = end($urlArray);
        }
        if ($user_type) {
            $url = $user_type;
            $this->set(compact('url'));
        } else {
            if ($url) {
                $this->set(compact('url'));
            } else {
                return $this->redirect('/');
            }
        }
        $this->viewBuilder()->setLayout('login');
    }

    public function verification($userId = null) {
        $userId = base64_decode(base64_decode($userId));
        if ($this->request->is('post')) {
            $userDetails = $this->Users->get($userId);
            if ($userDetails->verification_code == $this->request->data['verify']) {
                $userDetails->verification_code = null;
                $this->Users->save($userDetails);
                $this->Flash->success('You account have been verified successfully');
                return $this->redirect('/Users/customer_login/registerindividual');
            } else {
                $this->Flash->error('Invalid verification code please try again');
            }
        }
        $this->viewBuilder()->setLayout('');
    }

    public function resendCode() {

        include(ROOT . DS . 'vendor' . DS . 'aws' . DS . 'sms.php');
        $userId = base64_decode(base64_decode($_POST['value']));
        $userDetail = $this->Users->get($userId);
        $return = array();
        if ($userDetail) {
            $userDetail->verification_code = str_pad(rand(1, 9999), 4, STR_PAD_LEFT);
            if ($this->Users->save($userDetail)) {
                //                $email = new Email();
                //                $email->template('verify')
                //                    ->emailFormat('html')
                //                    ->to($userDetail->email)
                //                    ->from(['info@cyberclouds.com' => 'welvett.com'])
                //                    ->subject('welvett.com - Verification')
                //                    ->viewVars(['content' => $userDetail])
                //                    ->send();
                $message = 'Your Welvett account verification code is W-' . $userDetail->verification_code;

                $phone = $userDetail->phone1;
                // debug($phone);exit;

                try {
                    $result = $SnSclient->publish([
                        'Message' => $message,
                        'PhoneNumber' => $phone,
                    ]);
                    // var_dump($result);
                } catch (AwsException $e) {
                    // output error message if fails
                    error_log($e->getMessage());
                }



                $return = array('flag' => 1, 'message' => 'We have sent you a verification code on your phone number, please enter the verification code below to complete the registration.');
            } else {
                $return = array('flag' => 0, 'message' => 'Code can not be send please try again');
            }
        } else {
            $return = array('flag' => 0, 'message' => 'invalid Record');
        }
        echo json_encode($return);
        exit;
    }

    public function employeeLogin() {


        if ($this->request->is('Post')) {

            $this->request->data['loginwithsocial'] = $this->request->data['email'];
            $this->request->data['password'] = '12345';

            //login by Email address
            $this->Auth->config('authenticate', [
                'Form' => [
                    'fields' => ['username' => 'loginwithsocial']
                ]
            ]);
            $this->Auth->constructAuthenticate();
            $user = $this->Auth->identify();
            debug($user);
            exit();
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

                    //$this->Flash->success(__('Logged in successfully'));
                    if ($roleId == 3) {
                        return $this->redirect('/CorporateMembers/corporate_events');
                    } else if ($roleId == 2) {
                        return $this->redirect(['action' => 'individualEvents']);
                    } else if ($roleId == 4) {
                        return $this->redirect('/EmployeeMembers/employeeFreeevents');
                    }
                }
            }
            $this->Flash->error('Incorrect Login');
        }
        $this->viewBuilder()->setLayout('login');
    }

    public function logout() {
        $session = $this->request->session();
        //$session->write('KCFINDER.disabled',true);
        //STORE LOGS
        $this->loadModel('Logs');

        $userId = $this->request->session()->read('Auth.User.id');
        if ($userId) {
            $roleId = $this->request->session()->read('Auth.User.role_id');

            $findRole = $this->Users->get($userId, [
                'contain' => ['Roles']
            ]);

            $roleName = $findRole->role->name;
            $activity = $roleName . ' Logout';

            $note = 'User logged out with the role of ' . $roleName;

            $logs = $this->Logs->newEntity();
            $this->request->data['Log']['user_id'] = $userId;
            $this->request->data['Log']['activity'] = $activity;
            $this->request->data['Log']['note'] = $note;

            $logs = $this->Logs->patchEntity($logs, $this->request->data['Log']);

            if ($this->Logs->save($logs)) {
                if (!$this->Auth->user('post_verification')) {
                    $user = $this->Users->get($userId);
                    //                debug($user);
                    $user->post_verification = 1;
                    $this->Users->save($user);
                }
                //            exit();
                $session->destroy();

                $this->Flash->success(__('Logged out successfully'));
                if ($this->Auth->user('role_id') == 3 || $this->Auth->user('role_id') == 2 || $this->Auth->user('role_id') == 4) {
                    $this->Auth->logout();
                    return $this->redirect('/');
                } else {
                    return $this->redirect($this->Auth->logout());
                }
            }
            $session->destroy();
            $this->Flash->success(__('Logged out successfully'));
            if ($roleId == 5) {

                $this->updateflag(0);
            }
        }
        return $this->redirect($this->Auth->logout());
    }

    public function personalProfile($id = null) {


        $permission = $this->viewVars['actionPermission'];

        if ($permission == 1 || $permission == 2) {
            
        } else {
            return $this->redirect(['controller' => 'Pages', 'action' => 'welcome']);
        }
        $this->set(compact('permission'));

        $roleId = $this->request->session()->read('Auth.User.role_id');
        $this->loadModel('Roles');
        $roleList = $this->Roles->find('list', [
                    'keyField' => 'id',
                    'valueField' => 'name',
                    'conditions' => ['Roles.id' => $roleId]
                ])->toArray();

        $user = $this->Users->get($id, [
            'contain' => []
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {

            if (isset($this->request->data['image']['name']) && $this->request->data['image']['name'] != "") {
                $ext = strrchr($this->request->data['image']['name'], '.');
                $user_image = $this->request->data['first_name'] . time() . $ext;
                $source = $this->request->data['image']['tmp_name'];
                $destination = WWW_ROOT . 'img' . DS . 'users' . DS . $user_image;
                $this->request->data['User']['profile_image'] = $user_image;
            }
            if ($this->request->data['image']['name'] == "") {
                unset($this->request->data['User']['profile_image']);
            }

            $this->request->data['User']['role_id'] = $this->request->data['role_id'];
            $this->request->data['User']['first_name'] = $this->request->data['first_name'];
            $this->request->data['User']['last_name'] = $this->request->data['last_name'];
            $this->request->data['User']['user_name'] = $this->request->data['user_name'];
            $this->request->data['User']['email'] = $this->request->data['email'];
            $this->request->data['User']['password'] = $this->request->data['pwd'];
            $this->request->data['User']['phone1'] = $this->request->data['phone1'];
            $this->request->data['User']['address1'] = $this->request->data['address1'];
            $this->request->data['User']['address2'] = $this->request->data['address2'];
            $this->request->data['User']['city'] = $this->request->data['city'];
            $this->request->data['User']['state'] = $this->request->data['state'];
            $this->request->data['User']['zip'] = $this->request->data['zip'];
            $this->request->data['User']['phone2'] = $this->request->data['phone2'];
            $this->request->data['User']['gender'] = $this->request->data['gender'];
            //            $this->request->data['User']['status'] = $this->request->data['status'];
            if ($this->request->data['pwd'] == "") {
                unset($this->request->data['User']['password']);
            }
            $user = $this->Users->patchEntity($user, $this->request->data['User']);

            if ($this->Users->save($user)) {
                if (isset($this->request->data['image']['name']) && $this->request->data['image']['name'] != "") {
                    $this->generate_thumb($source, $destination, 200, 200);
                }


                //STORE LOGS
                $this->loadModel('Logs');

                $userId = $this->request->session()->read('Auth.User.id');
                $roleId = $this->request->session()->read('Auth.User.role_id');

                $findRole = $this->Users->get($userId, [
                    'contain' => ['Roles']
                ]);

                $roleName = $findRole->role->name;

                $activity = 'User Profile Updated';
                $updatedUserName = $this->request->data['first_name'] . ' ' . $this->request->data['last_name'];

                $note = $roleName . ' updated the user profile of (' . $updatedUserName . ')';
                $logs = $this->Logs->newEntity();
                $this->request->data['Log']['user_id'] = $userId;
                $this->request->data['Log']['activity'] = $activity;
                $this->request->data['Log']['note'] = $note;

                $logs = $this->Logs->patchEntity($logs, $this->request->data['Log']);

                if ($this->Logs->save($logs)) {
                    $this->Flash->success(__('The user has been saved.'));

                    return $this->redirect(['controller' => 'users', 'action' => 'users_list']);
                }

                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['controller' => 'users', 'action' => 'users_list']);
            }
            if ($user->errors()) {
                $model_error = $user->errors();
                if ($model_error['username']['_isUnique'] != "") {
                    $this->Flash->error(__($model_error['username']['_isUnique']));
                } elseif ($model_error['email']['_isUnique'] != "") {
                    $this->Flash->error(__($model_error['email']['_isUnique']));
                }
            } else {
                $this->Flash->error(__('The user could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('user'));
        $this->set(compact('roleList'));
        $this->viewBuilder()->setLayout('backend');
    }

    public function addCustomer() {

        $this->loadModel('Roles');
        $roleList = $this->Roles->find('list', [
                    'keyField' => 'id',
                    'valueField' => 'name'
                ])->toArray();

        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {

            if (isset($this->request->data['photo']['name']) && $this->request->data['photo']['name'] != "") {
                $ext = strrchr($this->request->data['photo']['name'], '.');
                $user_image = $this->request->data['first_name'] . time() . $ext;
                $source = $this->request->data['photo']['tmp_name'];
                $destination = WWW_ROOT . 'img' . DS . 'users' . DS . $user_image;
                $this->request->data['User']['profile_image'] = $user_image;
            } else {

                $this->request->data['User']['profile_image'] = "nouser.jpg";
            }


            $this->loadModel('Roles');
            $role = $this->Roles->find('all', [
                        'conditions' => ['Roles.name' => 'CUSTOMER']
                    ])->first();
            $this->request->data['User']['role_id'] = $role['id'];
            $this->request->data['User']['first_name'] = $this->request->data['first_name'];
            $this->request->data['User']['last_name'] = $this->request->data['last_name'];
            $this->request->data['User']['user_name'] = $this->request->data['user_name'];
            $this->request->data['User']['email'] = $this->request->data['email'];
            $this->request->data['User']['password'] = $this->request->data['password'];
            $this->request->data['User']['phone1'] = $this->request->data['phone1'];
            $this->request->data['User']['address1'] = $this->request->data['address1'];
            $this->request->data['User']['address2'] = $this->request->data['address2'];
            $this->request->data['User']['city'] = $this->request->data['city'];
            $this->request->data['User']['state'] = $this->request->data['state'];
            $this->request->data['User']['zip'] = $this->request->data['zip'];
            $this->request->data['User']['phone2'] = $this->request->data['phone2'];
            $this->request->data['User']['gender'] = $this->request->data['gender'];
            //            $this->request->data['User']['status'] = 1;

            $user = $this->Users->patchEntity($user, $this->request->data['User']);

            if ($this->Users->save($user)) {

                if (isset($this->request->data['photo']['name']) && $this->request->data['photo']['name'] != "") {
                    $this->generate_thumb($source, $destination, 200, 200);
                }
                //STORE LOGS
                $this->loadModel('Logs');
                $name = $this->request->data['first_name'] . ' ' . $this->request->data['last_name'];
                $userName = $this->request->data['user_name'];

                $userId = $this->request->session()->read('Auth.User.id');
                if ($userId != "") {
                    $roleId = $this->request->session()->read('Auth.User.role_id');

                    $findRole = $this->Users->get($userId, [
                        'contain' => ['Roles']
                    ]);

                    $roleName = $findRole->role->name;
                    $activity = 'Customer Registration';

                    $note = $roleName . ' registered a customer. The customer user name is (' . $userName . ').';
                } else {
                    $activity = 'Customer Self Registration';

                    $note = $name . ' is registered as a customer. The user name is (' . $userName . ').';
                }



                $logs = $this->Logs->newEntity();
                $this->request->data['Log']['user_id'] = $user->id;
                $this->request->data['Log']['activity'] = $activity;
                $this->request->data['Log']['note'] = $note;

                $logs = $this->Logs->patchEntity($logs, $this->request->data['Log']);

                if ($this->Logs->save($logs)) {
                    $this->Flash->success(__('The customer has been saved.'));

                    return $this->redirect(['controller' => 'Users', 'action' => 'customerLogin']);
                }

                $this->Flash->success(__('The customer has been saved.'));

                return $this->redirect(['controller' => 'Users', 'action' => 'customerLogin']);
            }

            if ($user->errors()) {
                $model_error = $user->errors();
                if ($model_error['user_name']['_isUnique'] != "") {
                    $this->Flash->error(__($model_error['user_name']['_isUnique']));
                } elseif ($model_error['email']['_isUnique'] != "") {
                    $this->Flash->error(__($model_error['email']['_isUnique']));
                }
            } else {
                $this->Flash->error(__('The customer could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('user'));
        $this->set(compact('roleList'));
        $this->viewBuilder()->setLayout('frontend');
    }

    public function editCustomer($id = null) {

        $user = $this->Users->get($id, [
            'contain' => []
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {

            if (isset($this->request->data['image']['name']) && $this->request->data['image']['name'] != "") {
                $ext = strrchr($this->request->data['image']['name'], '.');
                $user_image = $this->request->data['first_name'] . time() . $ext;
                $source = $this->request->data['image']['tmp_name'];
                $destination = WWW_ROOT . 'img' . DS . 'users' . DS . $user_image;
                $this->request->data['User']['profile_image'] = $user_image;
            }
            if ($this->request->data['image']['name'] == "") {
                unset($this->request->data['User']['profile_image']);
            }

            $this->request->data['User']['first_name'] = $this->request->data['first_name'];
            $this->request->data['User']['last_name'] = $this->request->data['last_name'];
            $this->request->data['User']['user_name'] = $this->request->data['user_name'];
            $this->request->data['User']['email'] = $this->request->data['email'];
            $this->request->data['User']['password'] = $this->request->data['pwd'];
            $this->request->data['User']['phone1'] = $this->request->data['phone1'];
            $this->request->data['User']['address1'] = $this->request->data['address1'];
            $this->request->data['User']['address2'] = $this->request->data['address2'];
            $this->request->data['User']['city'] = $this->request->data['city'];
            $this->request->data['User']['state'] = $this->request->data['state'];
            $this->request->data['User']['zip'] = $this->request->data['zip'];
            $this->request->data['User']['gender'] = $this->request->data['gender'];
            //            $this->request->data['User']['status'] = 1;
            if ($this->request->data['pwd'] == "") {
                unset($this->request->data['User']['password']);
            }
            $user = $this->Users->patchEntity($user, $this->request->data['User']);

            if ($this->Users->save($user)) {

                if (isset($this->request->data['image']['name']) && $this->request->data['image']['name'] != "") {
                    $this->generate_thumb($source, $destination, 200, 200);
                }
                //STORE LOGS
                $this->loadModel('Logs');

                $userId = $this->request->session()->read('Auth.User.id');

                $roleId = $this->request->session()->read('Auth.User.role_id');

                $findRole = $this->Users->get($userId, [
                    'contain' => ['Roles']
                ]);

                $roleName = $findRole->role->name;

                $activity = 'Customer Profile Updation';

                $userName = $this->request->data['user_name'];
                $note = $roleName . ' update the profile . The updated profile user name is ' . $userName;

                $logs = $this->Logs->newEntity();
                $this->request->data['Log']['user_id'] = $user->id;
                $this->request->data['Log']['activity'] = $activity;
                $this->request->data['Log']['note'] = $note;

                $logs = $this->Logs->patchEntity($logs, $this->request->data['Log']);

                if ($this->Logs->save($logs)) {

                    return $this->redirect(['controller' => 'Pages', 'action' => 'home']);
                }

                return $this->redirect(['controller' => 'Pages', 'action' => 'home']);
            }
            if ($user->errors()) {
                $model_error = $user->errors();
                if ($model_error['user_name']['_isUnique'] != "") {
                    $this->Flash->error(__($model_error['user_name']['_isUnique']));
                } elseif ($model_error['email']['_isUnique'] != "") {
                    $this->Flash->error(__($model_error['email']['_isUnique']));
                }
            } else {
                $this->Flash->error(__('The user could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('user'));
        $this->set(compact('roleList'));
        $this->viewBuilder()->setLayout('frontend');
    }

    public function individualEvents($status = null) {


        $userId = $this->request->session()->read('Auth.User.id');
        $title = 'Individual Events :: Welvet';
        $userInfo = $this->Users->get($userId, [
            'contain' => ['Roles']
        ]);

        if ($userInfo->role_id != 2) {
            return $this->redirect(['controller' => 'pages', 'action' => 'home']);
        }
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
            $resultNotification = $query->update()
                    ->set(['is_read' => 1])
                    ->where(['id' => $notificationId])
                    ->execute();
            $unread_notifications = $this->Notifications->find('all')
                    ->where(['customer_id' => $this->Auth->user('id'), 'is_read' => 0, 'activity_by !=' => $this->Auth->user('id')])
                    ->count();
            $this->set(compact('unread_notifications'));
        }



        $this->loadModel('States');
        $states = $this->States->find('list')->toArray();
        $this->loadModel('Bookings');
        $this->paginate = [
            'contain' => ['Payments', 'TalentEvents' => ['Eventcategories'], 'TalentReviews' => function($r)use ($userId) {
                    $r->select([
                                'talent_event_id',
                                'review',
                                'customer_id'
                            ])
                            ->where(['TalentReviews.customer_id' => $userId]);
                    return $r;
                }, 'Talents', 'Talents.EmployeeMembers', 'TalentRatings'],
            'conditions' => ['Bookings.customer_id' => $userId, $conditions],
            'order' => ['Bookings.id' => 'DESC'],
            'group' => ['Bookings.id']
        ];
        $bookings = $this->paginate($this->Bookings);

        $this->set(compact('title', 'userInfo', 'bookings', 'states'));
        $this->viewBuilder()->setLayout('dashboard');
    }

    public function instagramauth() {
        $this->viewBuilder()->setLayout('');
    }

    public function individualReviews() {

        $userId = $this->request->session()->read('Auth.User.id');
        $title = 'Individual Reviews :: Welvet';
        $userInfo = $this->Users->get($userId, [
            'contain' => ['Roles']
        ]);

        if ($userInfo->role_id != 2) {
            return $this->redirect(['controller' => 'pages', 'action' => 'home']);
        }


        $this->loadModel('CustomerReviews');
        $this->loadModel('CustomerRatings');

        $this->loadModel('States');
        $states = $this->States->find('list')->toArray();
        $this->paginate = [
            'contain' => ['TalentUsers'],
            'conditions' => ['CustomerReviews.customer_id' => $userId],
            'order' => ['CustomerReviews.id' => 'DESC']
        ];
        $reviews = $this->paginate($this->CustomerReviews);
        $this->paginate = [
            'contain' => ['Talents'],
            'conditions' => ['CustomerRatings.customer_id' => $userId],
            'order' => ['CustomerRatings.id' => 'DESC']
        ];
        $ratings = $this->paginate($this->CustomerRatings);
        $this->set(compact('title', 'ratings', 'userInfo', 'reviews', 'states'));
        $this->viewBuilder()->setLayout('dashboard');
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
            $query = "UPDATE `users` SET `" . $columnName . "` = '$data' WHERE `id` = '$userId'";
            $result = $conn->execute($query);

            //store log
            $this->loadModel('Logs');
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

            $getUserInfo = "SELECT `" . $dbField . "` FROM `users` WHERE `id` = '$userId'";
            $resultUserInfo = $conn->execute($getUserInfo);
            $row = $resultUserInfo->fetch('assoc');
            echo $columnName . ',' . $row[$dbField];
        }
    }

    public function editImage() {
        if (isset($_FILES['image']['name']) && $_FILES['image']['name'] != "") {
            $ext = strrchr($_FILES['image']['name'], '.');
            $user_image = $id = $this->Auth->user('first_name') . time() . $ext;
            $source = $_FILES['image']['tmp_name'];
            $destination = WWW_ROOT . 'img' . DS . 'users' . DS . $user_image;
            $users = TableRegistry::get('Users');
            $user = $users->get($this->Auth->user('id'));
            $user->profile_image = $user_image;
            if ($users->save($user)) {
                $this->generate_thumb($source, $destination, 400, 400);

                $userId = $this->request->session()->read('Auth.User.id');
                //store log
                $this->loadModel('Logs');
                $findRole = $this->Users->get($userId, [
                    'contain' => ['Roles']
                ]);
                $roleName = $findRole->role->name;

                $activity = 'Profile Image Updated';
                $note = $roleName . ' update the profile image';
                $logs = $this->Logs->newEntity();
                $this->request->data['Log']['user_id'] = $userId;
                $this->request->data['Log']['activity'] = $activity;
                $this->request->data['Log']['note'] = $note;

                $logs = $this->Logs->patchEntity($logs, $this->request->data['Log']);

                $this->Logs->save($logs);

                echo json_encode(array('success', $this->request->webroot . 'img/users/' . $user_image));
            } else {
                echo 'error';
            }
            exit();
        }
    }

    public function addReview() {

        if (isset($_GET['booking_id'])) {
            $this->viewBuilder()->layout('');
            $this->loadModel('Bookings');
            $event = $this->Bookings->get($_GET['booking_id']);

            if ($event) {
                $this->loadModel('TalentReviews');
                $review = $this->TalentReviews->newEntity();
                $newData = array();
                $newData['talent_id'] = $event->talent_id;
                $newData['booking_id'] = $event->id;
                $newData['review'] = $_GET['review'];
                $newData['talent_event_id'] = $event->talent_event_id;
                // log in user id 
                $newData['customer_id'] = $this->Auth->user('id');
                $review = $this->TalentReviews->patchEntity($review, $newData);
                if ($this->TalentReviews->save($review)) {
                    $userId = $this->request->session()->read('Auth.User.id');
                    //store log
                    $this->loadModel('Logs');
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

    public function messages($bookingId = null) {
        $title = 'Message :: Welvet';
        $userId = $this->request->session()->read('Auth.User.id');
        $roleId = $this->request->session()->read('Auth.User.role_id');

        if ($roleId != 2) {
            return $this->redirect(['controller' => 'pages', 'action' => 'home']);
        }

        $this->loadModel('Users');
        $this->loadModel('TalentMessages');
        $this->loadModel('Bookings');

        $talentDiscussion = $this->Bookings->find('all', [
                    'contain' => ['Talents' => ['EmployeeMembers']],
                    'conditions' => ['Bookings.customer_id' => $userId, 'Bookings.status !=' => 1],
                    'order' => ['Bookings.id' => 'DESC']
                ])->toArray();


        if ($bookingId != null) {
            $booking_detail = $this->Bookings->get($bookingId);
            $talentInfo = $this->Bookings->find('all', [
                        'contain' => ['Talents' => ['EmployeeMembers' => ['Eventcategories']]],
                        'conditions' => ['Bookings.id' => $bookingId, 'Bookings.status !=' => 1]
                    ])->toArray();

            if (count($talentInfo) > 0) {

                $talentCustomerMsgs = $this->TalentMessages->find('all', [
                            'contain' => ['Users'],
                            'conditions' => ['TalentMessages.booking_id' => $bookingId],
                            'order' => ['TalentMessages.id']
                        ])->toArray();
                TableRegistry::get('TalentMessages')->updateAll(
                        ["is_read" => 1], ["booking_id" => $bookingId, 'user_id !=' => $userId]
                );
                $this->set(compact('bookingId', 'booking_detail', 'talentInfo', 'talentCustomerMsgs'));
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
        $this->set(compact('title', 'talentDiscussion'));
        $this->viewBuilder()->setLayout('dashboard');
    }

    public function loadLatestMessages() {
        $userId = $this->request->session()->read('Auth.User.id');
        $roleId = $this->request->session()->read('Auth.User.role_id');
        $bookingId = $_POST['id'];
        $this->loadModel('Users');
        $this->loadModel('TalentMessages');
        $this->loadModel('Bookings');
        if ($roleId == 4) {
            $index = 'talent_id';
        } else {
            $index = 'customer_id';
        }
        $talentDiscussion = $this->Bookings->find('all', [
                    'contain' => ['Talents' => ['EmployeeMembers']],
                    'conditions' => ['Bookings.' . $index => $userId, 'Bookings.status !=' => 1],
                    'order' => ['Bookings.id' => 'DESC']
                ])->toArray();

        if ($bookingId != null) {
            $booking_detail = $this->Bookings->get($bookingId);
            $talentInfo = $this->Bookings->find('all', [
                        'contain' => ['Talents' => ['EmployeeMembers' => ['Eventcategories']]],
                        'conditions' => ['Bookings.id' => $bookingId, 'Bookings.status !=' => 1]
                    ])->toArray();

            if (count($talentInfo) > 0) {

                $talentCustomerMsgs = $this->TalentMessages->find('all', [
                            'contain' => ['Users'],
                            'conditions' => ['TalentMessages.booking_id' => $bookingId],
                            'order' => ['TalentMessages.id']
                        ])->toArray();
                TableRegistry::get('TalentMessages')->updateAll(
                        ["is_read" => 1], ["booking_id" => $bookingId, 'user_id !=' => $userId]
                );
                $this->set(compact('bookingId', 'booking_detail', 'talentInfo', 'talentCustomerMsgs'));
            }
        }

        $this->set(compact('title', 'talentDiscussion'));
        $this->viewBuilder()->setLayout('');
    }

    public function saveMessage() {
        if (isset($_POST['message']) && isset($_POST['id'])) {

            $message = $_POST['message'];

            $bId = $_POST['id'];
            $this->loadModel('Bookings');
            $booking = $this->Bookings->get($bId);
            $talentEventId = $booking->talent_event_id;

            $sendMessage = $this->TalentMessages->newEntity();
            $userId = $this->Auth->user('id');
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
                    echo json_encode(array('flag' => 'success', 'message' => ''));
                }
            } else {
                echo json_encode(array('flag' => 'error', 'message' => 'Message can not be saved'));
            }
        } else {
            echo json_encode(array('flag' => 'error', 'message' => 'Not allowed'));
        }
        exit;
    }

    public function updateProfileInfo() {
        $data = $_GET;

        $userId = $this->Auth->user('id');
        $this->loadModel('Users');
        $getUser = $this->Users->get($userId);

        if ($data['password'] != $data['confirm_password']) {
            $message = array('flag' => 1, 'message' => "Password does not match.");
            echo json_encode($message);
            exit;
        } else if ($data['password'] == $data['confirm_password']) {
            $getUser->first_name = $data['first_name'];
            $getUser->last_name = $data['last_name'];
            $getUser->email = $data['email'];
            $getUser->phone1 = $data['phone1'];
            if ($data['password'] != '') {
                $hasher = new DefaultPasswordHasher();
                $pass = $hasher->hash($data['password']);
                $getUser->password = $data['password'];
            }

            if ($this->Users->save($getUser)) {
                $message = array('flag' => 1, 'message' => "Infromation saved.");
                echo json_encode($message);
                exit;
            }
        }
    }

    public function profile() {

        $userId = $this->request->session()->read('Auth.User.id');
        $title = 'Profile :: Welvet';
        $userInfo = $this->Users->get($userId, [
            'contain' => ['Roles']
        ]);

        if ($userInfo->role_id != 2) {
            return $this->redirect(['controller' => 'pages', 'action' => 'home']);
        }

        $this->set(compact('title', 'userInfo'));
        $this->viewBuilder()->setLayout('dashboard');
    }

    public function forgotPassword() {
        if ($this->request->is('post')) {

            if (!empty($this->request->data)) {
                $email = $this->request->data['email'];
                $user = $this->Users->findByEmail($email)->first();

                if (!empty($user)) {
                    $passkey = uniqid();
                    $url = Router::Url(['controller' => 'users', 'action' => 'reset'], true) . '/' . $passkey;

                    $user->password_reset_token = $passkey;
                    $reset_token_link = Router::url(['controller' => 'Users', 'action' => 'resetPassword'], TRUE) . '/' . $passkey;
                    $emaildata = [$user->email, $reset_token_link];
                    $Email = new Email();
                    $Email->from(array('info@cyberclouds.com' => 'Welwett'));
                    $Email->emailFormat('both');
                    $Email->to($user->email);
                    $Email->subject('Password Reset | Welwett');
                    $message = "Dear " . $user->user_name . "<br />Below is your Welwett password reset link, please click on it";
                    $message .= "<br /><a href='$reset_token_link'>Reset Password Link</a>";
                    $Email->send($message);

                    $this->Users->save($user);
                    $this->Flash->success('Please click on password reset link, sent in your email address to reset password.');
                } else {
                    $this->Flash->error('Sorry! The email address you entered is not registered with us');
                }
            }
        }


        $this->viewBuilder()->setLayout('');
    }

    public function resetPassword($token = null) {
        if (!empty($token)) {

            $user = $this->Users->findByPasswordResetToken($token)->first();

            if ($user) {

                if (!empty($this->request->data)) {
                    $user = $this->Users->patchEntity($user, [
                        'password' => $this->request->data['new_password'],
                        'new_password' => $this->request->data['new_password'],
                        'confirm_password' => $this->request->data['confirm_password']
                            ], ['validate' => 'password']);

                    $user->password_reset_token = "";

                    if ($this->Users->save($user)) {
                        $this->Flash->success('Your password has been changed successfully');

                        $this->redirect(['controller' => 'pages', 'action' => 'home']);
                    } elseif ($user->errors()) {
                        $model_error = $user->errors();
                        if ($model_error['new_password']['length'] != "") {
                            $this->Flash->error(__($model_error['new_password']['length']));
                        } elseif ($model_error['new_password']['match'] != "") {
                            $this->Flash->error(__($model_error['new_password']['match']));
                        } elseif ($model_error['confirm_password']['length'] != "") {
                            $this->Flash->error(__($model_error['confirm_password']['length']));
                        } elseif ($model_error['confirm_password']['match'] != "") {
                            $this->Flash->error(__($model_error['confirm_password']['match']));
                        }
                    } else {
                        $this->Flash->error('Error changing password. Please try again!');
                    }
                }
            } else {
                $this->Flash->error('Sorry your password token has been expired.');
            }
        } else {
            $this->Flash->error('Error loading password reset.');
        }
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
        $this->viewBuilder()->setLayout('');
    }

}
