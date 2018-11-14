<?php

namespace App\Controller;

/**
 * Contacts Controller
 *
 * @property \App\Model\Table\ContactsTable $Contacts
 *
 * @method \App\Model\Entity\Contact[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ContactsController extends AppController
{
    public function index()
    {
        $query = $this->Contacts->find();
        $query
            ->select(['type', 'contacts' => $query->func()->JSON_ARRAYAGG(['contact' => 'identifier'])])
            ->where(['user_id' => $this->current_user->id])
            ->group('type');

        $result = [];
        foreach ($query as $contact) {
            $result[strtolower($contact->type)] = json_decode($contact->contacts, true);
        }
        if ($this->using_api) {
            return $this->setSerialized($result);
        }
        foreach ($result as $type => $contact)
            $this->set($type, $contact);
    }
}
