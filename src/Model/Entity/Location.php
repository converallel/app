<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Location Entity
 *
 * @property int $id
 * @property float $latitude
 * @property float $longitude
 * @property string $name
 * @property string $iso_country_code
 * @property string $country
 * @property string $postal_code
 * @property string $administrative_area
 * @property string $sub_administrative_area
 * @property string $locality
 * @property string $sub_locality
 * @property string $thoroughfare
 * @property string $sub_thoroughfare
 * @property string $time_zone
 *
 * @property \App\Model\Entity\Activity[] $activities
 * @property \App\Model\Entity\ActivityFilter[] $activity_filters
 * @property \App\Model\Entity\ActivityItinerary[] $activity_itineraries
 * @property \App\Model\Entity\LocationSelectionHistory[] $location_selection_histories
 * @property \App\Model\Entity\User[] $users
 */
class Location extends Entity
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
        'latitude' => true,
        'longitude' => true,
        'name' => true,
        'iso_country_code' => true,
        'country' => true,
        'postal_code' => true,
        'administrative_area' => true,
        'sub_administrative_area' => true,
        'locality' => true,
        'sub_locality' => true,
        'thoroughfare' => true,
        'sub_thoroughfare' => true,
        'time_zone' => true,
    ];
}
