<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Memberships Controller
 *
 * @property \App\Model\Table\MembershipsTable $Memberships
 *
 * @method \App\Model\Entity\Membership[] paginate($object = null, array $settings = [])
 */
class MembershipsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $permission = $this->viewVars['actionPermission'];
        
         if ($permission == 1 || $permission == 2) {

        } else {
            return $this->redirect(['controller' => 'Pages', 'action' => 'welcome']);
        }
        $this->set(compact('permission'));
        
        $this->viewBuilder()->setLayout('backend');
        $this->paginate = [
            'contain' => ['Users']
        ];
        $memberships = $this->paginate($this->Memberships);

        $this->set(compact('memberships'));
        $this->set('_serialize', ['memberships']);
    }

    /**
     * View method
     *
     * @param string|null $id Membership id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $membership = $this->Memberships->get($id, [
            'contain' => ['Users']
        ]);

        $this->set('membership', $membership);
        $this->set('_serialize', ['membership']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $membership = $this->Memberships->newEntity();
        if ($this->request->is('post')) {
            $membership = $this->Memberships->patchEntity($membership, $this->request->getData());
            if ($this->Memberships->save($membership)) {
                $this->Flash->success(__('The membership has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The membership could not be saved. Please, try again.'));
        }
        $users = $this->Memberships->Users->find('list', ['limit' => 200]);
        $this->set(compact('membership', 'users'));
        $this->set('_serialize', ['membership']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Membership id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $permission = $this->viewVars['actionPermission'];

        if ($permission == 2) {

        } else {
            return $this->redirect(['controller' => 'Pages', 'action' => 'welcome']);
        }
        $this->set(compact('permission'));

        $this->viewBuilder()->setLayout('backend');
        $membership = $this->Memberships->get($id, [
            'contain' => ['Users']
        ]);
       
        if ($this->request->is(['patch', 'post', 'put'])) {
            
            $this->request->data['Membership']['amount'] = $this->request->data['amount'];
            $this->request->data['Membership']['pay_date'] = date('y/n/j', strtotime($this->request->data['pay_date']));
            $this->request->data['Membership']['expiry_date'] = date('y/n/j', strtotime($this->request->data['expiry_date']));
            $this->request->data['Membership']['status'] = $this->request->data['status'];
            $membership = $this->Memberships->patchEntity($membership, $this->request->data['Membership']);
            if ($this->Memberships->save($membership)) {
                //STORE LOGS
                    $this->loadModel('Logs');
                    $this->loadModel('Users');

                    $userId = $this->request->session()->read('Auth.User.id');
                    $findRole = $this->Users->get($userId, [
                        'contain' => ['Roles']
                    ]);

                    $roleName = $findRole->role->name;
                    $activity = 'Membership Updated';
                    $title= $membership['user']['user_name'];

                    $note = $roleName . ' updated the membership (' . $title . ')';

                    $logs = $this->Logs->newEntity();
                    $this->request->data['Log']['user_id'] = $userId;
                    $this->request->data['Log']['activity'] = $activity;
                    $this->request->data['Log']['note'] = $note;

                    $logs = $this->Logs->patchEntity($logs, $this->request->data['Log']);

                    if ($this->Logs->save($logs)) {
                        $this->Flash->success(__('The membership has been saved.'));
                        return $this->redirect(['action' => 'index']);
                    }
                $this->Flash->success(__('The membership has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The membership could not be saved. Please, try again.'));
        }
        $users = $this->Memberships->Users->find('list', ['limit' => 200]);
        $this->set(compact('membership', 'users'));
        $this->set('_serialize', ['membership']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Membership id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete','get']);
        $membership = $this->Memberships->get($id,[
            'contain' => ['Users']
        ]);
        if ($this->Memberships->delete($membership)) {
            $this->loadModel('Logs');
            $this->loadModel('Users');

            $userId = $this->request->session()->read('Auth.User.id');
            $findRole = $this->Users->get($userId, [
                'contain' => ['Roles']
            ]);

            $roleName = $findRole->role->name;

            $activity = 'Event Category Deleted';
            $note = $roleName . ' deleted the membership  (' . $membership['user']['user_name'] . ')';

            $logs = $this->Logs->newEntity();
            $this->request->data['Log']['user_id'] = $userId;
            $this->request->data['Log']['activity'] = $activity;
            $this->request->data['Log']['note'] = $note;

            $logs = $this->Logs->patchEntity($logs, $this->request->data['Log']);

            if ($this->Logs->save($logs)) {
                $this->Flash->success(__('The membership  has been deleted.'));
            } else {
                $this->Flash->success(__('The membership  has been deleted.'));
            }
           
        } else {
            $this->Flash->error(__('The membership could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
