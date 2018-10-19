<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Media Entity
 *
 * @property int $owner_id
 * @property int $position
 * @property int $media_type_id
 * @property string $file_path
 * @property \Cake\I18n\FrozenTime $uploaded_at
 * @property string $caption
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\MediaType $media_type
 */
class Media extends Entity
{

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
        'media_type_id' => true,
        'file_path' => true,
        'uploaded_at' => true,
        'caption' => true,
        'user' => true,
        'media_type' => true
    ];
}
