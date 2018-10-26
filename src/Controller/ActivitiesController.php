<?php

namespace App\Controller;

use Cake\ORM\TableRegistry;

/**
 * Activities Controller
 *
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
//        $user_id = $this->Auth->user('id');

        $tableLocator = TableRegistry::getTableLocator();
        $activityFilters = $tableLocator->get('ActivityFilters');


        $query = $this->Activities->find();
        $query
            ->find('basicInformation')
            ->where([
//                'start_date BETWEEN ? AND ?' => ['2019-03-03 05:06:07', '2019-03-05 05:06:07'],
                'is_pair' => true,
                'status' => 'Active',
            ])
            ->order([
                'Activities.start_date' => 'ASC',
                'Activities.id' => 'DESC'
            ])
            ->limit(10);

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
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $activity = $this->Activities->get($id, [
            'contain' => ['Locations', 'ActivityStatuses', 'Users', 'Tags', 'ActivityApplications', 'ActivityItineraries', 'ActivityReviews']
        ]);

        $this->set(['activity' => $activity, '_serialize' => 'activity']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response
     */
    public function add()
    {
        $activity = $this->Activities->newEntity();
        $activity = $this->Activities->patchEntity($activity, $this->request->getData());
        if ($activity = $this->Activities->save($activity)) {
            $this->set(['id' => $activity->id, '_serialize' => 'id']);
            return $this->response(['id' => $activity->id]);
        }
        return $this->response('The activity could not be saved. Please, try again.', 400);
    }

    /**
     * Edit method
     *
     * @param string|null $id Activity id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $activity = $this->Activities->get($id, [
            'contain' => ['Users', 'Tags']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $activity = $this->Activities->patchEntity($activity, $this->request->getData());
            if ($this->Activities->save($activity)) {
                $this->Flash->success(__('The activity has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The activity could not be saved. Please, try again.'));
        }
        $locations = $this->Activities->Locations->find('list', ['limit' => 200]);
        $activityStatuses = $this->Activities->ActivityStatuses->find('list', ['limit' => 200]);
        $users = $this->Activities->Users->find('list', ['limit' => 200]);
        $tags = $this->Activities->Tags->find('list', ['limit' => 200]);
        $this->set(compact('activity', 'locations', 'activityStatuses', 'users', 'tags'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Activity id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $activity = $this->Activities->get($id);
        if ($this->Activities->delete($activity)) {
            $this->Flash->success(__('The activity has been deleted.'));
        } else {
            $this->Flash->error(__('The activity could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
