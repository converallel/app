<?php

namespace App\Controller;

use Cake\Http\Exception\ForbiddenException;
use Cake\Http\Response;

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
                    return ['id' => $row->id, 'url' => $row->url, 'size' => $row->size, 'created_at' => $row->created_at];
                });
            });
        $this->load($query);
    }

    public function delete($id = null)
    {
        $file = $this->Files->get($id);
        if (!$file->isDeletableBy($this->current_user))
            throw new ForbiddenException();

        $accessToken = '123';
        $headers = array_intersect_key($this->getRequest()->getHeaders(), array_flip([
            'X-Csrf-Token', 'Cookie', 'Connection'
        ]));
        $headers['Authorization'] = 'Bearer ' . $accessToken;
        $http = new \Cake\Http\Client();
        $response = $http->delete($file->url, [], ['headers' => $headers]);
        if (!$response->isOk()) {
            $headers = $response->getHeaders();
            unset($headers['Host'], $headers['Date'], $headers['Connection'], $headers['X-Powered-By']);
            foreach ($headers as $key => $value)
                $response = $response->withHeader($key, $value);
            return new Response(['body' => $response->getBody()]);
        }

        $this->remove($id);
    }
}
