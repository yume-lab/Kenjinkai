<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * UserImage Entity.
 *
 * @property int $id
 * @property int $uesr_id
 * @property \App\Model\Entity\Uesr $uesr
 * @property string $hash
 * @property string $name
 * @property string $extension
 * @property bool $is_deleted
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 */
class UserImage extends Entity
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
        '*' => true,
        'id' => false,
    ];
}
