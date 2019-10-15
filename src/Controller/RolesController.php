<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Datasource\ConnectionManager;

/**
 * Roles Controller
 *
 *
 * @method \App\Model\Entity\Role[] paginate($object = null, array $settings = [])
 */
class RolesController extends AppController {

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

        $this->viewBuilder()->setLayout('backend');

        $this->paginate =[
            'conditions' => [

                'Roles.name NOT IN' => ['SUPERADMIN','INDIVIDUAL MEMBER', 'CORPORATE MEMBER', 'EMPLOYEE']  

            ]
        ];

        $roles = $this->paginate($this->Roles);

        $this->set(compact('roles'));
        $this->set('_serialize', ['roles']);
    }

    /**
     * View method
     *
     * @param string|null $id Role id.
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

        $this->viewBuilder()->setLayout('backend');
        $role = $this->Roles->get($id, [
            'contain' => ['Rights' => ['Modules']]
        ]);

        $this->set('role', $role);
        $this->set('_serialize', ['role']);
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

        $this->viewBuilder()->setLayout('backend');
        $role = $this->Roles->newEntity();
        if ($this->request->is('post')) {

            $roleName = strtoupper(strtolower($this->request->data['name']));
            $this->request->data['Roles']['name'] = $roleName;

            $role = $this->Roles->patchEntity($role, $this->request->data['Roles']);

            if ($result = $this->Roles->save($role)) {
                $id = $result->id;

                $this->loadModel('Rights');
                for ($i = 0; $i < count($this->request->data['controller']); $i++) {

                    $permissions = $this->Rights->newEntity();

                    $moduleId = $this->request->data['controller'][$i];

                    $permissionId = $this->request->data[$moduleId];

                    if ($permissionId == 1) {
                        $accessLevel = "Read";
                    } else if ($permissionId == 2) {
                        $accessLevel = "Write";
                    }

                    $userId = $this->request->session()->read('Auth.User.id');

                    $this->request->data['Rights']['role_id'] = $id;
                    $this->request->data['Rights']['module_id'] = $moduleId;

                    $this->request->data['Rights']['per_type'] = $permissionId;
                    $this->request->data['Rights']['user_id'] = $userId;
                    $this->request->data['Rights']['status'] = 1;

                    $permissions = $this->Rights->patchEntity($permissions, $this->request->data['Rights']);

                    if ($resultPermissions = $this->Rights->save($permissions)) {
                        $rightId = $resultPermissions->id;
                        $permissionsDetails = $this->Rights->get($rightId, [
                            'contain' => ['Roles', 'Modules']
                        ]);
                        $moduleName = $permissionsDetails->module->controller;
                        $roleAdded = $permissionsDetails->role->name;

                        //STORE LOGS
                        $this->loadModel('Logs');

                        $this->loadModel('Users');

                        $userId = $this->request->session()->read('Auth.User.id');
                        $findRole = $this->Users->get($userId, [
                            'contain' => ['Roles']
                        ]);

                        $roleName = $findRole->role->name;
                        $activity = 'Role Added With Permissions';

                        $note = $roleName . ' added the Role (' . $roleAdded . ') and (' . $accessLevel . ') access has been given of (' . $moduleName . ').';

                        $logs = $this->Logs->newEntity();
                        $this->request->data['Log']['user_id'] = $userId;
                        $this->request->data['Log']['activity'] = $activity;
                        $this->request->data['Log']['note'] = $note;

                        $logs = $this->Logs->patchEntity($logs, $this->request->data['Log']);

                        if ($this->Logs->save($logs)) {
                            $success = 1;
                        }
                    }
                }


                $this->Flash->success(__('The role has been saved.'));

                return $this->redirect(['action' => 'index']);
            }

            if ($role->errors()) {
                $model_error = $role->errors();
                if ($model_error['name']['_isUnique'] != "") {
                    $this->Flash->error(__($model_error['name']['_isUnique']));
                }
            } else {
                $this->Flash->error(__('The role could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('role'));
        $this->set('_serialize', ['role']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Role id.
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

        $this->viewBuilder()->setLayout('backend');
        $role = $this->Roles->get($id, [
            'contain' => []
        ]);


        if ($this->request->is(['patch', 'post', 'put'])) {
            $roleName = strtoupper(strtolower($this->request->data['name']));
            $this->request->data['Roles']['name'] = $roleName;

            $role = $this->Roles->patchEntity($role, $this->request->data['Roles']);

            if ($result = $this->Roles->save($role)) {
                $id = $result->id;
                $this->loadModel('Rights');

                $conn = ConnectionManager::get('default');

                $queryDeleteOldPermissions = $conn->execute("DELETE FROM `rights` WHERE `role_id` = '$id'");


                for ($i = 0; $i < count($this->request->data['controller']); $i++) {


                    $permissions = $this->Rights->newEntity();


                    $moduleId = $this->request->data['controller'][$i];

                    $permissionId = $this->request->data[$moduleId];


                    if ($permissionId == 1) {
                        $accessLevel = "Read";
                    } else if ($permissionId == 2) {
                        $accessLevel = "Write";
                    }

                    $userId = $this->request->session()->read('Auth.User.id');

                    $this->request->data['Rights']['role_id'] = $id;
                    $this->request->data['Rights']['module_id'] = $moduleId;

                    $this->request->data['Rights']['per_type'] = $permissionId;
                    $this->request->data['Rights']['user_id'] = $userId;
                    $this->request->data['Rights']['status'] = 1;

                    $permissions = $this->Rights->patchEntity($permissions, $this->request->data['Rights']);

                    if ($resultPermissions = $this->Rights->save($permissions)) {
                        $rightId = $resultPermissions->id;
                        $permissionsDetails = $this->Rights->get($rightId, [
                            'contain' => ['Roles', 'Modules']
                        ]);
                        $moduleName = $permissionsDetails->module->controller;
                        $roleAdded = $permissionsDetails->role->name;

                        //STORE LOGS
                        $this->loadModel('Logs');
                        $this->loadModel('Users');

                        $userId = $this->request->session()->read('Auth.User.id');
                        $findRole = $this->Users->get($userId, [
                            'contain' => ['Roles']
                        ]);

                        $roleName = $findRole->role->name;

                        $activity = 'Role Updated With Permissions';

                        $note = $roleName . ' updated the Role (' . $roleAdded . ') and (' . $accessLevel . ') access has been given of (' . $moduleName . ').';

                        $logs = $this->Logs->newEntity();
                        $this->request->data['Log']['user_id'] = $userId;
                        $this->request->data['Log']['activity'] = $activity;
                        $this->request->data['Log']['note'] = $note;

                        $logs = $this->Logs->patchEntity($logs, $this->request->data['Log']);

                        if ($this->Logs->save($logs)) {
                            $success = 1;
                        }
                    }
                }


                $this->Flash->success(__('The role has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The role could not be saved. Please, try again.'));
        }
        $this->set(compact('role'));
        $this->set('_serialize', ['role']);
        $this->set(compact('modules'));
        $this->set('_serialize', ['modules']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Role id.
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
        $role = $this->Roles->get($id);
        $id = $role->id;
        $roleDeleted = $role->name;

        $conn = ConnectionManager::get('default');

        $queryDeleteOldPermissions = $conn->execute("DELETE FROM `rights` WHERE `role_id` = '$id'");

        if ($this->Roles->delete($role)) {

            //STORE LOGS
            $this->loadModel('Logs');
            $this->loadModel('Users');

            $userId = $this->request->session()->read('Auth.User.id');
            $findRole = $this->Users->get($userId, [
                'contain' => ['Roles']
            ]);

            $roleName = $findRole->role->name;
            $activity = 'Role Deleted With Permissions';

            $note = $roleDeleted . ' role has been deleted by ' . $roleName;

            $logs = $this->Logs->newEntity();
            $this->request->data['Log']['user_id'] = $userId;
            $this->request->data['Log']['activity'] = $activity;
            $this->request->data['Log']['note'] = $note;

            $logs = $this->Logs->patchEntity($logs, $this->request->data['Log']);

            if ($this->Logs->save($logs)) {
                $this->Flash->success(__('The role has been deleted.'));
            }
        } else {
            $this->Flash->error(__('The role could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

}
