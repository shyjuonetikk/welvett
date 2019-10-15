<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Sliders Controller
 *
 * @property \App\Model\Table\SlidersTable $Sliders
 *
 * @method \App\Model\Entity\Slider[] paginate($object = null, array $settings = [])
 */
class SlidersController extends AppController
{


    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function sliderlist()
    {

        $permission = $this->viewVars['actionPermission'];

        if ($permission == 1 || $permission == 2) {

        } else {
            return $this->redirect(['controller' => 'Pages', 'action' => 'welcome']);
        }
        $this->set(compact('permission'));

        $this->paginate = ['conditions' => [

        ],'order' => ['Sliders.ordinal' => 'ASC']];
        $sliders = $this->paginate($this->Sliders);

        $this->set(compact('sliders'));
        $this->set('_serialize', ['sliders']);
        $this->viewBuilder()->setLayout('backend');
    }

    /**
     * View method
     *
     * @param string|null $id Slider id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $permission = $this->viewVars['actionPermission'];

        if ($permission == 1 || $permission == 2) {

        } else {
            return $this->redirect(['controller' => 'Pages', 'action' => 'welcome']);
        }
        $this->set(compact('permission'));

        $slider = $this->Sliders->get($id, [
            'contain' => []
        ]);

        $this->set('slider', $slider);
        $this->set('_serialize', ['slider']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $permission = $this->viewVars['actionPermission'];

        if ($permission == 2) {

        } else {
            return $this->redirect(['controller' => 'Pages', 'action' => 'welcome']);
        }
        $this->set(compact('permission'));

        $slider = $this->Sliders->newEntity();
        if ($this->request->is('post')) {
            $slider_order = $this->Sliders->find('all', [
                'fields' => array('order' => 'MAX(Sliders.ordinal)')
            ]);
            if (!$slider_order) {
                $inc_slider_order = 1;
            }
            $slider_order_array = $slider_order->toArray();
            $inc_slider_order = $slider_order_array[0]['order'] + 1;

            $this->request->data['Slider']['image_alt'] = $this->request->data['title'];
            if ($this->request->data['image']['name'] != "") {
                $ext = strrchr($this->request->data['image']['name'], '.');
                $slider_image = str_replace(" ", "_", $this->request->data['title']) . time() . $ext;
                $source = $this->request->data['image']['tmp_name'];
                $destination = WWW_ROOT . 'img' . DS . 'slider' . DS . $slider_image;
                $thm_destination = WWW_ROOT . 'img' . DS . 'slider' . DS . 'thumbnail' . DS . $slider_image;
                $this->request->data['Slider']['image'] = $slider_image;
            }
            $this->request->data['Slider']['title'] = $this->request->data['title'];
            $this->request->data['Slider']['link'] = $this->request->data['link'];
            $this->request->data['Slider']['status'] = 1;
            $this->request->data['Slider']['ordinal'] = $inc_slider_order;
            $this->request->data['Slider']['user_id'] = $this->request->session()->read('Auth.User.id');

            $slider = $this->Sliders->patchEntity($slider,$this->request->data['Slider']);

            if ($this->Sliders->save($slider)) {
                $this->generate_thumb($source, $thm_destination, 400, 300);
                $this->generate_thumb($source, $destination, 1920, 1080);

                $this->loadModel('Logs');
                $this->loadModel('Users');
                $userId = $this->request->session()->read('Auth.User.id');
                $findRole = $this->Users->get($userId, [
                    'contain' => ['Roles']
                ]);

                $roleName = $findRole->role->name;

                $activity = 'Slider Image Added';

                $note = $roleName . ' added a slider image ';

                $logs = $this->Logs->newEntity();
                $this->request->data['Log']['user_id'] = $userId;
                $this->request->data['Log']['activity'] = $activity;
                $this->request->data['Log']['note'] = $note;

                $logs = $this->Logs->patchEntity($logs, $this->request->data['Log']);

                if ($this->Logs->save($logs)) {
                    $this->Flash->success(__('The slider has been saved.'));
                    return $this->redirect(['action' => 'sliderlist']);
                }

            }
            $this->Flash->error(__('The slider could not be saved. Please, try again.'));
        }
        $this->set(compact('slider'));
        $this->set('_serialize', ['slider']);
        $this->viewBuilder()->setLayout('backend');
    }

    /**
     * Edit method
     *
     * @param string|null $id Slider id.
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

        $slider = $this->Sliders->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {

            if ($this->request->data['image']['name'] != "") {
                $ext = strrchr($this->request->data['image']['name'], '.');
                $slider_image = str_replace(" ", "_", $this->request->data['title']) . time() . $ext;
                $source = $this->request->data['image']['tmp_name'];
                $destination = WWW_ROOT . 'img' . DS . 'slider' . DS . $slider_image;
                $thm_destination = WWW_ROOT . 'img' . DS . 'slider' . DS . 'thumbnail' . DS . $slider_image;
                $this->request->data['Slider']['image'] = $slider_image;
            }
            else {
                unset($this->request->data['Slider']['image']); 
            }
            $this->request->data['Slider']['image_alt'] = $this->request->data['image_alt'];
            $this->request->data['Slider']['title'] = $this->request->data['title'];
            $this->request->data['Slider']['link'] = $this->request->data['link'];
            $this->request->data['Slider']['status'] = $this->request->data['status'];
            $this->request->data['Slider']['user_id'] = $this->request->session()->read('Auth.User.id');

            $slider = $this->Sliders->patchEntity($slider, $this->request->data['Slider']);

            if ($this->Sliders->save($slider)) {
                if ($this->request->data['image']['name'] != "") {
                    $this->generate_thumb($source, $thm_destination, 400, 300);
                    $this->generate_thumb($source, $destination, 1920, 1080);
                }        
                $this->loadModel('Logs');
                $this->loadModel('Users');
                $userId = $this->request->session()->read('Auth.User.id');
                $findRole = $this->Users->get($userId, [
                    'contain' => ['Roles']
                ]);

                $roleName = $findRole->role->name;

                $activity = 'Slider Image Updated';

                $note = $roleName . ' update the slider image ';

                $logs = $this->Logs->newEntity();
                $this->request->data['Log']['user_id'] = $userId;
                $this->request->data['Log']['activity'] = $activity;
                $this->request->data['Log']['note'] = $note;

                $logs = $this->Logs->patchEntity($logs, $this->request->data['Log']);

                if ($this->Logs->save($logs)) {
                    $this->Flash->success(__('The slider has been saved.'));
                    return $this->redirect(['action' => 'sliderlist']);
                }
            }
            $this->Flash->error(__('The slider could not be saved. Please, try again.'));
        }
        $this->set(compact('slider'));
        $this->set('_serialize', ['slider']);
        $this->viewBuilder()->setLayout('backend');
    }

    /**
     * Delete method
     *
     * @param string|null $id Slider id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {

        $permission = $this->viewVars['actionPermission'];

        if ($permission == 2) {

        } else {
            return $this->redirect(['controller' => 'Pages', 'action' => 'welcome']);
        }
        $this->set(compact('permission'));

        $this->request->allowMethod(['post', 'delete','get']);
        $slider = $this->Sliders->get($id);
        if ($this->Sliders->delete($slider)) {
            $this->loadModel('Logs');
            $this->loadModel('Users');
            $userId = $this->request->session()->read('Auth.User.id');
            $findRole = $this->Users->get($userId, [
                'contain' => ['Roles']
            ]);

            $roleName = $findRole->role->name;

            $activity = 'Slider Image Deleted';

            $note = $roleName . ' deleted the slider image ';

            $logs = $this->Logs->newEntity();
            $this->request->data['Log']['user_id'] = $userId;
            $this->request->data['Log']['activity'] = $activity;
            $this->request->data['Log']['note'] = $note;

            $logs = $this->Logs->patchEntity($logs, $this->request->data['Log']);

            if ($this->Logs->save($logs)) {
                $this->Flash->success(__('The slider has been deleted.'));
                return $this->redirect(['action' => 'sliderlist']);
            }
        } else {
            $this->Flash->error(__('The slider could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'sliderlist']);
    }
    public function udapteorder() {

        $permission = $this->viewVars['actionPermission'];

        if ($permission == 2) {

        } else {
            return $this->redirect(['controller' => 'Pages', 'action' => 'welcome']);
        }
        $this->set(compact('permission'));

        if ($this->request->is('post')) {
            $success = 0;
            foreach ($this->request->data['data']['slider_id'] as $key => $data) {
                $slider = $this->Sliders->newEntity();
                $this->request->data['Slider']['ordinal'] = $this->request->data['data']['ordinal'][$key];

                $slider->id = $this->request->data['data']['slider_id'][$key];
                $slider = $this->Sliders->patchEntity($slider, $this->request->data['Slider'], [
                    'validate' => 'OnlyCheck'
                ]);

                if ($this->Sliders->save($slider)) {
                    $success = 1;
                } else {
                    $success = 0;
                }
            }

            if ($success == 1) {
                $this->Flash->success(__('Slider order has been saved.'));
                return $this->redirect(array('action' => 'sliderlist'));
            } else {

                $this->Flash->error(__('Slider order not saved, try again later'));
                return $this->redirect(array('action' => 'sliderlist'));
            }
        }
        $this->viewBuilder()->setLayout();
        $this->autoRender = false;
    }

}
