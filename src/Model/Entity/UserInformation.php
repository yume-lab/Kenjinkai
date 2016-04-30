<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * UserInformation Entity.
 *
 * @property int $id
 * @property int $user_id
 * @property \App\Model\Entity\User $user
 * @property int $information_id
 * @property \App\Model\Entity\Information $information
 * @property string $convert_info
 * @property \Cake\I18n\Time $read_date
 * @property bool $is_deleted
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 */
class UserInformation extends Entity
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

    /**
     * お知らせの置き換え文字処理.
     */
    public function convert() {
        // お知らせマスタ情報
        $info = $this->information;
        $tags = json_decode($this->convert_info, true);

        $title = $info->title;
        $content = $info->content;

        foreach ($tags as $tag => $value) {
            $title = str_replace($tag, $value, $title);
            $content = str_replace($tag, $value, $content);
            $content = str_replace("\r\n", '<br/>', $content);
        }

        $data = [
            'id' => $this->id,
            'title' => $title,
            'content' => $content,
            'is_important' => $info->is_important,
            'read_date' => $this->read_date,
            'created' => $this->created,
        ];
        return $data;
    }
}
