<?php

namespace App\Controller;

use Cake\Filesystem\File;
use Cake\Filesystem\Folder;
use Cake\Http\Exception\UnauthorizedException;
use Symfony\Component\Filesystem\Exception\FileNotFoundException;

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
            ->orderDesc('created_at');
        $this->load($query);
    }

    public function add()
    {
        $body = $this->getRequest()->getData();
        $extension = pathinfo($body['filename'], PATHINFO_EXTENSION);
        $filename = uniqid(time()) . '-' . $body['filename'];
        $folder = new Folder(Files . $extension . DS, true, 0755);
        $file = new File($folder->path . $filename, true, 0644);

        try {
            $error_message = 'Failed to save the file, please try again.';
            if (!$file->write(base64_decode($body['data'])))
                throw new \RuntimeException($error_message);
//            if (!chown($file->path, $this->current_user->id))
//                throw new \RuntimeException($error_message);
        } catch (\RuntimeException $e) {
            $file->delete();
            throw $e;
        }

        $body = [];
        $body['user_id'] = $this->current_user->id;
        $body['server'] = $_SERVER['HTTP_HOST'];
        $body['directory'] = $file->Folder->path;
        $body['name'] = $file->name();
        $body['extension'] = $file->ext();
        $body['size'] = $file->size();
        var_export($body);
        exit;
        $this->setRequest($this->getRequest()->withParsedBody($body));

        $this->create();
    }

    public function delete($id = null)
    {
        $file = $this->Files->get($id);
        $file = new File($file->full_path, false, 0644);

        $owner = $file->owner();
        if (!$owner)
            throw new FileNotFoundException();
        if ($owner !== $this->current_user->id)
            throw new UnauthorizedException();
        if (!$file->delete())
            throw new \RuntimeException('Failed to delete the file, please try again.');

        $this->remove($id);
    }
}
