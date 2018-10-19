<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * User Entity
 *
 * @property int $id
 * @property string $given_name
 * @property string $family_name
 * @property \Cake\I18n\FrozenDate $birthdate
 * @property bool $gender
 * @property bool $sexual_orientation
 * @property int $location_id
 * @property string $profile_image_path
 * @property int $personality_id
 * @property int $education_id
 * @property string $bio
 * @property int $rating
 * @property bool $verified
 *
 * @property \App\Model\Entity\Location $location
 * @property \App\Model\Entity\Personality $personality
 * @property \App\Model\Entity\Education $education
 * @property \App\Model\Entity\ActivityFilter[] $activity_filters
 * @property \App\Model\Entity\FilterEducation[] $filter_education
 * @property \App\Model\Entity\FollowingTag[] $following_tags
 * @property \App\Model\Entity\InterestedActivity[] $interested_activities
 * @property \App\Model\Entity\LocationSelectionHistory[] $location_selection_histories
 * @property \App\Model\Entity\Participation[] $participation
 * @property \App\Model\Entity\SearchHistory[] $search_histories
 * @property \App\Model\Entity\UserDevice[] $user_devices
 */
class User extends Entity
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
        'given_name' => true,
        'family_name' => true,
        'birthdate' => true,
        'gender' => true,
        'sexual_orientation' => true,
        'location_id' => true,
        'profile_image_path' => true,
        'personality_id' => true,
        'education_id' => true,
        'bio' => true,
        'rating' => true,
        'verified' => true,
        'location' => true,
        'personality' => true,
        'education' => true,
        'activity_filters' => true,
        'filter_education' => true,
        'following_tags' => true,
        'interested_activities' => true,
        'location_selection_histories' => true,
        'participation' => true,
        'search_histories' => true,
        'user_devices' => true
    ];
}
