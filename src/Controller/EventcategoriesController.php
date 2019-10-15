<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * Eventcategories Controller
 *
 * @property \App\Model\Table\EventcategoriesTable $Eventcategories
 *
 * @method \App\Model\Entity\Eventcategory[] paginate($object = null, array $settings = [])
 */
class EventcategoriesController extends AppController {

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index() {
        $this->set('content_title', 'Sevice Categories');
        $permission = $this->viewVars['actionPermission'];

        if ($permission == 1 || $permission == 2) {
            
        } else {
            return $this->redirect(['controller' => 'Pages', 'action' => 'welcome']);
        }
        $this->set(compact('permission'));

        $this->viewBuilder()->setLayout('backend');
        $this->paginate = [
            'contain' => ['Users', 'Eventsubcategories' => function($q) {
                    $q->select([
                                'Eventsubcategories.eventcategory_id',
                                'total' => $q->func()->count('Eventsubcategories.eventcategory_id')
                            ])
                            ->group(['Eventsubcategories.eventcategory_id']);
                    return $q;
                }]
        ];
        $eventcategories = $this->paginate($this->Eventcategories);

        $this->set(compact('eventcategories'));
        $this->set('_serialize', ['eventcategories']);
    }

    /**
     * View method
     *
     * @param string|null $id Eventcategory id.
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
        $eventcategory = $this->Eventcategories->get($id, [
            'contain' => ['Users', 'EmployeeMembers', 'Eventsubcategories', 'TalentEventCities', 'TalentEventSubcategories', 'TalentEvents']
        ]);

        $this->set('eventcategory', $eventcategory);
        $this->set('_serialize', ['eventcategory']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $this->set('content_title', 'Add Service Category');

        $permission = $this->viewVars['actionPermission'];

        if ($permission == 2) {
            
        } else {
            return $this->redirect(['controller' => 'Pages', 'action' => 'welcome']);
        }
        $this->set(compact('permission'));

        $this->viewBuilder()->setLayout('backend');
        $eventcategory = $this->Eventcategories->newEntity();
        if ($this->request->is('post')) {
            $eventcategories_order = $this->Eventcategories->find('all', [
                'fields' => array('order' => 'MAX(Eventcategories.ordinal)')
            ]);
            if (!$eventcategories_order) {
                $inc_eventcategories_order = 1;
            }
            $eventcategories_array = $eventcategories_order->toArray();
            $inc_eventcategories_order = $eventcategories_array[0]['order'] + 1;
            if (isset($this->request->data['image_icon']['name']) && $this->request->data['image_icon']['name'] != "") {
                $ext = strrchr($this->request->data['image_icon']['name'], '.');
                $user_image = $this->request->data['title'] . time() . $ext;
                $source = $this->request->data['image_icon']['tmp_name'];
                $destination = WWW_ROOT . 'img' . DS . 'event' . DS . $user_image;
                $thm_destination = WWW_ROOT . 'img' . DS . 'event' . DS . 'thumbnail' . DS . $user_image;
                $this->request->data['Eventcategory']['image_icon'] = $user_image;
            } else {
                unset($this->request->data['Eventcategory']['image_icon']);
            }

            $userId = $this->request->session()->read('Auth.User.id');
            $this->request->data['Eventcategory']['title'] = ucwords(strtolower($this->request->data['title']));
            $this->request->data['Eventcategory']['ordinal'] = $inc_eventcategories_order;
            $this->request->data['Eventcategory']['status'] = 1;

            $this->request->data['Eventcategory']['user_id'] = $userId;
            $this->request->data['Eventcategory']['image_icon'] = $user_image;

            $eventcategory = $this->Eventcategories->patchEntity($eventcategory, $this->request->data['Eventcategory']);
            if ($this->Eventcategories->save($eventcategory)) {
                if ($this->request->data['image_icon']['name'] != "") {

                    $this->generate_thumb($source, $thm_destination, 300, 250);
                    $this->generate_thumb($source, $destination, 1920, 1080);
                }
                //STORE LOGS
                $this->loadModel('Logs');
                $this->loadModel('Users');

                $findRole = $this->Users->get($userId, [
                    'contain' => ['Roles']
                ]);

                $roleName = $findRole->role->name;

                $activity = 'New Event Category Added';
                $title = $this->request->data['title'];

                $note = $roleName . ' added a new event category (' . $title . ')';

                $logs = $this->Logs->newEntity();
                $this->request->data['Log']['user_id'] = $userId;
                $this->request->data['Log']['activity'] = $activity;
                $this->request->data['Log']['note'] = $note;

                $logs = $this->Logs->patchEntity($logs, $this->request->data['Log']);

                if ($this->Logs->save($logs)) {
                    $this->Flash->success(__('The eventcategory  has been saved.'));
                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->success(__('The eventcategory has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The eventcategory could not be saved. Please, try again.'));
        }
        $users = $this->Eventcategories->Users->find('list', ['limit' => 200]);
        $this->set(compact('eventcategory', 'users'));
        $this->set('_serialize', ['eventcategory']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Eventcategory id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $this->set('content_title', 'Edit Service Category');
        $permission = $this->viewVars['actionPermission'];

        if ($permission == 2) {
            
        } else {
            return $this->redirect(['controller' => 'Pages', 'action' => 'welcome']);
        }
        $this->set(compact('permission'));

        $this->viewBuilder()->setLayout('backend');
        $eventcategory = $this->Eventcategories->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            if (isset($this->request->data['image_icon']['name']) && $this->request->data['image_icon']['name'] != "") {
                $ext = strrchr($this->request->data['image_icon']['name'], '.');
                $user_image = $this->request->data['title'] . time() . $ext;
                $source = $this->request->data['image_icon']['tmp_name'];
                $destination = WWW_ROOT . 'img' . DS . 'event' . DS . $user_image;
                $thm_destination = WWW_ROOT . 'img' . DS . 'event' . DS . 'thumbnail' . DS . $user_image;
                $this->request->data['Eventcategory']['image_icon'] = $user_image;
            } else {
                unset($this->request->data['Eventcategory']['image_icon']);
            }
            $userId = $this->request->session()->read('Auth.User.id');

            $this->request->data['Eventcategory']['title'] = ucwords(strtolower($this->request->data['title']));
            $this->request->data['Eventcategory']['status'] = $this->request->data['status'];
            $this->request->data['Eventcategory']['user_id'] = $userId;
            $eventcategory = $this->Eventcategories->patchEntity($eventcategory, $this->request->data['Eventcategory']);
            if ($this->Eventcategories->save($eventcategory)) {

                if ($this->request->data['image_icon']['name'] != "") {

                    $this->generate_thumb($source, $thm_destination, 300, 250);
                    $this->generate_thumb($source, $destination, 1920, 1080);
                }
                //STORE LOGS
                $this->loadModel('Logs');
                $this->loadModel('Users');

                $userId = $this->request->session()->read('Auth.User.id');
                $findRole = $this->Users->get($userId, [
                    'contain' => ['Roles']
                ]);

                $roleName = $findRole->role->name;
                $activity = 'Event Category Updated';
                $title = $this->request->data['title'];

                $note = $roleName . ' updated the event category (' . $title . ')';

                $logs = $this->Logs->newEntity();
                $this->request->data['Log']['user_id'] = $userId;
                $this->request->data['Log']['activity'] = $activity;
                $this->request->data['Log']['note'] = $note;

                $logs = $this->Logs->patchEntity($logs, $this->request->data['Log']);

                if ($this->Logs->save($logs)) {
                    $this->Flash->success(__('The eventcategory has been saved.'));
                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->success(__('The eventcategory has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The eventcategory could not be saved. Please, try again.'));
        }
        $users = $this->Eventcategories->Users->find('list', ['limit' => 200]);
        $this->set(compact('eventcategory', 'users'));
        $this->set('_serialize', ['eventcategory']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Eventcategory id.
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
        $eventcategory = $this->Eventcategories->get($id);
        if ($this->Eventcategories->delete($eventcategory)) {
            $this->loadModel('Logs');
            $this->loadModel('Users');

            $userId = $this->request->session()->read('Auth.User.id');
            $findRole = $this->Users->get($userId, [
                'contain' => ['Roles']
            ]);

            $roleName = $findRole->role->name;

            $activity = 'Event Category Deleted';
            $note = $roleName . ' deleted the eventcategory (' . $eventcategory->title . ')';

            $logs = $this->Logs->newEntity();
            $this->request->data['Log']['user_id'] = $userId;
            $this->request->data['Log']['activity'] = $activity;
            $this->request->data['Log']['note'] = $note;

            $logs = $this->Logs->patchEntity($logs, $this->request->data['Log']);

            if ($this->Logs->save($logs)) {
                $this->Flash->success(__('The eventcategory has been deleted.'));
            } else {
                $this->Flash->success(__('The eventcategory has been deleted.'));
            }
        } else {
            $this->Flash->error(__('The eventcategory could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function udapteorder() {
        if ($this->request->is('post')) {
            $success = 0;
            foreach ($this->request->data['data']['eventcat_id'] as $key => $data) {
                $eventcategory = $this->Eventcategories->newEntity();
                $this->request->data['Eventcategory']['ordinal'] = $this->request->data['data']['ordinal'][$key];

                $eventcategory->id = $this->request->data['data']['eventcat_id'][$key];
                $eventcategory = $this->Eventcategories->patchEntity($eventcategory, $this->request->data['Eventcategory'], [
                    'validate' => 'OnlyCheck'
                ]);
                //debug($eventcategory);exit;
                if ($this->Eventcategories->save($eventcategory)) {
                    $success = 1;
                } else {
                    $success = 0;
                }
            }

            if ($success == 1) {
                $this->Flash->success(__('Event category  order has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {

                $this->Flash->error(__('Event  category order not saved, try again later'));
                return $this->redirect(array('action' => 'index'));
            }
        }
        $this->viewBuilder()->setLayout();
        $this->autoRender = false;
    }

}
