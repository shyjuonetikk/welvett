<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;

/**
 * CorporateMembers Controller
 *
 * @property \App\Model\Table\CorporateMembersTable $CorporateMembers
 *
 * @method \App\Model\Entity\CorporateMember[] paginate($object = null, array $settings = [])
 */
class CorporateMembersController extends AppController {

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function isAuthorized($user) {
        $allow_corporate = array('corporateEvents', 'editImage', 'addReview', 'saveUserInfo', 'corporateReviews', 'messages');

        if (in_array($this->request->action, $allow_corporate) && $user['role_id'] == 3) {
            return true;
        }
        if (in_array($this->request->action, ['editImage']) && $user['role_id'] == 4) {
            return true;
        }
        if ($this->viewVars['actionPermission'] != "") {
            return true;
        } else {
            return false;
        }
    }

    public function index() {
        $this->paginate = [
            'contain' => ['Users']
        ];
        $corporateMembers = $this->paginate($this->CorporateMembers);

        $this->set(compact('corporateMembers'));
        $this->set('_serialize', ['corporateMembers']);
    }

    public function corporateEvents($status = null) {
        $title = 'Corporate Events :: Welvet';
        $id = $this->Auth->user('id');

        $this->loadModel('Users');
        $this->loadModel('States');
        $states = $this->States->find('list')->toArray();
        $user = $this->Users->get($id, ['contain' => ['CorporateMembers']]);
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
            $resultNotification = $query->update()
                    ->set(['is_read' => 1])
                    ->where(['id' => $notificationId])
                    ->execute();
            $this->loadModel('Notifications');
            $unread_notifications = $this->Notifications->find('all')
                    ->where(['customer_id' => $this->Auth->user('id'), 'is_read' => 0, 'activity_by !=' => $this->Auth->user('id')])
                    ->count();
            $this->set(compact('unread_notifications'));
            $status = null;
        }


        $this->paginate = [
            'contain' => [
                'Payments',
                'TalentEvents' => ['Eventcategories'], 'TalentReviews' => function($r)use ($id) {
                    $r->select([
                                'talent_event_id',
                                'review',
                                'customer_id'
                            ])
                            ->where(['TalentReviews.customer_id' => $id]);
                    return $r;
                }, 'Talents', 'Talents.EmployeeMembers', 'TalentRatings'],
            'conditions' => ['Bookings.customer_id' => $id, $conditions],
            'order' => ['Bookings.id' => 'DESC']
        ];
        $bookings = $this->paginate($this->Bookings);


        $this->set(compact('title', 'user', 'bookings', 'states'));
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
            //            $this->request->data['User']['profile_image'] = $user_image;
            $users = TableRegistry::get('Users');
            $user = $users->get($this->Auth->user('id'));
            $user->profile_image = $user_image;
            if ($users->save($user)) {
                $this->generate_thumb($source, $destination, 200, 200);

                $userId = $this->request->session()->read('Auth.User.id');
                //store log
                $this->loadModel('Logs');
                $this->loadModel('Users');
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

    public function view($id = null) {
        $corporateMember = $this->CorporateMembers->get($id, [
            'contain' => ['Users']
        ]);

        $this->set('corporateMember', $corporateMember);
        $this->set('_serialize', ['corporateMember']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $corporateMember = $this->CorporateMembers->newEntity();
        if ($this->request->is('post')) {
            $corporateMember = $this->CorporateMembers->patchEntity($corporateMember, $this->request->getData());
            if ($this->CorporateMembers->save($corporateMember)) {
                $this->Flash->success(__('The corporate member has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The corporate member could not be saved. Please, try again.'));
        }
        $users = $this->CorporateMembers->Users->find('list', ['limit' => 200]);
        $this->set(compact('corporateMember', 'users'));
        $this->set('_serialize', ['corporateMember']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Corporate Member id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $corporateMember = $this->CorporateMembers->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $corporateMember = $this->CorporateMembers->patchEntity($corporateMember, $this->request->getData());
            if ($this->CorporateMembers->save($corporateMember)) {
                $this->Flash->success(__('The corporate member has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The corporate member could not be saved. Please, try again.'));
        }
        $users = $this->CorporateMembers->Users->find('list', ['limit' => 200]);
        $this->set(compact('corporateMember', 'users'));
        $this->set('_serialize', ['corporateMember']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Corporate Member id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $corporateMember = $this->CorporateMembers->get($id);
        if ($this->CorporateMembers->delete($corporateMember)) {
            $this->Flash->success(__('The corporate member has been deleted.'));
        } else {
            $this->Flash->error(__('The corporate member could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function corporateReviews() {
        $this->loadModel('Users');
        $userId = $this->request->session()->read('Auth.User.id');
        $title = 'Corporate  Reviews :: Welvet';
        $userInfo = $this->Users->get($userId, [
            'contain' => ['Roles']
        ]);

        if ($userInfo->role_id != 3) {
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

    public function messages($bookingId = null) {
        $title = 'Message :: Welvet';
        $userId = $this->request->session()->read('Auth.User.id');
        $roleId = $this->request->session()->read('Auth.User.role_id');

        if ($roleId != 3) {
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

    public function profile() {

        $userId = $this->request->session()->read('Auth.User.id');
        $title = 'Profile :: Welvet';
        $this->loadModel('Users');
        $userInfo = $this->Users->get($userId, [
            'contain' => ['Roles', 'CorporateMembers']
        ]);
        //        debug($userInfo);
        if ($userInfo->role_id != 3) {
            return $this->redirect(['controller' => 'pages', 'action' => 'home']);
        }

        $this->set(compact('title', 'userInfo'));
        $this->viewBuilder()->setLayout('dashboard');
    }

    public function updateProfileInfo() {
        $data = $_GET;

        $userId = $this->Auth->user('id');
        $this->loadModel('Users');
        $this->loadModel('CorporateMembers');
        $getUser = $this->Users->get($userId, [
            'contain' => ['CorporateMembers']
        ]);

        if ($data['password'] != $data['confirm_password']) {
            $message = array('flag' => 1, 'message' => "Password does not match.");
            echo json_encode($message);
            exit;
        } else if ($data['password'] == $data['confirm_password']) {
            $getUser->first_name = $data['first_name'];
            $getUser->last_name = $data['last_name'];
            $getUser->email = $data['email'];
            $getUser->phone1 = $data['phone1'];
            $getUser->address1 = $data['c_address'];
            if ($data['password'] != '') {

                $getUser->password = $data['password'];
            }

            if ($this->Users->save($getUser)) {
                $getUser->corporate_member->job_title = $data['job_title'];
                $getUser->corporate_member->company_name = $data['c_name'];
                $getUser->corporate_member->authorizer_first_name = $data['auth_first_name'];
                $getUser->corporate_member->authorizer_last_name = $data['auth_last_name'];
                $getUser->corporate_member->authorizer_email = $data['auth_email'];
                $getUser->corporate_member->authorizer_phone = $data['auth_phone'];
                $getUser->corporate_member->authorizer_job_title = $data['auth_job'];

                if ($this->CorporateMembers->save($getUser->corporate_member)) {
                    $message = array('flag' => 1, 'message' => "Infromation saved.");
                    echo json_encode($message);
                    exit;
                }
            }
        }
    }

    public function waitingForApproval($userId = null) {
        $title = "Waiting for approval";
        $this->set(compact('title'));
        $this->viewBuilder()->setLayout('');
    }

}
