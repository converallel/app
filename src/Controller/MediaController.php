<?php

namespace App\Controller;

use Cake\Http\Exception\ForbiddenException;
use Cake\ORM\Query;

/**
 * Media Controller
 *
 * @property \App\Model\Table\MediaTable $Media
 *
 * @method \App\Model\Entity\Media[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class MediaController extends AppController
{

    public function index()
    {
        $user_id = $this->getRequest()->getParam('user_id');
        $type = $this->getRequest()->getQueryParams()['type'] ?? null;
        $query = $this->Media->find()
            ->contain([
                'Files' => function (Query $query) use ($user_id) {
                    return $query->where(['Files.user_id' => $user_id]);
                }
            ])
            ->orderAsc('position')
            ->formatResults(function (\Cake\Collection\CollectionInterface $results) {
                return $results->map(function ($row) {
                    $row['url'] = $row->file->url;
                    unset($row['file']);
                    return $row;
                });
            });
        if ($type) {
            $query->where(['type' => $type]);
        }
        $this->load($query);
    }

    public function view($id = null)
    {
        $user_id = $this->getRequest()->getParam('user_id');
        $query = $this->Media->find()
            ->contain([
                'Files' => function (Query $query) use ($user_id) {
                    return $query->where(['Files.user_id' => $user_id]);
                }
            ])
            ->formatResults(function (\Cake\Collection\CollectionInterface $results) {
                return $results->map(function ($row) {
                    $row['url'] = $row->file->url;
                    unset($row['file']);
                    return $row;
                });
            });

        $this->get($id, $query);
    }

    public function add()
    {
        $position = $this->getRequest()->getData('position');
        $this->Media->newEntities();
//        if ()
    }

    public function delete($id = null)
    {
        $media = $this->Media->get($id, ['contain' => 'Files']);

        $file = new File($media->file->full_path);

        $owner = $file->owner();
        if (!$owner) {
            throw new FileNotFoundException();
        }
        if ($owner !== $this->current_user->id) {
            throw new ForbiddenException();
        }
        if (!$file->delete()) {
            throw new \RuntimeException('Failed to delete the file, please try again.');
        }

        $this->remove($id);
    }
}
