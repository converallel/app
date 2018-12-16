<?php

namespace App\Controller;

/**
 * Applications Controller
 *
 * @property \App\Model\Table\ApplicationsTable $Applications
 *
 * @method \App\Model\Entity\Application[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ApplicationsController extends AppController
{
    public function index()
    {
        $activity_id = $this->getRequest()->getParam('activity_id');
        $query = $this->Applications
            ->find()
            ->selectAllExcept($this->Applications, ['activity_id', 'user_id'])
            ->contain(['Users' => ['finder' => 'basicInfo']])
            ->where(['activity_id' => $activity_id])
            ->limit(2);

        $this->load($query);
    }
}
