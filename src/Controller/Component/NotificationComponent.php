<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;

/**
 * Notification component
 * お知らせ処理コンポーネント.
 */
class NotificationComponent extends Component
{

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];

    /**
     * TODO: ちゃんとした実装
     * 利用可能な置き換えタグを取得します.
     * @return array 置き換えタグ
     */
    public function tags()
    {
        return [
            [
                'tag' => '[[nickname]]',
                'label' => 'ニックネーム'
            ]
        ];
    }

}
