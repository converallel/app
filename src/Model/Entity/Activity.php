<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Activity Entity
 *
 * @property int $id
 * @property string $title
 * @property \Cake\I18n\FrozenTime $start_date
 * @property \Cake\I18n\FrozenTime|null $end_date
 * @property int $location_id
 * @property string|null $customized_location
 * @property int $admin_id
 * @property bool $is_pair
 * @property bool $exclusive
 * @property string $location_visibility
 * @property string|null $details
 * @property string $status
 * @property int|null $group_size_limit
 * @property int $application_count
 * @property int $organizer_count
 * @property int $participant_count
 * @property int $review_count
 * @property \Cake\I18n\FrozenTime $created_at
 * @property \Cake\I18n\FrozenTime $modified_at
 * @property \Cake\I18n\FrozenTime|null $deleted_at
 *
 * @property \App\Model\Entity\Location $location
 * @property \App\Model\Entity\User[] $users
 * @property \App\Model\Entity\ActivityItinerary[] $activity_itineraries
 * @property \App\Model\Entity\Application[] $applications
 * @property \App\Model\Entity\Review[] $reviews
 * @property \App\Model\Entity\File[] $files
 * @property \App\Model\Entity\Tag[] $tags
 */
class Activity extends Entity
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
        'title' => true,
        'start_date' => true,
        'end_date' => true,
        'location_id' => true,
        'customized_location' => true,
        'admin_id' => true,
        'is_pair' => true,
        'exclusive' => true,
        'location_visibility' => true,
        'details' => true,
        'status' => true,
        'group_size_limit' => true,
        'location' => true,
        'users' => true,
        'activity_itineraries' => true,
        'media' => true,
        'tags' => true
    ];

    protected $_hidden = ['deleted_at'];

    public function isViewableBy(User $user)
    {
        if (!$user->verified) {
            return !$this->admin->verified;
        }

        return true;
    }

    public function isCreatableBy(User $user)
    {
        return $this->admin_id === $user->id && !is_null($user->profile_image_id);
    }

    public function isEditableBy(User $user)
    {
        if ($this->admin->id === $user->id) {
            return true;
        }

        $organizer_ids = array_map(function ($admin) {
            return $admin->id;
        }, $this->organizers);
        return in_array($user->id, $organizer_ids);
    }

    public function isDeletableBy(User $user)
    {
        return $this->admin_id === $user->id;
    }
}