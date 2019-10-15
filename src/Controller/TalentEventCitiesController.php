<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * TalentEventCities Controller
 *
 * @property \App\Model\Table\TalentEventCitiesTable $TalentEventCities
 *
 * @method \App\Model\Entity\TalentEventCity[] paginate($object = null, array $settings = [])
 */
class TalentEventCitiesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['TalentEvents', 'Eventcategories']
        ];
        $talentEventCities = $this->paginate($this->TalentEventCities);

        $this->set(compact('talentEventCities'));
        $this->set('_serialize', ['talentEventCities']);
    }

    /**
     * View method
     *
     * @param string|null $id Talent Event City id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $talentEventCity = $this->TalentEventCities->get($id, [
            'contain' => ['TalentEvents', 'Eventcategories']
        ]);

        $this->set('talentEventCity', $talentEventCity);
        $this->set('_serialize', ['talentEventCity']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $talentEventCity = $this->TalentEventCities->newEntity();
        if ($this->request->is('post')) {
            $talentEventCity = $this->TalentEventCities->patchEntity($talentEventCity, $this->request->getData());
            if ($this->TalentEventCities->save($talentEventCity)) {
                $this->Flash->success(__('The talent event city has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The talent event city could not be saved. Please, try again.'));
        }
        $talentEvents = $this->TalentEventCities->TalentEvents->find('list', ['limit' => 200]);
        $eventcategories = $this->TalentEventCities->Eventcategories->find('list', ['limit' => 200]);
        $this->set(compact('talentEventCity', 'talentEvents', 'eventcategories'));
        $this->set('_serialize', ['talentEventCity']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Talent Event City id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $talentEventCity = $this->TalentEventCities->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $talentEventCity = $this->TalentEventCities->patchEntity($talentEventCity, $this->request->getData());
            if ($this->TalentEventCities->save($talentEventCity)) {
                $this->Flash->success(__('The talent event city has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The talent event city could not be saved. Please, try again.'));
        }
        $talentEvents = $this->TalentEventCities->TalentEvents->find('list', ['limit' => 200]);
        $eventcategories = $this->TalentEventCities->Eventcategories->find('list', ['limit' => 200]);
        $this->set(compact('talentEventCity', 'talentEvents', 'eventcategories'));
        $this->set('_serialize', ['talentEventCity']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Talent Event City id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $talentEventCity = $this->TalentEventCities->get($id);
        if ($this->TalentEventCities->delete($talentEventCity)) {
            $this->Flash->success(__('The talent event city has been deleted.'));
        } else {
            $this->Flash->error(__('The talent event city could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
