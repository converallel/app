<?php

namespace App\Controller;

/**
 * Files Controller
 *
 * @property \App\Model\Table\FilesTable $Files
 *
 * @method \App\Model\Entity\File[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class FilesController extends AppController
{

    public function index()
    {
        $query = $this->Files->find()
            ->select(['id,', 'url', 'size', 'notes', 'created_at'])
            ->where(['user_id' => $this->current_user->id])
            ->orderDesc('created_at');
        $this->load($query);
    }

    public function add()
    {
        $this->addMany();
    }
}
