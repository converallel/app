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
use Cake\Controller\Exception\SecurityException;
use Cake\Core\Configure;
use Cake\Event\Event;
use Cake\Routing\Router;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{

    protected $user_id = 2;

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     * @throws \Exception
     */
    public function initialize()
    {
        parent::initialize();

//        $this->loadComponent('Auth', [
//            'authenticate' => [
//                'Digest' => [
//                    'fields' => ['username' => ['email', 'phone_number'], 'password' => 'digest_hash'],
//                    'userModel' => 'Users'
//                ],
//            ],
//            'storage' => 'Memory',
//            'unauthorizedRedirect' => false
//        ]);
        $this->loadComponent('RequestHandler', [
            'enableBeforeRedirect' => false,
        ]);
//        $this->loadComponent('Security', ['blackHoleCallback' => 'forceSSL']);

//        $this->user_id = $this->Auth->user('id');
        Configure::write('user_id', $this->user_id);
    }


    public function beforeFilter(Event $event)
    {
//        $this->Security->requireSecure();
    }

    /**
     * @param string $error
     * @param SecurityException|null $exception
     * @return \Cake\Http\Response|null
     */
    public function forceSSL($error = '', SecurityException $exception = null)
    {
        if ($exception instanceof SecurityException && $exception->getType() === 'secure') {
            return $this->redirect('https://' . env('SERVER_NAME') . Router::url($this->request->getRequestTarget()));
        }

        throw $exception;
    }

    /**
     * @param array|string $data
     * @param int $status
     * @return \Cake\Http\Response
     */
    protected function response($data = null, $status = 200)
    {
        if (is_string($data))
            $data = ['message' => $data];

        if (is_null($data))
            return $this->getResponse()->withStatus($status)->withType('application/json');
        else
            return $this->getResponse()->withStringBody(json_encode($data))->withStatus($status)->withType('application/json');
    }
}
