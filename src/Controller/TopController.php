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

        // TOP画面のindexページを表示
        $this->set('user', $this->user);
    }

}
