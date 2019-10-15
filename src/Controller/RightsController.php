<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Datasource\ConnectionManager;

/**
 * Rights Controller
 *
 * @property \App\Model\Table\RightsTable $Rights
 *
 * @method \App\Model\Entity\Right[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RightsController extends AppController {

    public function isAuthorized($user) {

        if (in_array($this->request->action, ['edit'])) {
            $id = (int) $this->request->params['pass'][0];
            if ($id == $user['id']) {
                return true;
            }
        }
        if (in_array($this->request->action, ['logout'])) {
            return true;
        }
        // Admin can access every action
        $conn = ConnectionManager::get('default');

        $query2 = $conn->execute('SELECT *'
                . ' FROM modules '
                . 'inner join rights   ON modules.id=rights.module_id '
                . 'where role_id="' . $user['role_id'] . '" and path LIKE "%' . $this->request->params['controller'] . '/' . $this->request->params['action'] . '%"');
        //debug($query2);exit;
        $module = $query2->fetchAll('assoc');

        //echo $module[0]['role_id'];echo $user['role_id'];
        // exit;
        if (isset($user['role_id']) && !empty($module[0]['path']) && !empty($module[0]['role_id'])) {


            return true;
        }

        // Default deny
        else {
            return false;
        }
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index() {
        $this->viewBuilder()->setLayout('backend');
        $this->paginate = [
            'contain' => ['Roles', 'Modules', 'Users']
        ];
        $rights = $this->paginate($this->Rights);

        $this->set(compact('rights'));
    }

    /**
     * View method
     *
     * @param string|null $id Right id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        $this->viewBuilder()->setLayout('backend');
        $right = $this->Rights->get($id, [
            'contain' => ['Roles', 'Modules', 'Users']
        ]);

        $this->set('right', $right);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $this->viewBuilder()->setLayout('backend');
        $right = $this->Rights->newEntity();
        if ($this->request->is('post')) {
            $right = $this->Rights->patchEntity($right, $this->request->getData());
            if ($result = $this->Rights->save($right)) {
                $id = $result->id;
                $queryUserModuleInfo = $this->Rights->get($id, [
                    'contain' => ['Users', 'Modules']
                ]);

                //STORE LOGS
                $this->loadModel('Logs');

                $userId = $this->request->session()->read('Auth.User.id');
                $role = $this->request->session()->read('Auth.User.role_id');
                $moduleAssignedTo = $queryUserModuleInfo->user->user_name;
                $module = $queryUserModuleInfo->module->name;
                $activity = 'Permission Assigned';


                if ($role == 1) {
                    $newRole = "Super Admin";
                } else if ($role == 2) {
                    $newRole = "Admin";
                } else if ($role == 3) {
                    $newRole = "Customer";
                }

                $note = $newRole . ' assigned the module (' . $module . ') Permission to user (' . $moduleAssignedTo . ').';

                $logs = $this->Logs->newEntity();
                $this->request->data['Log']['user_id'] = $userId;
                $this->request->data['Log']['activity'] = $activity;
                $this->request->data['Log']['note'] = $note;

                $logs = $this->Logs->patchEntity($logs, $this->request->data['Log']);

                if ($this->Logs->save($logs)) {
                    $this->Flash->success(__('The Permission has been saved.'));
                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->success(__('The Permission  has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The right could not be saved. Please, try again.'));
        }
        $roles = $this->Rights->Roles->find('list', ['limit' => 200]);
        $modules = $this->Rights->Modules->find('list', ['limit' => 200]);
        $users = $this->Rights->Users->find('list', ['limit' => 200, 'keyField' => 'id', 'valueField' => 'user_name']);
        $this->set(compact('right', 'roles', 'modules', 'users'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Right id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $this->viewBuilder()->setLayout('backend');
        $right = $this->Rights->get($id, [
            'contain' => ['Users', 'Modules']
        ]);
        $oldPermission = $right->module->name;
        $oldUser = $right->user->user_name;

        if ($this->request->is(['patch', 'post', 'put'])) {
            $right = $this->Rights->patchEntity($right, $this->request->getData());
            if ($result = $this->Rights->save($right)) {
                $rightId = $result->id;
                $rightNew = $this->Rights->get($rightId, [
                    'contain' => ['Users', 'Modules']
                ]);
                $newPermission = $rightNew->module->name;
                $newUser = $rightNew->user->user_name;

                //STORE LOGS
                $this->loadModel('Logs');

                $userId = $this->request->session()->read('Auth.User.id');
                $role = $this->request->session()->read('Auth.User.role_id');
                $activity = 'Permission Updated';


                if ($role == 1) {
                    $newRole = "Super Admin";
                } else if ($role == 2) {
                    $newRole = "Admin";
                } else if ($role == 3) {
                    $newRole = "Customer";
                }

                $note = $newRole . ' change the Permission from (' . $oldPermission . ' to ' . $newPermission . '). The old user was ' . $oldUser . ' and new user is ' . $newUser;

                $logs = $this->Logs->newEntity();
                $this->request->data['Log']['user_id'] = $userId;
                $this->request->data['Log']['activity'] = $activity;
                $this->request->data['Log']['note'] = $note;

                $logs = $this->Logs->patchEntity($logs, $this->request->data['Log']);

                if ($this->Logs->save($logs)) {
                    $this->Flash->success(__('The Permission has been saved.'));
                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->success(__('The Permission has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The right could not be saved. Please, try again.'));
        }
        $roles = $this->Rights->Roles->find('list', ['limit' => 200]);
        $modules = $this->Rights->Modules->find('list', ['limit' => 200]);
        $users = $this->Rights->Users->find('list', ['limit' => 200, 'keyField' => 'id', 'valueField' => 'user_name']);
        $this->set(compact('right', 'roles', 'modules', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Right id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete', 'get']);
        $right = $this->Rights->get($id,[
            'contain' => ['Users', 'Modules']
        ]);
        $permissionName = $right->module->name;
        $userName = $right->user->user_name;
       
        if ($this->Rights->delete($right)) {
            //STORE LOGS
            $this->loadModel('Logs');

            $userId = $this->request->session()->read('Auth.User.id');
            $role = $this->request->session()->read('Auth.User.role_id');
            $activity = 'Permission Deleted';


            if ($role == 1) {
                $newRole = "Super Admin";
            } else if ($role == 2) {
                $newRole = "Admin";
            } else if ($role == 3) {
                $newRole = "Customer";
            }

            $note = 'Permission ('.$permissionName.') deleted by ' . $newRole.', which was assinged to user ('.$userName.').';

            $logs = $this->Logs->newEntity();
            $this->request->data['Log']['user_id'] = $userId;
            $this->request->data['Log']['activity'] = $activity;
            $this->request->data['Log']['note'] = $note;

            $logs = $this->Logs->patchEntity($logs, $this->request->data['Log']);

            if ($this->Logs->save($logs)) {
                $this->Flash->success(__('The Permission has been deleted.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->success(__('The right has been deleted.'));
        } else {
            $this->Flash->error(__('The right could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

}
