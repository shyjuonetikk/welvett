<?php

/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */

namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\Utility\Inflector;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    public function initialize() {
        parent::initialize();
        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');

        $this->loadComponent('Auth', [
            'authenticate' => [
                'Form' => [
                    'fields' => [
                        'username' => 'user_name',
                        'password' => 'password'
                    ],
                    'contain' => ['TalentEvents', 'TalentCalendars', 'TalentEventSubcategories']
                ]
            ],
            'logoutRedirect' => [
                'controller' => 'Users',
                'action' => 'customer_login'
            ],
            'authorize' => ['Controller'],
            'loginAction' => [
                'controller' => 'Users',
                'action' => 'login'
            ]
        ]);


        /*
         * Enable the following component for recommended CakePHP security settings.
         * see https://book.cakephp.org/3.0/en/controllers/components/security.html
         */
        //$this->loadComponent('Security');
    }

    /**
     * Before render callback.
     *
     * @param \Cake\Event\Event $event The beforeRender event.
     * @return \Cake\Network\Response|null|void
     */
    public function beforeRender(Event $event) {
        if (!array_key_exists('_serialize', $this->viewVars) &&
                in_array($this->response->type(), ['application/json', 'application/xml'])
        ) {
            $this->set('_serialize', true);
        }
    }

    public function beforeFilter(Event $event) {
        // allow only login, forgotpassword

        $this->Auth->allow(['home', 'contact','logout', 'privacyPolicy', 'editImage', 'getFlightInfo', 'verification', 'fetchCities', 'registeremployee', 'registercorporate', 'employeeLogin', 'sms', 'instagramauth', 'registerindividual', 'category', 'categories', 'individualEvents', 'customerLogin', 'searchtext', 'findSubServices', 'categoriesDesign', 'deleteAccoCity', 'updateProfileInfo', 'searchStates', 'resendCode', 'profile', 'waitingForApproval', 'forgotPassword', 'resetPassword', 'comingSoon', 'about', 'faq', 'welvettIos', 'welvettAndroid', 'termofUse']);

        $this->loadModel('Eventcategories');
        $services = $this->Eventcategories->find('list', [
                    'keyField' => 'id',
                    'valueField' => 'title',
                    'conditions' => ['Eventcategories.status' => 1]
                ])->toArray();

        $this->set(compact('services'));

        $this->loadModel('Bookings');
        $this->loadModel('TalentMessages');
        $userId = $this->Auth->user('id');
        $roleId = $this->Auth->user('role_id');
        if ($roleId == 2 || $roleId == 3) {
            $u = "Talents";
            $type = 'customer_id';
        } else {
            $u = 'Customers';
            $type = 'talent_id';
        }
        $getMessages = $this->Bookings->find('all')
                ->contain([
                    'TalentMessages' => function($r) use($userId) {
                        $r
                        ->where(['TalentMessages.is_read' => '0', 'TalentMessages.user_id !=' => $userId])
                        ->group(['TalentMessages.booking_id']);
                        return $r;
                    }])
                ->where([
                    'status !=' => 1,
                    $type => $userId])
                ->toArray();

        $latest_msg = $this->TalentMessages->find('all')
                ->contain(['Bookings', 'Users'])
                ->where(['TalentMessages.user_id !=' => $userId, 'Bookings.' . $type => $userId])
                ->group('TalentMessages.user_id')
                ->order('TalentMessages.created desc')
                ->limit(5)
                ->toArray();

        $messageCount = 0;
        foreach ($getMessages as $msg):
            if (!empty($msg->talent_messages)) {
                $messageCount++;
            }
        endforeach;
        $this->loadModel('Eventcategories');
        $this->loadModel('Eventsubcategories');
        $eventcategories = $this->Eventcategories->find('all');
        $eventsubcategories = $this->Eventsubcategories->find('all');
        $this->set(compact('eventsubcategories', 'eventcategories'));
        $eventcateg = $this->Eventcategories->find('list');
        $eventsubcateg = $this->Eventsubcategories->find('list');
        $this->set(compact('eventsubcateg', 'eventcateg'));

        $this->loadModel('Modules');
        $modulesList = $this->Modules->find('all', [
                    'order' => ['Modules.id' => 'ASC']
                ])->toArray();


        // role id and permission controller

        $roleId = $this->request->session()->read('Auth.User.role_id');
        $url = $_SERVER['REQUEST_URI'];

        $urlArray = $this->request->params['controller'];

        $controller = strtoupper($urlArray);


        $actionPermission = $this->permissionsList($roleId, $controller);
        //        debug($actionPermission);
        //        debug($roleId);
        if ($this->Auth->user('role_id') == 4) {
            $this->loadModel('Memberships');
            $membership = $this->Memberships->find('all', [
                        'conditions' => ['user_id' => $this->Auth->user('id'), 'expiry_date >' => date('Y-m-d')]
                    ])->first();
            $this->set(compact('membership'));
        }
        $this->loadModel('Notifications');

        $notifications = $this->Notifications->find('all')
                ->contain([$u])
                ->where([$type => $this->Auth->user('id'), 'activity_by !=' => $this->Auth->user('id')])
                ->order(['created DESC'])
                ->toArray();
        $unread_notifications = $this->Notifications->find('all')
                ->where([$type => $this->Auth->user('id'), 'is_read' => 0, 'activity_by !=' => $this->Auth->user('id')])
                ->count();
        $this->set(compact('modulesList', 'unread_notifications', 'getMessages', 'messageCount', 'roleId', 'latest_msg', 'notifications'));
        $this->set(compact('actionPermission'));
    }

    public function isAuthorized($user) {

        if ($this->Auth->user('id') != '') {
            return true;
        }
        if ($this->viewVars['actionPermission'] != "") {
            return true;
        } else {
            return false;
        }
    }

    public function permissionsList($roleId, $controller) {
        $this->loadModel('Roles');

        $this->loadModel('Modules');
        // module => rights , => roles
        $module = $this->Modules->find('all', [
                    'contain' => ['Rights' => [
                            'conditions' => [
                                'Rights.role_id' => $roleId
                            ]
                        ]],
                    'conditions' => ['Modules.controller' => $controller]
                ])->first();
        //$moduleId = $module->id;
        if (isset($module['rights'][0]['per_type']) && $module['rights'][0]['per_type'] != "") {
            return $module['rights'][0]['per_type'];
        } else {

            return false;
        }
    }

    public function generate_thumb($source_image_path, $thumbnail_image_path, $max_width, $max_height) {
        list($source_image_width, $source_image_height, $source_image_type) = getimagesize($source_image_path);

        switch ($source_image_type) {

            case IMAGETYPE_GIF:
                $source_gd_image = imagecreatefromgif($source_image_path);

                break;

            case IMAGETYPE_JPEG:

                $source_gd_image = imagecreatefromjpeg($source_image_path);

                break;

            case IMAGETYPE_PNG:

                $source_gd_image = imagecreatefrompng($source_image_path);

                break;
        }

        $source_aspect_ratio = $source_image_width / $source_image_height;

        $thumbnail_aspect_ratio = $max_width / $max_height;

        if ($source_image_width <= $max_width && $source_image_height <= $max_height) {

            $thumbnail_image_width = $source_image_width;

            $thumbnail_image_height = $source_image_height;
        } elseif ($thumbnail_aspect_ratio > $source_aspect_ratio) {

            $thumbnail_image_width = (int) ($max_height * $source_aspect_ratio);

            $thumbnail_image_height = $max_height;
        } else {

            $thumbnail_image_width = $max_width;

            $thumbnail_image_height = (int) ($max_width / $source_aspect_ratio);
        }

        $newImg = imagecreatetruecolor($thumbnail_image_width, $thumbnail_image_height);
        imagealphablending($newImg, false);
        imagesavealpha($newImg, true);
        $transparent = imagecolorallocatealpha($newImg, 255, 255, 255, 127);
        imagefilledrectangle($newImg, 0, 0, $thumbnail_image_width, $thumbnail_image_height, $transparent);
        imagecopyresampled($newImg, $source_gd_image, 0, 0, 0, 0, $thumbnail_image_width, $thumbnail_image_height, $source_image_width, $source_image_height);

        imagepng($newImg, $thumbnail_image_path);
        return true;
    }

    /* ------ Image Resize Function ------- */

    //    public function generate_thumb($source_image_path, $thumbnail_image_path, $max_width, $max_height) {
    //        $this->viewBuilder()->setLayout('');
    //        $this->autoRender = false;
    //        list($source_image_width, $source_image_height, $source_image_type) = getimagesize($source_image_path);
    //        switch ($source_image_type) {
    //
    //            case IMAGETYPE_GIF:
    //
    //                $source_gd_image = imagecreatefromgif($source_image_path);
    //
    //                break;
    //
    //            case IMAGETYPE_JPEG:
    //
    //                $source_gd_image = imagecreatefromjpeg($source_image_path);
    //
    //                break;
    //
    //            case IMAGETYPE_PNG:
    //
    //                $source_gd_image = imagecreatefrompng($source_image_path);
    //
    //                break;
    //        }
    //
    //        if ($source_gd_image === false) {
    //
    //            return false;
    //        }
    //
    //        $source_aspect_ratio = $source_image_width / $source_image_height;
    //
    //        $thumbnail_aspect_ratio = $max_width / $max_height;
    //
    //        if ($source_image_width <= $max_width && $source_image_height <= $max_height) {
    //
    //            $thumbnail_image_width = $source_image_width;
    //
    //            $thumbnail_image_height = $source_image_height;
    //        } elseif ($thumbnail_aspect_ratio > $source_aspect_ratio) {
    //
    //            $thumbnail_image_width = (int) ($max_height * $source_aspect_ratio);
    //
    //            $thumbnail_image_height = $max_height;
    //        } else {
    //
    //            $thumbnail_image_width = $max_width;
    //
    //            $thumbnail_image_height = (int) ($max_width / $source_aspect_ratio);
    //        }
    //
    //        $thumbnail_gd_image = imagecreatetruecolor($thumbnail_image_width, $thumbnail_image_height);
    //
    //        $white = imagecolorallocate($thumbnail_gd_image, 255, 255, 255);
    //
    //        imagefill($thumbnail_gd_image, 0, 0, $white);
    //
    //        imagecopyresampled($thumbnail_gd_image, $source_gd_image, 0, 0, 0, 0, $thumbnail_image_width, $thumbnail_image_height, $source_image_width, $source_image_height);
    //
    //        imagejpeg($thumbnail_gd_image, $thumbnail_image_path, 90);
    //
    //        imagedestroy($source_gd_image);
    //
    //        imagedestroy($thumbnail_gd_image);
    //
    //        return true;
    //    }
}
