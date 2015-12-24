<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * UserHometown Entity.
 *
 * @property int $id
 * @property int $user_id
 * @property \App\Model\Entity\User $user
 * @property int $country_id
 * @property \App\Model\Entity\Country $country
 * @property int $prefectures_id
 * @property \App\Model\Entity\Prefecture $prefecture
 * @property int $city_id
 * @property \App\Model\Entity\City $city
 * @property string $memories
 * @property bool $is_deleted
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 */
class UserHometown extends Entity
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
