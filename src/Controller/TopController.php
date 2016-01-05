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
        $user = $this->Auth->user();
        if (!parent::isAuthorized($user)) {
            // 未ログインの場合はLPに飛ばす
            return $this->redirect('/landing');
        }

        // TOP画面のindexページを表示
        debug($user);
    }

}
