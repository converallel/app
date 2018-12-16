<?php

namespace App\Controller;

/**
 * ActivityFilters Controller
 *
 * @property \App\Model\Table\ActivityFiltersTable $ActivityFilters
 *
 * @method \App\Model\Entity\ActivityFilter[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ActivityFiltersController extends AppController
{

    public function view($id = null)
    {
        $this->get($id ?? $this->current_user->id, ['contain' => 'Locations']);
    }
}
