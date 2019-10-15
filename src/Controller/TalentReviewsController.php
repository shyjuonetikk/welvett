<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * TalentReviews Controller
 *
 * @property \App\Model\Table\TalentReviewsTable $TalentReviews
 *
 * @method \App\Model\Entity\TalentReview[] paginate($object = null, array $settings = [])
 */
class TalentReviewsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Talents', 'TalentEvents', 'Customers']
        ];
        $talentReviews = $this->paginate($this->TalentReviews);

        $this->set(compact('talentReviews'));
        $this->set('_serialize', ['talentReviews']);
    }

    /**
     * View method
     *
     * @param string|null $id Talent Review id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $talentReview = $this->TalentReviews->get($id, [
            'contain' => ['Talents', 'TalentEvents', 'Customers']
        ]);

        $this->set('talentReview', $talentReview);
        $this->set('_serialize', ['talentReview']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $talentReview = $this->TalentReviews->newEntity();
        if ($this->request->is('post')) {
            $talentReview = $this->TalentReviews->patchEntity($talentReview, $this->request->getData());
            if ($this->TalentReviews->save($talentReview)) {
                $this->Flash->success(__('The talent review has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The talent review could not be saved. Please, try again.'));
        }
        $talents = $this->TalentReviews->Talents->find('list', ['limit' => 200]);
        $talentEvents = $this->TalentReviews->TalentEvents->find('list', ['limit' => 200]);
        $customers = $this->TalentReviews->Customers->find('list', ['limit' => 200]);
        $this->set(compact('talentReview', 'talents', 'talentEvents', 'customers'));
        $this->set('_serialize', ['talentReview']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Talent Review id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $talentReview = $this->TalentReviews->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $talentReview = $this->TalentReviews->patchEntity($talentReview, $this->request->getData());
            if ($this->TalentReviews->save($talentReview)) {
                $this->Flash->success(__('The talent review has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The talent review could not be saved. Please, try again.'));
        }
        $talents = $this->TalentReviews->Talents->find('list', ['limit' => 200]);
        $talentEvents = $this->TalentReviews->TalentEvents->find('list', ['limit' => 200]);
        $customers = $this->TalentReviews->Customers->find('list', ['limit' => 200]);
        $this->set(compact('talentReview', 'talents', 'talentEvents', 'customers'));
        $this->set('_serialize', ['talentReview']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Talent Review id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete', 'get']);
        $talentReview = $this->TalentReviews->get($id);
        if ($this->TalentReviews->delete($talentReview)) {
            $this->Flash->success(__('The talent review has been deleted.'));
        } else {
            $this->Flash->error(__('The talent review could not be deleted. Please, try again.'));
        }

        return $this->redirect(['controller' => 'Users', 'action' => 'employee']);
    }
}
