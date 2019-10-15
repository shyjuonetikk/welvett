<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * TalentEventSubcategories Controller
 *
 * @property \App\Model\Table\TalentEventSubcategoriesTable $TalentEventSubcategories
 *
 * @method \App\Model\Entity\TalentEventSubcategory[] paginate($object = null, array $settings = [])
 */
class TalentEventSubcategoriesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users', 'Eventcategories', 'Eventsubcategories']
        ];
        $talentEventSubcategories = $this->paginate($this->TalentEventSubcategories);

        $this->set(compact('talentEventSubcategories'));
        $this->set('_serialize', ['talentEventSubcategories']);
    }

    /**
     * View method
     *
     * @param string|null $id Talent Event Subcategory id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $talentEventSubcategory = $this->TalentEventSubcategories->get($id, [
            'contain' => ['Users', 'Eventcategories', 'Eventsubcategories']
        ]);

        $this->set('talentEventSubcategory', $talentEventSubcategory);
        $this->set('_serialize', ['talentEventSubcategory']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $talentEventSubcategory = $this->TalentEventSubcategories->newEntity();
        if ($this->request->is('post')) {
            $talentEventSubcategory = $this->TalentEventSubcategories->patchEntity($talentEventSubcategory, $this->request->getData());
            if ($this->TalentEventSubcategories->save($talentEventSubcategory)) {
                $this->Flash->success(__('The talent event subcategory has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The talent event subcategory could not be saved. Please, try again.'));
        }
        $users = $this->TalentEventSubcategories->Users->find('list', ['limit' => 200]);
        $eventcategories = $this->TalentEventSubcategories->Eventcategories->find('list', ['limit' => 200]);
        $eventsubcategories = $this->TalentEventSubcategories->Eventsubcategories->find('list', ['limit' => 200]);
        $this->set(compact('talentEventSubcategory', 'users', 'eventcategories', 'eventsubcategories'));
        $this->set('_serialize', ['talentEventSubcategory']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Talent Event Subcategory id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $talentEventSubcategory = $this->TalentEventSubcategories->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $talentEventSubcategory = $this->TalentEventSubcategories->patchEntity($talentEventSubcategory, $this->request->getData());
            if ($this->TalentEventSubcategories->save($talentEventSubcategory)) {
                $this->Flash->success(__('The talent event subcategory has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The talent event subcategory could not be saved. Please, try again.'));
        }
        $users = $this->TalentEventSubcategories->Users->find('list', ['limit' => 200]);
        $eventcategories = $this->TalentEventSubcategories->Eventcategories->find('list', ['limit' => 200]);
        $eventsubcategories = $this->TalentEventSubcategories->Eventsubcategories->find('list', ['limit' => 200]);
        $this->set(compact('talentEventSubcategory', 'users', 'eventcategories', 'eventsubcategories'));
        $this->set('_serialize', ['talentEventSubcategory']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Talent Event Subcategory id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $talentEventSubcategory = $this->TalentEventSubcategories->get($id);
        if ($this->TalentEventSubcategories->delete($talentEventSubcategory)) {
            $this->Flash->success(__('The talent event subcategory has been deleted.'));
        } else {
            $this->Flash->error(__('The talent event subcategory could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
