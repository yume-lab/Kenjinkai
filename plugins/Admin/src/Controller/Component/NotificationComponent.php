<?php
namespace Admin\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;

/**
 * Notification component
 * お知らせコンポーネント
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
     * 置き換え可能なタグの定義です.
     * @var array
     */
    private $__convertInfo = [
        [
            'tag' => '[[nickname]]',
            'value' => 'ニックネーム'
        ]
    ];


    /**
     * 置き換え可能なタグの配列を返却します.
     *
     * @return array タグ情報
     */
    public function usableConvert()
    {
        return $this->__convertInfo;
    }

}
