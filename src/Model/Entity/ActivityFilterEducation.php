<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ActivityFilterEducation Entity
 *
 * @property int $filter_id
 * @property int $education_id
 *
 * @property \App\Model\Entity\ActivityFilter $activity_filter
 * @property \App\Model\Entity\Education $education
 */
class ActivityFilterEducation extends Entity
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
        '$filter_id' => true,
        'education_id' => true
    ];
}
