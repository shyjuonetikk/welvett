<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * TalentCalendars Controller
 *
 * @property \App\Model\Table\TalentCalendarsTable $TalentCalendars
 *
 * @method \App\Model\Entity\TalentCalendar[] paginate($object = null, array $settings = [])
 */
class TalentCalendarsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users', 'Bookings', 'TalentEvents']
        ];
        $talentCalendars = $this->paginate($this->TalentCalendars);

        $this->set(compact('talentCalendars'));
        $this->set('_serialize', ['talentCalendars']);
    }

    /**
     * View method
     *
     * @param string|null $id Talent Calendar id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $talentCalendar = $this->TalentCalendars->get($id, [
            'contain' => ['Users', 'Bookings', 'TalentEvents']
        ]);

        $this->set('talentCalendar', $talentCalendar);
        $this->set('_serialize', ['talentCalendar']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $talentCalendar = $this->TalentCalendars->newEntity();
        if ($this->request->is('post')) {
            $talentCalendar = $this->TalentCalendars->patchEntity($talentCalendar, $this->request->getData());
            if ($this->TalentCalendars->save($talentCalendar)) {
                $this->Flash->success(__('The talent calendar has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The talent calendar could not be saved. Please, try again.'));
        }
        $users = $this->TalentCalendars->Users->find('list', ['limit' => 200]);
        $bookings = $this->TalentCalendars->Bookings->find('list', ['limit' => 200]);
        $talentEvents = $this->TalentCalendars->TalentEvents->find('list', ['limit' => 200]);
        $this->set(compact('talentCalendar', 'users', 'bookings', 'talentEvents'));
        $this->set('_serialize', ['talentCalendar']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Talent Calendar id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $talentCalendar = $this->TalentCalendars->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $talentCalendar = $this->TalentCalendars->patchEntity($talentCalendar, $this->request->getData());
            if ($this->TalentCalendars->save($talentCalendar)) {
                $this->Flash->success(__('The talent calendar has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The talent calendar could not be saved. Please, try again.'));
        }
        $users = $this->TalentCalendars->Users->find('list', ['limit' => 200]);
        $bookings = $this->TalentCalendars->Bookings->find('list', ['limit' => 200]);
        $talentEvents = $this->TalentCalendars->TalentEvents->find('list', ['limit' => 200]);
        $this->set(compact('talentCalendar', 'users', 'bookings', 'talentEvents'));
        $this->set('_serialize', ['talentCalendar']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Talent Calendar id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $talentCalendar = $this->TalentCalendars->get($id);
        if ($this->TalentCalendars->delete($talentCalendar)) {
            $this->Flash->success(__('The talent calendar has been deleted.'));
        } else {
            $this->Flash->error(__('The talent calendar could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
