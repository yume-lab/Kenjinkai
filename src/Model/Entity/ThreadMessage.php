<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ThreadMessage Entity.
 *
 * @property int $id
 * @property int $thread_id
 * @property \App\Model\Entity\Thread $thread
 * @property int $user_id
 * @property \App\Model\Entity\User $user
 * @property int $sequence
 * @property int $parent_sequence
 * @property string $content
 * @property string $ip_address
 * @property string $user_agent
 * @property \Cake\I18n\Time $posted
 * @property bool $is_deleted
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 */
class ThreadMessage extends Entity
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
