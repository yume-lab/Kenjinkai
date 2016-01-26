<?php
namespace Admin\Model\Entity;

use Cake\ORM\Entity;

/**
 * Community Entity.
 *
 * @property int $id
 * @property int $community_status_id
 * @property \App\Model\Entity\CommunityStatus $community_status
 * @property int $country_id
 * @property int $ken_id
 * @property int $city_id
 * @property int $hometown_country_id
 * @property int $hometown_ken_id
 * @property int $hometown_city_id
 * @property string $name
 * @property bool $is_deleted
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 * @property \App\Model\Entity\ReviewCommunity[] $review_communities
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
