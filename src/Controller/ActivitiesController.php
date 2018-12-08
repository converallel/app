<?php

namespace App\Controller;

/**
 * Activities Controller
 *
 * @property \App\Model\Table\ActivityFiltersTable $ActivityFilters
 * @property \App\Model\Table\ActivitiesTable $Activities
 *
 * @method \App\Model\Entity\Activity[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ActivitiesController extends AppController
{

    public function index()
    {
        $user_id = $this->current_user->id;

        $start_date = timestamp();
        $end_date = date("Y-m-d H:i:s", strtotime("+10 year"));

        $this->loadModel('ActivityFilters');
        $this->ActivityFilters->find()
            ->contain(['Locations' => ['fields' => ['latitude', 'longitude', 'time_zone']]])
            ->where(['user_id' => $user_id]);

        $query = $this->Activities
            ->find('basicInfo')
            ->where([
                'start_date BETWEEN :start_date AND :end_date',
                'is_pair' => true,
                'Activities.status' => 'Active',
            ])
            ->order([
                'Activities.start_date' => 'ASC',
                'Activities.id' => 'DESC'
            ])
            ->limit(10)
            ->bind(':start_date', $start_date)
            ->bind(':end_date', $end_date);

        $options = ['pagination' => ['maxLimit' => 10]];
        $this->load($query, $options);
    }

    public function view($id = null)
    {
        $this->get($id, [
            'finder' => 'basicInfo',
            'fields' => ['application_count', 'review_count'],
            'contain' => ['ActivityItineraries']
        ]);
    }

    public function add()
    {
        $this->create([
            ['objectHydration' => ['associated' => ['Tags' => ['onlyIds' => true]]]]
        ]);
    }
}
