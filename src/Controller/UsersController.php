<?php

namespace App\Controller;

use Cake\ORM\Query;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{
    public function index()
    {
        if ($activity_id = $this->getRequest()->getParam('activity_id')) {

        }

        $this->load([
            'contain' => ['Locations', 'Personalities', 'Education']
        ]);
    }

    public function view($id = null)
    {
        $query = $this->Users->find('basicInformation')
            ->select(['sexual_orientation', 'bio', 'education' => 'Education.degree', 'personality' => 'Personalities.type'])
            ->select($this->Users->Locations)
            ->contain([
                'Locations', 'Personalities', 'Education', 'Tags',
                'Activities' => function (Query $query) {
                    return $query->find('basicInformation')->limit(5);
                },
            ]);
        $this->get($id, $query);
    }

    public function login() {
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                if ($this->Auth->authenticationProvider()->needsPasswordRehash()) {
                    $user = $this->Users->get($this->Auth->user('id'));
                    $user->password = $this->request->getData('password');
                    $this->Users->save($user);
                }
                return $this->redirect($this->Auth->redirectUrl());
            } else {
                $this->Flash->error(__('Username or password is incorrect'));
            }
        }
    }
}
