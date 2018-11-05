<?php

namespace App\Controller;

/**
 * Tags Controller
 *
 * @property \App\Model\Table\TagsTable $Tags
 *
 * @method \App\Model\Entity\Tag[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TagsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response
     */
    public function index()
    {
        $tags = $this->Tags->find()->where(['parent_id' => null])->all();
        return $this->response($tags);
    }

    /**
     * View method
     *
     * @param string|null $id Tag id.
     * @return \Cake\Http\Response
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $tag = $this->Tags->get($id, [
            'contain' => ['ChildTags']
        ]);

        return $this->response($tag);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $tag = $this->Tags->newEntity();
        if ($this->request->is('post')) {
            $tag = $this->Tags->patchEntity($tag, $this->request->getData());
            if ($this->Tags->save($tag)) {
                $this->Flash->success(__('The tag has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The tag could not be saved. Please, try again.'));
        }
        $parentTags = $this->Tags->ParentTags->find('list', ['limit' => 200]);
        $activities = $this->Tags->Activities->find('list', ['limit' => 200]);
        $this->set(compact('tag', 'parentTags', 'activities'));
    }
}
