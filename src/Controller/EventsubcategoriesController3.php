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
class EventsubcategoriesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Eventcategories', 'Users']
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
    public function view($id = null)
    {
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
    public function add()
    {
        $eventsubcategory = $this->Eventsubcategories->newEntity();
        if ($this->request->is('post')) {
            $eventsubcategory = $this->Eventsubcategories->patchEntity($eventsubcategory, $this->request->getData());
            if ($this->Eventsubcategories->save($eventsubcategory)) {
                $this->Flash->success(__('The eventsubcategory has been saved.'));

                return $this->redirect(['action' => 'index']);
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
    public function edit($id = null)
    {
        $eventsubcategory = $this->Eventsubcategories->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $eventsubcategory = $this->Eventsubcategories->patchEntity($eventsubcategory, $this->request->getData());
            if ($this->Eventsubcategories->save($eventsubcategory)) {
                $this->Flash->success(__('The eventsubcategory has been saved.'));

                return $this->redirect(['action' => 'index']);
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
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $eventsubcategory = $this->Eventsubcategories->get($id);
        if ($this->Eventsubcategories->delete($eventsubcategory)) {
            $this->Flash->success(__('The eventsubcategory has been deleted.'));
        } else {
            $this->Flash->error(__('The eventsubcategory could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
