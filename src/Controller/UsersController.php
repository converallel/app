<?php

namespace App\Controller;

use Cake\ORM\TableRegistry;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{
    public function initialize()
    {
        parent::initialize();
//        $this->Auth->allow(['add', 'login']);
    }

    public function view($id = null)
    {
        $activities = TableRegistry::getTableLocator()->get('Activities')
            ->find('relatedToUser', ['user_id' => $id]);

        $query = $this->Users->find('basicInfo')
            ->select([
                'bio',
                'education' => 'Education.degree',
                'personality' => 'Personalities.type',
                'sexual_orientation',
            ])
            ->select($this->Users->Locations)
            ->contain([
                'Education',
                'Locations',
                'Personalities',
                'Tags',
            ])
            ->formatResults(function (\Cake\Collection\CollectionInterface $results) use ($activities) {
                return $results->map(function ($row) use ($activities) {
                    $row['activities'] = $activities;
                    return $row;
                });
            });

        $this->get($id, $query);
    }

    public function login()
    {
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
