<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * Modules Controller
 *
 * @property \App\Model\Table\ModulesTable $Modules
 *
 * @method \App\Model\Entity\Module[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ModulesController extends AppController {

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index() {
        $this->paginate = [
            'contain' => ['Users']
        ];
        $this->viewBuilder()->setLayout('backend');
        $modules = $this->paginate($this->Modules);

        $this->set(compact('modules'));
    }

    /**
     * View method
     *
     * @param string|null $id Module id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {

        $this->viewBuilder()->setLayout('backend');
        $module = $this->Modules->get($id, [
            'contain' => ['Users']
        ]);

        $this->set('module', $module);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $this->viewBuilder()->setLayout('backend');
        $module = $this->Modules->newEntity();
        if ($this->request->is('post')) {
            $module = $this->Modules->patchEntity($module, $this->request->getData());

            if ($this->Modules->save($module)) {
                //STORE LOGS
                $this->loadModel('Logs');

                $userId = $this->request->session()->read('Auth.User.id');
                $role = $this->request->session()->read('Auth.User.role_id');
                $activity = 'Module Added';
                $name = $this->request->data['name'];
                $path = $this->request->data['path'];

                if ($role == 1) {
                    $newRole = "Super Admin";
                } else if ($role == 2) {
                    $newRole = "Admin";
                } else if ($role == 3) {
                    $newRole = "Customer";
                }

                $note = $newRole . ' added the module (' . $name . ') with the link (' . $path . ').';

                $logs = $this->Logs->newEntity();
                $this->request->data['Log']['user_id'] = $userId;
                $this->request->data['Log']['activity'] = $activity;
                $this->request->data['Log']['note'] = $note;

                $logs = $this->Logs->patchEntity($logs, $this->request->data['Log']);

                if ($this->Logs->save($logs)) {
                    $this->Flash->success(__('The module has been saved.'));
                    return $this->redirect(['action' => 'index']);
                }

                $this->Flash->success(__('The module has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The module could not be saved. Please, try again.'));
        }
        $this->set(compact('module'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Module id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $this->viewBuilder()->setLayout('backend');
        $module = $this->Modules->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $module = $this->Modules->patchEntity($module, $this->request->getData());
            if ($this->Modules->save($module)) {
                //STORE LOGS
                $this->loadModel('Logs');

                $userId = $this->request->session()->read('Auth.User.id');
                $role = $this->request->session()->read('Auth.User.role_id');
                $activity = 'Module Updated';
                $name = $this->request->data['name'];
                $path = $this->request->data['path'];

                if ($role == 1) {
                    $newRole = "Super Admin";
                } else if ($role == 2) {
                    $newRole = "Admin";
                } else if ($role == 3) {
                    $newRole = "Customer";
                }

                $note = $newRole . ' updated the module (' . $name . ') with the link (' . $path . ').';

                $logs = $this->Logs->newEntity();
                $this->request->data['Log']['user_id'] = $userId;
                $this->request->data['Log']['activity'] = $activity;
                $this->request->data['Log']['note'] = $note;

                $logs = $this->Logs->patchEntity($logs, $this->request->data['Log']);

                if ($this->Logs->save($logs)) {
                    $this->Flash->success(__('The module has been saved.'));
                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->success(__('The module has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The module could not be saved. Please, try again.'));
        }
        $this->set(compact('module'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Module id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete', 'get']);
        $module = $this->Modules->get($id, [
            'contain' => ['Rights']
        ]);
        if ($module->rights != null) {
            $this->Flash->error(__('This module has some permissions. If you want to delete then first delete permissions against this module.'));
            return $this->redirect(['controller' => 'modules', 'action' => 'index']);
        } else {

            if ($this->Modules->delete($module)) {
                //STORE LOGS
                $this->loadModel('Logs');

                $userId = $this->request->session()->read('Auth.User.id');
                $fullName = $this->request->session()->read('Auth.User.first_name') . ' ' . $this->request->session()->read('Auth.User.last_name');
                $activity = 'Module Deleted';


                $note = $fullName . ' delete the module (' . $module->name . ').';

                $logs = $this->Logs->newEntity();
                $this->request->data['Log']['user_id'] = $userId;
                $this->request->data['Log']['activity'] = $activity;
                $this->request->data['Log']['note'] = $note;

                $logs = $this->Logs->patchEntity($logs, $this->request->data['Log']);
                if ($this->Logs->save($logs)) {
                    $this->Flash->success(__('The module has been deleted.'));
                    return $this->redirect(['controller' => 'modules', 'action' => 'index']);
                } else {
                    $this->Flash->success(__('The module has been deleted.'));
                    return $this->redirect(['controller' => 'modules', 'action' => 'index']);
                }
            } else {
                $this->Flash->error(__('The module could not be deleted. Please, try again.'));
            }
        }

        return $this->redirect(['action' => 'index']);
    }

}
