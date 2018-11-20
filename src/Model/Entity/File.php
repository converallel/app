<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * File Entity
 *
 * @property int $id
 * @property int $user_id
 * @property string $server
 * @property string $directory
 * @property string $name
 * @property string $extension
 * @property int $size
 * @property \Cake\I18n\FrozenTime $created_at
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Media[] $media
 */
class File extends Entity
{
    use AuthorizationTrait;

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'user_id' => true,
        'server' => true,
        'directory' => true,
        'name' => true,
        'extension' => true,
        'size' => true
    ];

    protected function _getFullPath()
    {
        return $this->directory . DS . $this->name . '.' . $this->extension;
    }

    protected function _getUrl()
    {
        return 'http://' . $this->server . $this->_getFullPath();
    }
}
