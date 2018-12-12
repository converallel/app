<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ActivityFilter Entity
 *
 * @property int $id
 * @property bool $using_current_location
 * @property int|null $location_id
 * @property int $distance
 * @property string $date_type
 * @property \Cake\I18n\FrozenDate|null $start_date
 * @property \Cake\I18n\FrozenDate|null $end_date
 * @property int $from_age
 * @property int $to_age
 * @property bool $matching_personality
 * @property bool $verified_user
 *
 * @property \App\Model\Entity\Location $location
 */
class ActivityFilter extends Entity
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
        'using_current_location' => true,
        'location_id' => true,
        'distance' => true,
        'date_type' => true,
        'start_date' => true,
        'end_date' => true,
        'from_age' => true,
        'to_age' => true,
        'matching_personality' => true,
        'verified_user' => true,
        'location' => true
    ];
}
