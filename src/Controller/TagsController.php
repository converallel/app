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
    public function index()
    {
        $query = $this->Tags->find()->where(['parent_id' => null]);
        $this->load($query);
    }

    public function view($id = null)
    {
        $this->get($id, ['contain' => ['ChildTags']]);
    }
}
