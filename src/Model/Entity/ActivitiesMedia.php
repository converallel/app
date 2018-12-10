<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ActivitiesMedia Entity
 *
 * @property int $activity_id
 * @property int $media_id
 *
 * @property \App\Model\Entity\Activity $activity
 * @property \App\Model\Entity\Media $media
 */
class ActivitiesMedia extends Entity
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
        'media_id' => true
    ];
}
