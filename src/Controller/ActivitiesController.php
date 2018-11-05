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

    /**
     * Index method
     *
     * @return \Cake\Http\Response
     */
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

        $this->paginate = [
            'maxLimit' => 10
        ];
        $activities = $this->paginate($query);

        return $this->response($activities);
    }

    /**
     * View method
     *
     * @param string|null $id Activity id.
     * @return \Cake\Http\Response
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $activity = $this->Activities
            ->find('basicInformation')
            ->select(['application_count', 'review_count'])
            ->contain(['ActivityItineraries'])
            ->where(['Activities.id' => $id])
            ->first();

        if ($activity)
            return $this->response($activity);

        return $this->response("Not Found", 404);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response
     */
    public function add()
    {
        $activity = $this->Activities->newEntity();
        $activity = $this->Activities->patchEntity($activity, $this->getRequest()->getData(), [
            'associated' => ['Tags' => ['onlyIds' => true]]
        ]);
        if ($this->Activities->save($activity)) {
            return $this->response(['id' => $activity->id]);
        }
        return $this->response('The activity could not be saved. Please, try again.', 400);
    }

    /**
     * Edit method
     *
     * @param string|null $id Activity id.
     * @return \Cake\Http\Response
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $this->getRequest()->allowMethod('patch');
        $activity = $this->Activities->get($id, [
            'contain' => ['Tags']
        ]);
        $activity = $this->Activities->patchEntity($activity, $this->getRequest()->getData());
        if ($this->Activities->save($activity)) {
            return $this->response(null, 204);
        }
        return $this->response('The activity could not be saved. Please, try again.', 400);
    }

    /**
     * Delete method
     *
     * @param string|null $id Activity id.
     * @return \Cake\Http\Response
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $activity = $this->Activities->get($id);
        if ($this->Activities->delete($activity)) {
            return $this->response();
        }
        return $this->response('The activity could not be deleted. Please, try again.', 400);
    }
}
