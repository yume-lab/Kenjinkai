<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * CityAddres Entity.
 *
 * @property int $id
 * @property int $ken_id
 * @property \App\Model\Entity\Ken $ken
 * @property int $city_id
 * @property \App\Model\Entity\City $city
 * @property string $ken_name
 * @property string $ken_furi
 * @property string $city_name
 * @property string $city_furi
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 */
class CityAddres extends Entity
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

    public function getFullName() {
        return $this->ken_name.' '.$this->city_name;
    }
}
