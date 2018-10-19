<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ActivityApplication Entity
 *
 * @property int $activity_id
 * @property int $applicant_id
 * @property string $message
 * @property bool $status
 * @property \Cake\I18n\FrozenTime $applied_at
 * @property \Cake\I18n\FrozenTime $modified_at
 *
 * @property \App\Model\Entity\Activity $activity
 * @property \App\Model\Entity\User $user
 */
class ActivityApplication extends Entity
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
        'message' => true,
        'status' => true,
        'applied_at' => true,
        'modified_at' => true,
        'activity' => true,
        'user' => true
    ];
}
