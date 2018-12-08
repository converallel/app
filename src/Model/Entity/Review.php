<?php

namespace App\Model\Entity;

use Cake\Http\Exception\BadRequestException;
use Cake\ORM\Entity;
use Cake\ORM\TableRegistry;

/**
 * Review Entity
 *
 * @property int $id
 * @property int $activity_id
 * @property int $user_id
 * @property int $rating
 * @property string $message
 * @property \Cake\I18n\FrozenTime $created_at
 * @property \Cake\I18n\FrozenTime $modified_at
 * @property \Cake\I18n\FrozenTime|null $deleted_at
 * @property int $helpful
 * @property int $not_helpful
 *
 * @property \App\Model\Entity\Activity $activity
 * @property \App\Model\Entity\User $user
 */
class Review extends Entity
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
        'activity_id' => true,
        'user_id' => true,
        'rating' => true,
        'message' => true,
        'helpful' => true,
        'not_helpful' => true,
    ];

    public function isCreatableBy($user)
    {
        $activity = TableRegistry::getTableLocator()->get('Activities')->get($this->activity_id, [
            'fields' => 'start_date',
            'contain' => ['Participants', 'Reviews']
        ]);
        if ($activity->start_date->timestamp > time()) {
            throw new BadRequestException("This activity can't be reviewed now.");
        }
        foreach ($activity->reviews as $review) {
            if ($review->user_id === $user->id) {
                throw new BadRequestException('You have reviewed this activity.');
            }
        }
        foreach ($activity->participants as $participant) {
            if ($participant->id === $user->id) {
                return true;
            }
        }
        return false;
    }
}
