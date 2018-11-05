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
     * @return \Cake\Http\Response
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Locations', 'Personalities', 'Education']
        ];
        $users = $this->paginate($this->Users);

        return $this->response($users);
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
        $user = $this->Users
            ->find('basicInformation')
            ->select(['sexual_orientation', 'bio', 'education' => 'Education.degree', 'personality' => 'Personalities.type'])
            ->select($this->Users->Locations)
            ->contain([
                'Locations', 'Personalities', 'Education', 'Tags',
                'Activities' => function (Query $query) {
                    return $query->find('basicInformation')->limit(5);
                },
            ])
            ->where(['Users.id' => $id])
            ->first();

        if ($user)
            return $this->response($user);

        return $this->response("Not Found", 404);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response
     */
    public function add()
    {
        $user = $this->Users->newEntity();
        $user = $this->Users->patchEntity($user, $this->getRequest()->getData());
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
        $this->getRequest()->allowMethod('patch');
        $user = $this->Users->get($id, [
            'contain' => ['Personalities']
        ]);
        $user = $this->Users->patchEntity($user, $this->getRequest()->getData());
        if ($this->Users->save($user)) {
            return $this->response(null, 204);
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
            return $this->response();
        }
        return $this->response('The user could not be deleted. Please, try again.', 400);
    }
}
