<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * CustomerReviews Controller
 *
 * @property \App\Model\Table\CustomerReviewsTable $CustomerReviews
 *
 * @method \App\Model\Entity\CustomerReview[] paginate($object = null, array $settings = [])
 */
class CustomerReviewsController extends AppController {

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index($id = null) {
        $permission = $this->viewVars['actionPermission'];
        $this->set('content_title', 'Customer Reviews');


        if ($permission == 1 || $permission == 2) {
            
        } else {
            return $this->redirect(['controller' => 'Pages', 'action' => 'welcome']);
        }
        $this->set(compact('permission'));

        $this->viewBuilder()->setLayout('backend');
        $this->paginate = [
            'contain' => ['CustomerUsers', 'TalentEvents' => ['TalentEventSubcategories' => 'Eventcategories'], 'TalentUsers'],
            'conditions' => ['customer_id' => $id
            ]
        ];
        $customerReviews = $this->paginate();
        //debug($customerReviews['talent_event']['talent_event_subcategories'][0]['eventcategory']['title']);exit;
        $this->set(compact('customerReviews'));
        $this->set('_serialize', ['customerReviews']);
    }

    /**
     * View method
     *
     * @param string|null $id Customer Review id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        $customerReview = $this->CustomerReviews->get($id, [
            'contain' => ['CustomerUsers', 'TalentEvents', 'TalentUsers']
        ]);

        $this->set('customerReview', $customerReview);
        $this->set('_serialize', ['customerReview']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $customerReview = $this->CustomerReviews->newEntity();
        if ($this->request->is('post')) {
            $customerReview = $this->CustomerReviews->patchEntity($customerReview, $this->request->getData());
            if ($this->CustomerReviews->save($customerReview)) {
                $this->Flash->success(__('The customer review has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The customer review could not be saved. Please, try again.'));
        }
        $customers = $this->CustomerReviews->Customers->find('list', ['limit' => 200]);
        $talentEvents = $this->CustomerReviews->TalentEvents->find('list', ['limit' => 200]);
        $talents = $this->CustomerReviews->Talents->find('list', ['limit' => 200]);
        $this->set(compact('customerReview', 'customers', 'talentEvents', 'talents'));
        $this->set('_serialize', ['customerReview']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Customer Review id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null, $user_id = null) {
        $id = $_GET['id'];
        $useriid = $_GET['user_id'];

        $permission = $this->viewVars['actionPermission'];

        if ($permission == 2) {
            
        } else {
            return $this->redirect(['controller' => 'Pages', 'action' => 'welcome']);
        }
        $this->set(compact('permission'));

        $this->viewBuilder()->setLayout('backend');

        $customerReview = $this->Customerreviews->get($id, [
            'contain' => ['CustomerUsers', 'TalentEvents' => ['TalentEventSubcategories' => 'Eventcategories'], 'TalentUsers']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {

            $customerReview = $this->Customerreviews->patchEntity($customerReview, $this->request->getData());

            if ($this->Customerreviews->save($customerReview)) {
                //STORE LOGS
                $this->loadModel('Logs');
                $this->loadModel('Users');

                $userId = $this->request->session()->read('Auth.User.id');
                $findRole = $this->Users->get($userId, [
                    'contain' => ['Roles']
                ]);

                $roleName = $findRole->role->name;
                $activity = 'Review Updated';
                $review = $this->request->data['review'];

                $note = $roleName . ' updated the review (' . $review . ')';

                $logs = $this->Logs->newEntity();
                $this->request->data['Log']['user_id'] = $userId;
                $this->request->data['Log']['activity'] = $activity;
                $this->request->data['Log']['note'] = $note;

                $logs = $this->Logs->patchEntity($logs, $this->request->data['Log']);

                if ($this->Logs->save($logs)) {
                    $this->Flash->success(__('The customer review has been saved.'));

                    return $this->redirect(['action' => 'index', $useriid]);
                }

                $this->Flash->success(__('The customer review has been saved.'));

                return $this->redirect(['action' => 'index', $useriid]);
            }
            $this->Flash->error(__('The customer review could not be saved. Please, try again.'));
        }
        // $customers = $this->Customerreviews->Customers->find('list', ['limit' => 200]);
        //$talentEvents = $this->Customerreviews->TalentEvents->find('list', ['limit' => 200]);
        // $talents = $this->Customerreviews->Talents->find('list', ['limit' => 200]);
        $this->set(compact('customerReview', 'customers', 'talentEvents', 'talents', 'useriid'));
        $this->set('_serialize', ['customerReview']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Customer Review id.
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

        $this->viewBuilder()->setLayout('backend');
        $this->loadModel('CustomerReviews');
        $this->request->allowMethod(['post', 'delete', 'get']);
        $customerReview = $this->CustomerReviews->get($id);
        if ($this->CustomerReviews->delete($customerReview)) {
            //STORE LOGS
            $this->loadModel('Logs');
            $this->loadModel('Users');

            $userId = $this->request->session()->read('Auth.User.id');
            $findRole = $this->Users->get($userId, [
                'contain' => ['Roles']
            ]);

            $roleName = $findRole->role->name;

            $activity = 'State Deleted';
            $note = $roleName . ' deleted the state a review';

            $logs = $this->Logs->newEntity();
            $this->request->data['Log']['user_id'] = $userId;
            $this->request->data['Log']['activity'] = $activity;
            $this->request->data['Log']['note'] = $note;

            $logs = $this->Logs->patchEntity($logs, $this->request->data['Log']);

            if ($this->Logs->save($logs)) {
                $this->Flash->success(__('The customer review has been deleted.'));
            } else {
                $this->Flash->success(__('The customer review has been deleted.'));
            }
            $this->Flash->success(__('The customer review has been deleted.'));
        } else {
            $this->Flash->error(__('The customer review could not be deleted. Please, try again.'));
        }

        return $this->redirect(['controller' => 'customerreviews','action' => 'index']);
    }

}
