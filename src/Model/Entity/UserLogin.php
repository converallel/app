<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * UserLogin Entity
 *
 * @property int $account_id
 * @property int $device_id
 * @property \Cake\I18n\FrozenTime $logged_in_at
 * @property float $latitude
 * @property float $longitude
 *
 * @property \App\Model\Entity\Device $device
 */
class UserLogin extends Entity
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
        'device_id' => true,
        'logged_in_at' => true,
        'latitude' => true,
        'longitude' => true,
        'device' => true
    ];
}
