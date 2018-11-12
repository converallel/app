<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ActivityItinerary Entity
 *
 * @property int $id
 * @property int $activity_id
 * @property int $stop
 * @property int $location_id
 * @property \Cake\I18n\FrozenTime $arrive_at
 * @property \Cake\I18n\FrozenTime $depart_at
 * @property int $transportation_id
 *
 * @property \App\Model\Entity\Activity $activity
 * @property \App\Model\Entity\Location $location
 * @property \App\Model\Entity\Transportation $transportation
 */
class ActivityItinerary extends Entity
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
        'stop' => true,
        'location_id' => true,
        'arrive_at' => true,
        'depart_at' => true,
        'transportation_id' => true,
    ];
}
