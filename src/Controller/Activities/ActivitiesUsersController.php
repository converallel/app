<?php

namespace App\Controller\Activities;

use App\Controller\AppController;

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
        $type = $this->getRequest()->getQueryParams()['type'] ?? null;

        $query = $this->ActivitiesUsers->find()
            ->select('id')
            ->contain(['Users' => ['finder' => 'basicInformation']])
            ->where([
                'activity_id' => $activity_id,
                'type' => $type
            ]);
        $this->load($query);
    }

    public function add()
    {
        $this->incorporateRoutingParams('activity_id');
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
