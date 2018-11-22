<?php

namespace App\Controller;

use Cake\Filesystem\File;
use Cake\Filesystem\Folder;
use Cake\Http\Exception\UnauthorizedException;
use Elastica\Exception\NotFoundException;

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

    public function view($id = null)
    {
        $download = (bool)$this->getRequest()->getQueryParams()['download'] ?? false;
        $file = $this->Files->get($id);
        if (!$file->isViewableBy($this->current_user))
            throw new UnauthorizedException();
        return $this->getResponse()->withFile($file->full_path, [
            'download' => $download,
            'name' => substr($file->name, strpos($file->name, '-') + 1) . '.' . $file->extension
        ]);
    }

    /**
     * @throws \Exception
     */
    public function add()
    {
        $uploadedFile = $this->getRequest()->getUploadedFile('file');
        if (!$uploadedFile)
            throw new \Cake\Http\Exception\BadRequestException();
        $filename = uniqid(time()) . '-' . $uploadedFile->getClientFilename();
        $extension = pathinfo($filename, PATHINFO_EXTENSION);
        $folder = new Folder(Files . $extension . DS, true, 0755);
        $file = new File($folder->path . $filename, true, 0644);

        try {
            if (!$file->write($uploadedFile->getStream()))
                throw new \RuntimeException('Failed to save the file, please try again.');

            $body = [];
            $body['user_id'] = $this->current_user->id;
            $body['server'] = $_SERVER['HTTP_HOST'];
            $body['directory'] = $file->Folder->path;
            $body['name'] = $file->name();
            $body['extension'] = $file->ext();
            $body['size'] = $file->size();
            $this->setRequest($this->getRequest()->withParsedBody($body));

            $this->create();
        } catch (\Exception $e) {
            $file->delete();
            throw $e;
        }
    }

    public function delete($id = null)
    {
        $fileEntity = $this->Files->get($id);
        $file = new File($fileEntity->full_path, false, 0644);

        if (!$file->exists())
            throw new NotFoundException();
        if (!$fileEntity->isDeletableBy($this->current_user))
            throw new UnauthorizedException();
        if (!$file->delete())
            throw new \RuntimeException('Failed to delete the file, please try again.');

        $this->remove($id);
    }
}
