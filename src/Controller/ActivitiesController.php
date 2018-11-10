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
        $user_id = $this->user_id;
        $start_date = date("Y-m-d h:i:s");
        $end_date = date("Y-m-d h:i:s", strtotime("+10 year"));

        $this->loadModel('ActivityFilters');

        $query = $this->Activities->find();
        $query
            ->find('basicInformation')
            ->where([
                'start_date BETWEEN :start_date AND :end_date',
                'is_pair' => true,
                'ActivityStatuses.status' => 'Active',
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
            'finder' => 'basicInformation',
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
