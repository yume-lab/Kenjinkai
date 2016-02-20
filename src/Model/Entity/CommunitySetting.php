<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * CommunitySetting Entity.
 *
 * @property int $id
 * @property int $community_id
 * @property \App\Model\Entity\Community $community
 * @property int $gender
 * @property int $lower_age
 * @property int $upper_age
 * @property string $column_name
 * @property bool $is_deleted
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 */
class CommunitySetting extends Entity
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
