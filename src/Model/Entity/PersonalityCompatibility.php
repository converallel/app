<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * PersonalityCompatibility Entity
 *
 * @property int $personality_id
 * @property int $matching_id
 * @property int $compatibility_id
 *
 * @property \App\Model\Entity\Personality $personality
 * @property \App\Model\Entity\PersonalityCompatibilityLookup $personality_compatibility_lookup
 */
class PersonalityCompatibility extends Entity
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
        'compatibility_id' => true,
        'personality' => true,
        'personality_compatibility_lookup' => true
    ];
}
