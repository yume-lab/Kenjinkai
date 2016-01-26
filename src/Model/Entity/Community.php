<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Community Entity.
 *
 * @property int $id
 * @property int $community_status_id
 * @property \App\Model\Entity\CommunityStatus $community_status
 * @property int $country_id
 * @property \App\Model\Entity\Country $country
 * @property int $ken_id
 * @property \App\Model\Entity\Ken $ken
 * @property int $city_id
 * @property \App\Model\Entity\City $city
 * @property int $hometown_country_id
 * @property \App\Model\Entity\HometownCountry $hometown_country
 * @property int $hometown_ken_id
 * @property \App\Model\Entity\HometownKen $hometown_ken
 * @property int $hometown_city_id
 * @property \App\Model\Entity\HometownCity $hometown_city
 * @property string $name
 * @property bool $is_deleted
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 */
class Community extends Entity
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