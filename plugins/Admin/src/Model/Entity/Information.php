<?php
namespace Admin\Model\Entity;

use Cake\ORM\Entity;

/**
 * Information Entity.
 *
 * @property int $id
 * @property int $information_type_id
 * @property \App\Model\Entity\InformationType $information_type
 * @property string $path
 * @property string $name
 * @property string $content
 * @property bool $is_deleted
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 * @property string $title
 */
class Information extends Entity
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
