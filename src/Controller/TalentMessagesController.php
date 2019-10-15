<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * TalentMessages Controller
 *
 * @property \App\Model\Table\TalentMessagesTable $TalentMessages
 *
 * @method \App\Model\Entity\TalentMessage[] paginate($object = null, array $settings = [])
 */
class TalentMessagesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users', 'TalentEvents']
        ];
        $talentMessages = $this->paginate($this->TalentMessages);

        $this->set(compact('talentMessages'));
        $this->set('_serialize', ['talentMessages']);
    }

    /**
     * View method
     *
     * @param string|null $id Talent Message id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $talentMessage = $this->TalentMessages->get($id, [
            'contain' => ['Users', 'TalentEvents']
        ]);

        $this->set('talentMessage', $talentMessage);
        $this->set('_serialize', ['talentMessage']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $talentMessage = $this->TalentMessages->newEntity();
        if ($this->request->is('post')) {
            $talentMessage = $this->TalentMessages->patchEntity($talentMessage, $this->request->getData());
            if ($this->TalentMessages->save($talentMessage)) {
                $this->Flash->success(__('The talent message has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The talent message could not be saved. Please, try again.'));
        }
        $users = $this->TalentMessages->Users->find('list', ['limit' => 200]);
        $talentEvents = $this->TalentMessages->TalentEvents->find('list', ['limit' => 200]);
        $this->set(compact('talentMessage', 'users', 'talentEvents'));
        $this->set('_serialize', ['talentMessage']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Talent Message id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $talentMessage = $this->TalentMessages->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $talentMessage = $this->TalentMessages->patchEntity($talentMessage, $this->request->getData());
            if ($this->TalentMessages->save($talentMessage)) {
                $this->Flash->success(__('The talent message has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The talent message could not be saved. Please, try again.'));
        }
        $users = $this->TalentMessages->Users->find('list', ['limit' => 200]);
        $talentEvents = $this->TalentMessages->TalentEvents->find('list', ['limit' => 200]);
        $this->set(compact('talentMessage', 'users', 'talentEvents'));
        $this->set('_serialize', ['talentMessage']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Talent Message id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $talentMessage = $this->TalentMessages->get($id);
        if ($this->TalentMessages->delete($talentMessage)) {
            $this->Flash->success(__('The talent message has been deleted.'));
        } else {
            $this->Flash->error(__('The talent message could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
