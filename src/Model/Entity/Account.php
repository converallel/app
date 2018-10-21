<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Account Entity
 *
 * @property int $id
 * @property string $email
 * @property string $phone_number
 * @property string $password
 * @property int $failed_login_attempts
 * @property \Cake\I18n\FrozenTime $created_at
 *
 * @property \App\Model\Entity\UserLogin[] $user_logins
 */
class Account extends Entity
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
        'email' => true,
        'phone_number' => true,
        'password' => true,
        'failed_login_attempts' => true,
        'created_at' => true,
        'user_logins' => true
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password'
    ];
}
