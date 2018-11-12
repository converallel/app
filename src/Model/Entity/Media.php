<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Media Entity
 *
 * @property int $id
 * @property int $user_id
 * @property int $file_id
 * @property string $type
 * @property int $position
 * @property string $caption
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\File $file
 */
class Media extends Entity
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
        'file_id' => true,
        'type' => true,
        'position' => true,
        'caption' => true
    ];
}
