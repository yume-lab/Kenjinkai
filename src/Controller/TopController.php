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
     * Initialization method.
     * コンポーネントのロードなど.
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Notification');
    }

    /**
     * 初期表示Action.
     */
    public function index()
    {
        parent::redirectAuthorized();

        $user = $this->user;
        $informations = $this->Notification->getUnread($user['id']);
        $news = $this->getNews();
        // TOP画面のindexページを表示
        $this->set(compact('user', 'informations', 'news'));
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
