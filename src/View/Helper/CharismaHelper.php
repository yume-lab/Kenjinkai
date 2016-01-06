<?php
namespace App\View\Helper;

use Cake\View\Helper;
/**
 * Class CharismaHelper
 *
 * テンプレートで使用しているCharismaのコンポーネント呼び出しヘルパー.
 *
 * @package App\View\Helper
 */
class CharismaHelper extends Helper {

    /**
     * サイドバーに設置するボタンを出力します.
     * @param string $text ボタン文言
     * @param string $href リンク先
     */
    public function menuButton($text, $href = '#')
    {
        $format = <<<EOF
<a class="btn btn-lg btn-info" href="%s">
    %s
</a>
EOF;
        return sprintf($format, $href, $text);

    }
}
