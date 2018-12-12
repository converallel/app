<?php

namespace App\Controller\Activities;

use App\Controller\AppController;
use Cake\Http\Exception\BadRequestException;

/**
 * ActivitiesUsers Controller
 *
 * @property \App\Model\Table\ActivitiesUsersTable $ActivitiesUsers
 *
 * @method \App\Model\Entity\ActivitiesUser[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ActivitiesUsersController extends AppController
{
    public function index()
    {
        $activity_id = $this->getRequest()->getParam('activity_id');

        $query = $this->ActivitiesUsers->find()
            ->select(['id', 'type'])
            ->contain(['Users' => ['finder' => 'basicInfo']])
            ->where([
                'activity_id' => $activity_id,
                'type IN' => ['Organizing', 'Participating']
            ])
            ->order([
                "FIELD(type, 'Organizing', 'Participating')" => 'ASC',
                'Users.rating' => 'DESC'
            ]);
        $this->load($query);
    }

    public function add()
    {
        $this->incorporateRoutingParams('activity_id');
        $data = $this->getRequest()->getData();
        $isInActivity = $this->ActivitiesUsers->exists([
            'activity_id' => $data['activity_id'],
            'user_id' => $data['user_id'],
            'NOT' => ['type' => 'Following'],
        ]);
        if ($isInActivity && $data['type'] != 'Following') {
            throw new BadRequestException();
        }
        parent::add();
    }

    public function delete($id = null)
    {
        $this->incorporateRoutingParams('activity_id', 'id');
        $data = $this->getRequest()->getData();
        $type = $this->getRequest()->getQueryParams()['type'] ?? null;

        $this->remove([
            'activity_id' => $data['activity_id'],
            'user_id' => $data['id'],
            'type' => $type
        ]);
    }
}
