<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * SearchHistory Entity
 *
 * @property int $id
 * @property int $user_id
 * @property int $search_type_id
 * @property string $search_string
 * @property \Cake\I18n\FrozenTime $searched_at
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\SearchType $search_type
 */
class SearchHistory extends Entity
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
        'search_type_id' => true,
        'search_string' => true,
    ];
}
