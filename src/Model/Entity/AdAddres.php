<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * AdAddres Entity.
 *
 * @property int $id
 * @property int $ken_id
 * @property \App\Model\Entity\Ken $ken
 * @property int $city_id
 * @property \App\Model\Entity\City $city
 * @property int $town_id
 * @property \App\Model\Entity\Town $town
 * @property string $zip
 * @property bool $office_flg
 * @property bool $delete_flg
 * @property string $ken_name
 * @property string $ken_furi
 * @property string $city_name
 * @property string $city_furi
 * @property string $town_name
 * @property string $town_furi
 * @property string $town_memo
 * @property string $kyoto_street
 * @property string $block_name
 * @property string $block_furi
 * @property string $memo
 * @property string $office_name
 * @property string $office_furi
 * @property string $office_address
 * @property int $new_id
 * @property \App\Model\Entity\News $news
 */
class AdAddres extends Entity
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
