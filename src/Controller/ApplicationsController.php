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

    /**
     * Index method
     *
     * @return \Cake\Http\Response
     */
    public function index()
    {
        $activity_id = $this->getRequest()->getParam('activity_id');
        $query = $this->Applications
            ->find()
            ->selectAllExcept($this->Applications, ['activity_id', 'user_id'])
            ->contain(['Users' => ['finder' => 'basicInformation']])
            ->where(['activity_id' => $activity_id])
            ->limit(2);

        $this->paginate = [
            'maxLimit' => 2
        ];
        $applications = $this->paginate($query);

        return $this->response($applications);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response
     */
    public function add()
    {
        $activity_id = $this->getRequest()->getParam('activity_id');
        $data = $this->getRequest()->getData();
        $data['user_id'] = $this->user_id;
        $data['activity_id'] = $activity_id;

        $application = $this->Applications->newEntity();
        $application = $this->Applications->patchEntity($application, $data);
        if ($this->Applications->save($application)) {
            return $this->response(['id' => $application->id]);
        }
        return $this->response('The application could not be saved. Please, try again.', 400);
    }

    /**
     * Edit method
     *
     * @param string|null $id Application id.
     * @return \Cake\Http\Response
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $application = $this->Applications->get($id);
        $application = $this->Applications->patchEntity($application, $this->getRequest()->getData());
        if ($this->Applications->save($application)) {
            return $this->response(null, 204);
        }
        return $this->response('The application could not be saved. Please, try again.', 400);
    }

    /**
     * Delete method
     *
     * @param string|null $id Application id.
     * @return \Cake\Http\Response
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $application = $this->Applications->get($id);
        if ($this->Applications->delete($application)) {
            return $this->response();
        }
        return $this->response('The application could not be deleted. Please, try again.', 400);
    }
}
