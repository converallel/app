<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Review Entity
 *
 * @property int $id
 * @property int $activity_id
 * @property int $reviewer_id
 * @property int $rating
 * @property string $message
 * @property \Cake\I18n\FrozenTime $reviewed_at
 * @property \Cake\I18n\FrozenTime $modified_at
 * @property int $helpful
 * @property int $not_helpful
 *
 * @property \App\Model\Entity\Activity $activity
 * @property \App\Model\Entity\User $user
 */
class Review extends Entity
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
        'activity_id' => true,
        'reviewer_id' => true,
        'rating' => true,
        'message' => true,
        'helpful' => true,
        'not_helpful' => true,
    ];
}
