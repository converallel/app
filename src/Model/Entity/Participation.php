<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Participation Entity
 *
 * @property int $activity_id
 * @property int $user_id
 * @property \Cake\I18n\FrozenTime $joined_at
 *
 * @property \App\Model\Entity\Activity $activity
 * @property \App\Model\Entity\User $user
 */
class Participation extends Entity
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
        'joined_at' => true,
        'activity' => true,
        'user' => true
    ];
}
