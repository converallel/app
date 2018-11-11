<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Activity Entity
 *
 * @property int $id
 * @property string $title
 * @property \Cake\I18n\FrozenTime $start_date
 * @property \Cake\I18n\FrozenTime $end_date
 * @property int $location_id
 * @property string $customized_location
 * @property int $organizer_id
 * @property bool $is_pair
 * @property bool $exclusive
 * @property string $location_visibility
 * @property string $details
 * @property string $status
 * @property int $group_size_limit
 * @property int $application_count
 * @property int $organizer_count
 * @property int $participant_count
 * @property int $review_count
 * @property \Cake\I18n\FrozenTime $created_at
 * @property \Cake\I18n\FrozenTime $modified_at
 *
 * @property \App\Model\Entity\Location $location
 * @property \App\Model\Entity\User[] $users
 * @property \App\Model\Entity\ActivityItinerary[] $activity_itineraries
 * @property \App\Model\Entity\Application[] $applications
 * @property \App\Model\Entity\Review[] $reviews
 * @property \App\Model\Entity\Tag[] $tags
 */
class Activity extends Entity
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
        'title' => true,
        'start_date' => true,
        'end_date' => true,
        'location_id' => true,
        'customized_location' => true,
        'organizer_id' => true,
        'is_pair' => true,
        'exclusive' => true,
        'location_visibility' => true,
        'details' => true,
        'status' => true,
        'group_size_limit' => true,
        'application_count' => true,
        'organizer_count' => true,
        'participant_count' => true,
        'review_count' => true,
        'created_at' => true,
        'modified_at' => true,
        'location' => true,
        'users' => true,
        'activity_itineraries' => true,
        'applications' => true,
        'reviews' => true,
        'tags' => true
    ];
}
