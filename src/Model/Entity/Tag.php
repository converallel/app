<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Tag Entity
 *
 * @property int $tag_id
 * @property int $parent_id
 * @property string $tag
 * @property int $count
 *
 * @property \App\Model\Entity\ParentTag $parent_tag
 * @property \App\Model\Entity\ChildTag[] $child_tags
 * @property \App\Model\Entity\Activity[] $activities
 */
class Tag extends Entity
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
        'parent_id' => true,
        'tag' => true,
        'count' => true,
        'parent_tag' => true,
        'child_tags' => true,
        'activities' => true
    ];
}
