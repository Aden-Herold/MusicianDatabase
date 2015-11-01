<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link      http://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Component;
use Cake\Controller\Component\AuthComponent;
use Cake\Controller\Controller;
use Cake\Event\Event;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link http://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('Auth', [
            'loginAction' => [
                'controller' => 'Musician',
                'action' => 'login'
            ],
            'authError' => 'You are not allowed to access this page.',
            'authenticate' => [
                'Form' => [
                    'fields' => ['username' => 'username', 'password' => 'password']
                ]
            ],
            'storage' => 'Session'
        ]);

        $this->Auth->config('authenticate', ['Form']);

        $this->Auth->config('authenticate', [
            AuthComponent::ALL => ['userModel' => 'Musician'],
            'Basic',
            'Form'
        ]);

        $this->Auth->config('authorize', ['Controller']);


        $this->Auth->allow(['view', 'index', 'register', 'login', 'home']);
        $this->Auth->deny(['add', 'edit', 'delete']);

        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');
    }

    public function isAuthorized($musician = null) {
        if (empty($this->request->params['prefix'])) {
            return true;
        }
        return false;
    }

    /**
     * Before render callback.
     *
     * @param \Cake\Event\Event $event The beforeRender event.
     * @return void
     */
    public function beforeRender(Event $event)
    {
        if (!array_key_exists('_serialize', $this->viewVars) &&
            in_array($this->response->type(), ['application/json', 'application/xml'])
        ) {
            $this->set('_serialize', true);
        }
    }
}
