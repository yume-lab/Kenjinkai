<?php
namespace App\Controller;

use Cake\Core\Configure;

/**
 * Controller TopController
 * TOPページコントローラー
 */
class TopController extends AppController
{

    /**
     * 初期表示Action.
     */
    public function index()
    {
        parent::redirectAuthorized();

        $user = $this->user;
        $informations = $this->getInformations();
        $news = $this->getNews();

        // TOP画面のindexページを表示
        $this->set(compact('user', 'informations', 'news'));
    }

    /**
     * TODO: スタブ
     * 運営からのお知らせを取得します.
     *
     * @return array お知らせ情報
     */
    private function getInformations()
    {
        $informations = [];

        $informations = [
            [
                'date' => '20160106',
                'title' => 'お知らせサンプル'
            ],
            [
                'date' => '20160106',
                'title' => 'お知らせサンプル'
            ],
            [
                'date' => '20160106',
                'title' => 'お知らせサンプル'
            ],
        ];

        return $informations;
    }

    /**
     * TODO: スタブ
     * 新着情報を取得します.
     *
     * @return array 新着情報
     */
    private function getNews()
    {
        $news = [];

        $news = [
            [
                'date' => '20160106',
                'title' => 'ニュースサンプル'
            ],
            [
                'date' => '20160106',
                'title' => 'ニュースサンプル'
            ],
            [
                'date' => '20160106',
                'title' => 'ニュースサンプル'
            ],
        ];

        return $news;
    }
}
