<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * File Entity
 *
 * @property int $id
 * @property int $user_id
 * @property string $url
 * @property string $mime_type
 * @property int $size
 * @property string|null $notes
 * @property \Cake\I18n\FrozenTime $created_at
 * @property \Cake\I18n\FrozenTime|null $deleted_at
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Activity[] $activities
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
        'url' => true,
        'mime_type' => true,
        'size' => true,
        'notes' => true
    ];
}
