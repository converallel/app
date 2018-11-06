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

    /**
     * Index method
     *
     * @return \Cake\Http\Response
     */
    public function index()
    {
        $activity_id = $this->getRequest()->getParam('activity_id');
        $query = $this->Reviews->find()
            ->selectAllExcept($this->Reviews, ['activity_id', 'user_id'])
            ->contain(['Users' => ['finder' => 'basicInformation']])
            ->where(['activity_id' => $activity_id])
            ->limit(5);

        $this->paginate = [
            'maxLimit' => 5
        ];
        $reviews = $this->paginate($query);

        return $this->response($reviews);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response
     */
    public function add()
    {
        $data = $this->getRequest()->getData();
        $data['user_id'] = $this->user_id;

        $review = $this->Reviews->newEntity();
        $review = $this->Reviews->patchEntity($review, $this->request->getData());
        if ($this->Reviews->save($review)) {
            return $this->response(['id' => $review->id]);
        }
        return $this->response('The review could not be saved. Please, try again.', 400);
    }

    /**
     * Edit method
     *
     * @param string|null $id Review id.
     * @return \Cake\Http\Response
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $review = $this->Reviews->get($id);
        $review = $this->Reviews->patchEntity($review, $this->request->getData());
        if ($this->Reviews->save($review)) {
            return $this->response(null, 204);
        }
        return $this->response('The review could not be saved. Please, try again.', 400);
    }

    /**
     * Delete method
     *
     * @param string|null $id Review id.
     * @return \Cake\Http\Response
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $review = $this->Reviews->get($id);
        if ($this->Reviews->delete($review)) {
            return $this->response();
        }
        return $this->response('The review could not be deleted. Please, try again.', 400);
    }
}
