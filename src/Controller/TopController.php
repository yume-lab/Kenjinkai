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
        // TODO: ログイン後のTOPページテンプレートを用意する
        return $this->redirect('/landing');
    }

}
