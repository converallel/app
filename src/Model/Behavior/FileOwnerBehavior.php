<?php

namespace App\Model\Behavior;

use App\Model\Entity\File;
use Cake\Datasource\EntityInterface;
use Cake\Event\Event;
use Cake\ORM\Behavior;
use Cake\Utility\Hash;

/**
 * FileOwner behavior
 */
class FileOwnerBehavior extends Behavior
{

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = ['field' => 'Files'];

    public function addContainFiles($options)
    {
        $options['contain'] = array_merge($options['contain'] ?? [], [$this->getConfig('field')]);
        return $options;
    }

    /**
     * @param Event $event
     * @param EntityInterface $entity
     * @param \ArrayObject $options
     * @throws \Exception
     */
    public function beforeDelete(Event $event, EntityInterface $entity, \ArrayObject $options)
    {
        $field = strtolower($this->getConfig('field'));
        $files = Hash::get($entity, $field);
        if (!is_array($files) || (!empty($files) && !$files[0] instanceof File))
            throw new \Exception("Cannot delete $field");

        foreach ($files as $file) {
            if (startsWith(mime_content_type($file->full_path), 'image')) {
                $folder = new \Cake\Filesystem\Folder($file->full_directory);
                $folder->delete();
                continue;
            }
            $file = new \Cake\Filesystem\File($file->full_path);
            $file->delete();
        }
    }
}
