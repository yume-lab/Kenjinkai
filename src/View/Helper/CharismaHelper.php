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
     * サイドバーに設置するボタンを出力します.
     * @param string $text ボタン文言
     * @param string $href リンク先
     */
    public function returnButton($text, $href = '#')
    {
        $format = <<<EOF
<div class="center col-md-10" style="margin: 1em;">
    <a class="btn btn-lg btn-primary" href="%s">%s</a>
</div>
EOF;
        return sprintf($format, $href, $text);
    }

    /**
     * コンテンツ内の見出しを出力します.
     * @param string $text 見出しテキスト
     * @param string $baseColor 見出しの背景色
     * @param string $icon アイコンのパス
     * @param string $options 他の追加情報
     *      list string 一覧のURL
     *      glyphs array bootstrapのアイコンとそれのリンク先
     *          ex. [
     *              'icon' => 'glyphicon-star',
     *              'href' => '/hogehoge/favorite'
     *          ]
     */
    public function contentTitle($text, $baseColor, $icon, $options = [])
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
    %s
</div>
EOF;
        $additionTag = '';
        if (isset($options['list'])) {
            $additionTag .= sprintf('
<a href="%s" style="display: table-cell; background: rgba(0,0,0,0.4); color: #fff; width: 4.5em; text-align: center;">
    %s
</a>', $options['list'], __('一覧'));
        }

        if (isset($options['glyphs'])) {
            $additionTag .= sprintf('
                <a href="%s" style="color: #fff;">
                    <span class="glyphicon %s"></span>
                </a>'
            , $options['glyphs']['href'], $options['glyphs']['icon']);
        }


        return sprintf($format, $baseColor, $icon, $text, $additionTag);
    }
}
