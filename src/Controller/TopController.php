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
        $this->loadModel('Communities');
        $this->loadComponent('Notification');
    }

    /**
     * 初期表示Action.
     */
    public function index()
    {
        parent::redirectAuthorized();

        $user = $this->user;
        $informations = $this->Notification->getLatest($user['id']);
        $newCommunities = $this->Communities->findLatests(8);
        // TOP画面のindexページを表示
        $this->set(compact('user', 'informations', 'newCommunities'));
    }

}
