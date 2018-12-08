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
            ->where(['user_id' => $this->current_user->id])
            ->orderDesc('created_at')
            ->formatResults(function (\Cake\Collection\CollectionInterface $results) {
                return $results->map(function ($row) {
                    return [
                        'id' => $row->id,
                        'url' => $row->url,
                        'size' => $row->size,
                        'created_at' => $row->created_at
                    ];
                });
            });
        $this->load($query);
    }

    public function add()
    {
        $this->addMany();
    }
}
