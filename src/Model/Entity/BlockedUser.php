<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * BlockedUser Entity
 *
 * @property int $blocker_id
 * @property int $blocked_id
 *
 * @property \App\Model\Entity\User $user
 */
class BlockedUser extends Entity
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
        'blocker_id' => true,
        'blocked_id' => true
    ];
}
