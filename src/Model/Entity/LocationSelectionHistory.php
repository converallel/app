<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * LocationSelectionHistory Entity
 *
 * @property int $id
 * @property int $user_id
 * @property int $location_id
 * @property \Cake\I18n\FrozenTime $selected_at
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Location $location
 */
class LocationSelectionHistory extends Entity
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
        'user_id' => true,
        'location_id' => true,
    ];
}
