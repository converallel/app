<?php

namespace App\Controller;

/**
 * Reviews Controller
 *
 * @property \App\Model\Table\ReviewsTable $Reviews
 *
 * @method \App\Model\Entity\Review[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ReviewsController extends AppController
{
    public function index()
    {
        $activity_id = $this->getRequest()->getParam('activity_id');
        $query = $this->Reviews->find()
            ->selectAllExcept($this->Reviews, ['activity_id', 'user_id'])
            ->contain(['Users' => ['finder' => 'basicInfo']])
            ->where(['activity_id' => $activity_id])
            ->limit(5);

        $options = ['pagination' => ['maxLimit' => 5]];
        $this->load($query, $options);
    }
}
