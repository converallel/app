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

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Locations', 'Personalities', 'Education']
        ];
        $users = $this->paginate($this->Users);

        $this->set(['users' => $users, '_serialize' => 'users']);
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => ['Locations', 'Personalities', 'Education', 'Activities', 'FollowingTags',]
        ]);

        return $this->response($user);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response
     */
    public function add()
    {
        $user = $this->Users->newEntity();
        $user = $this->Users->patchEntity($user, $this->request->getData());
        if ($user = $this->Users->save($user)) {
            return $this->response(['id' => $user->id]);
        }
        return $this->response('The user could not be saved. Please, try again.', 400);
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => ['Activities']
        ]);
        $user = $this->Users->patchEntity($user, $this->request->getData());
        if ($this->Users->save($user)) {
            return $this->getResponse();
        }
        return $this->response('The user could not be saved. Please, try again.', 400);
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            return $this->getResponse();
        }
        return $this->response('The user could not be deleted. Please, try again.', 400);
    }
}
