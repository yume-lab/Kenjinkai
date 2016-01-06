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

    /**
     * コンテンツ内の見出しを出力します.
     * @param string $text 見出しテキスト
     * @param string $baseColor 見出しの背景色
     * @param string $listUrl 一覧URLのリンク先
     * @param string $icon アイコンのパス
     */
    public function contentTitle($text, $baseColor, $listUrl, $icon)
    {
        $format = <<<EOF
<div style="
    background-color: %s;
    display: table;
    width: 100%%;
    color: #fff;
    font-size: 1.3em;
    background-image: url(/images/icon/%s);
    background-repeat: no-repeat;
    background-position: left 10px center;">

    <div style="display: table-cell; padding: 0.7em 2em;">
        %s
    </div>
    <a href="%s" style="display: table-cell;  background: rgba(0,0,0,0.4); color: #fff; width: 8em; text-align: center;">
        %s
    </a>
</div>
EOF;
        return sprintf($format, $baseColor, $icon, $text, $listUrl, __('新着一覧'));
    }
}
