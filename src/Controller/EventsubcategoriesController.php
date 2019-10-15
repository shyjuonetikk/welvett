<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * Eventsubcategories Controller
 *
 * @property \App\Model\Table\EventsubcategoriesTable $Eventsubcategories
 *
 * @method \App\Model\Entity\Eventsubcategory[] paginate($object = null, array $settings = [])
 */
class EventsubcategoriesController extends AppController {

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index($category = null) {
        $this->set('content_title', 'Service Sub-Categories');
        $permission = $this->viewVars['actionPermission'];
        if ($permission == 1 || $permission == 2) {
            
        } else {
            return $this->redirect(['controller' => 'Pages', 'action' => 'welcome']);
        }
        $this->set(compact('permission'));

        $this->viewBuilder()->setLayout('backend');

        $this->paginate = [
            'contain' => ['Eventcategories', 'Users'],
            'conditions' => ['eventcategory_id' => $category]
        ];
        $eventsubcategories = $this->paginate($this->Eventsubcategories);

        $this->set(compact('eventsubcategories'));
        $this->set('_serialize', ['eventsubcategories']);
    }

    /**
     * View method
     *
     * @param string|null $id Eventsubcategory id.
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
        $eventsubcategory = $this->Eventsubcategories->get($id, [
            'contain' => ['Eventcategories', 'Users']
        ]);

        $this->set('eventsubcategory', $eventsubcategory);
        $this->set('_serialize', ['eventsubcategory']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add($redirect = null) {

        $this->set('content_title', 'Add Sub Service');
        $permission = $this->viewVars['actionPermission'];

        if ($permission == 2) {
            
        } else {
            return $this->redirect(['controller' => 'Pages', 'action' => 'welcome']);
        }
        $this->loadModel('Eventcategories');
        $category = $this->Eventcategories->find('all', ['conditions' => ['id' => $redirect]])->first()->toArray();
        $this->set(compact('category'));
        $this->set(compact('permission'));

        $this->viewBuilder()->setLayout('backend');
        $eventsubcategory = $this->Eventsubcategories->newEntity();


        if ($this->request->is('post')) {

            $eventcategories_order = $this->Eventsubcategories->find('all', [
                'fields' => array('order' => 'MAX(Eventsubcategories.ordinal)')
            ]);
            if (!$eventcategories_order) {
                $inc_eventcategories_order = 1;
            }
            $eventcategories_array = $eventcategories_order->toArray();
            $inc_eventcategories_order = $eventcategories_array[0]['order'] + 1;
            $userId = $this->request->session()->read('Auth.User.id');
            $this->request->data['Eventsubcategory']['title'] = ucwords(strtolower($this->request->data['title']));
            $this->request->data['Eventsubcategory']['ordinal'] = $inc_eventcategories_order;
            $this->request->data['Eventsubcategory']['eventcategory_id'] = $redirect;
            $this->request->data['Eventsubcategory']['status'] = 1;
            $this->request->data['Eventsubcategory']['user_id'] = $userId;
            $eventsubcategory = $this->Eventsubcategories->patchEntity($eventsubcategory, $this->request->data['Eventsubcategory']);
            if ($this->Eventsubcategories->save($eventsubcategory)) {

                //STORE LOGS
                $this->loadModel('Logs');
                $this->loadModel('Users');

                $findRole = $this->Users->get($userId, [
                    'contain' => ['Roles']
                ]);

                $roleName = $findRole->role->name;

                $activity = 'New Event Sub Category Added';
                $title = $this->request->data['title'];

                $note = $roleName . ' added a new event sub category (' . $title . ')';

                $logs = $this->Logs->newEntity();
                $this->request->data['Log']['user_id'] = $userId;
                $this->request->data['Log']['activity'] = $activity;
                $this->request->data['Log']['note'] = $note;

                $logs = $this->Logs->patchEntity($logs, $this->request->data['Log']);

                if ($this->Logs->save($logs)) {
                    $this->Flash->success(__('The eventsubcategory has been saved.'));
                    return $this->redirect(['action' => 'index', $redirect]);
                }
                $this->Flash->success(__('The eventsubcategory has been saved.'));

                return $this->redirect(['action' => 'index', $redirect]);
            }
            $this->Flash->error(__('The eventsubcategory could not be saved. Please, try again.'));
        }
        $eventcategories = $this->Eventsubcategories->Eventcategories->find('list', ['limit' => 200]);
        $users = $this->Eventsubcategories->Users->find('list', ['limit' => 200]);
        $this->set(compact('eventsubcategory', 'eventcategories', 'users'));
        $this->set('_serialize', ['eventsubcategory']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Eventsubcategory id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null, $r = null) {
        $permission = $this->viewVars['actionPermission'];

        if ($permission == 2) {
            
        } else {
            return $this->redirect(['controller' => 'Pages', 'action' => 'welcome']);
        }
        $this->set(compact('permission'));
        $permission = $this->viewVars['actionPermission'];
        $this->viewBuilder()->setLayout('backend');

        $eventsubcategory = $this->Eventsubcategories->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $userId = $this->request->session()->read('Auth.User.id');
            $this->request->data['Eventsubcategory']['title'] = ucwords(strtolower($this->request->data['title']));
            $this->request->data['Eventsubcategory']['eventcategory_id'] = $this->request->data['eventcategory_id'];
            $this->request->data['Eventsubcategory']['status'] = $this->request->data['status'];
            $this->request->data['Eventsubcategory']['user_id'] = $userId;
            $eventsubcategory = $this->Eventsubcategories->patchEntity($eventsubcategory, $this->request->data['Eventsubcategory']);
            if ($this->Eventsubcategories->save($eventsubcategory)) {
                //STORE LOGS
                $this->loadModel('Logs');
                $this->loadModel('Users');

                $userId = $this->request->session()->read('Auth.User.id');
                $findRole = $this->Users->get($userId, [
                    'contain' => ['Roles']
                ]);

                $roleName = $findRole->role->name;
                $activity = 'Event Sub Category Updates';
                $title = $this->request->data['title'];

                $note = $roleName . ' updated the event sub category (' . $title . ')';

                $logs = $this->Logs->newEntity();
                $this->request->data['Log']['user_id'] = $userId;
                $this->request->data['Log']['activity'] = $activity;
                $this->request->data['Log']['note'] = $note;

                $logs = $this->Logs->patchEntity($logs, $this->request->data['Log']);

                if ($this->Logs->save($logs)) {
                    $this->Flash->success(__('The eventsubcategory has been saved.'));
                    return $this->redirect(['action' => 'index', $r]);
                }
                $this->Flash->success(__('The eventsubcategory has been saved.'));

                return $this->redirect(['action' => 'index', $r]);
            }
            $this->Flash->error(__('The eventsubcategory could not be saved. Please, try again.'));
        }
        $eventcategories = $this->Eventsubcategories->Eventcategories->find('list', ['limit' => 200]);
        $users = $this->Eventsubcategories->Users->find('list', ['limit' => 200]);
        $this->set(compact('eventsubcategory', 'eventcategories', 'users'));
        $this->set('_serialize', ['eventsubcategory']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Eventsubcategory id.
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
        $eventsubcategory = $this->Eventsubcategories->get($id);
        if ($this->Eventsubcategories->delete($eventsubcategory)) {
            $this->loadModel('Logs');
            $this->loadModel('Users');

            $userId = $this->request->session()->read('Auth.User.id');
            $findRole = $this->Users->get($userId, [
                'contain' => ['Roles']
            ]);

            $roleName = $findRole->role->name;

            $activity = 'Event Sub Category Deleted';
            $note = $roleName . ' deleted the eventsubcategory (' . $eventsubcategory->title . ')';

            $logs = $this->Logs->newEntity();
            $this->request->data['Log']['user_id'] = $userId;
            $this->request->data['Log']['activity'] = $activity;
            $this->request->data['Log']['note'] = $note;

            $logs = $this->Logs->patchEntity($logs, $this->request->data['Log']);

            if ($this->Logs->save($logs)) {
                $this->Flash->success(__('The eventsubcategory has been deleted.'));
            } else {
                $this->Flash->success(__('The eventsubcategory has been deleted.'));
            }
        } else {
            $this->Flash->error(__('The eventsubcategory could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function udapteorder() {
        if ($this->request->is('post')) {
            $success = 0;
            foreach ($this->request->data['data']['eventsubcat_id'] as $key => $data) {
                $event = $this->Eventsubcategories->newEntity();
                $this->request->data['Event']['ordinal'] = $this->request->data['data']['ordinal'][$key];

                $event->id = $this->request->data['data']['eventsubcat_id'][$key];
                $event = $this->Eventsubcategories->patchEntity($event, $this->request->data['Event'], [
                    'validate' => 'OnlyCheck'
                ]);
                if ($this->Eventsubcategories->save($event)) {
                    $success = 1;
                } else {
                    $success = 0;
                }
            }

            if ($success == 1) {
                $this->Flash->success(__('Event Sub Category order has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {

                $this->Flash->error(__('Event Sub Category order not saved, try again later'));
                return $this->redirect(array('action' => 'index'));
            }
        }
        $this->viewBuilder()->setLayout();
        $this->autoRender = false;
    }

}
