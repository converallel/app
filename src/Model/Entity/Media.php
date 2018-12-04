<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Media Entity
 *
 * @property int $id
 * @property int $file_id
 * @property string $type
 * @property int $position
 * @property string|null $caption
 *
 * @property \App\Model\Entity\File $file
 * @property \App\Model\Entity\Activity[] $activities
 */
class Media extends Entity
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
        'file_id' => true,
        'type' => true,
        'position' => true,
        'caption' => true
    ];

    public function isViewableBy(User $user)
    {
        return $this->file->isViewableBy($user);
    }

    public function isCreatableBy($user)
    {
        return $this->file->isCreatableBy($user);
    }

    public function isEditableBy(User $user)
    {
        return $this->file->isEditableBy($user);
    }

    public function isDeletableBy(User $user)
    {
        return $this->file->isDeletableBy($user);
    }
}
