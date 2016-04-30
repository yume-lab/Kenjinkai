<?php
namespace App\Controller;

use Cake\Core\Configure;

/**
 * Controller TopController
 * TOPページコントローラー
 */
class TopController extends AppController
{
    private static $SHOW_ITEM_COUNT = 4;

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
        $newCommunities = $this->Communities->findLatests(self::$SHOW_ITEM_COUNT);
        $homeCommunities = $this->Communities->search(['hometown_ken_id' => $this->hometown['ken_id']], self::$SHOW_ITEM_COUNT);
        $prefCommunities = $this->Communities->search(['ken_id' => $this->profile['ken_id']], self::$SHOW_ITEM_COUNT);
        // TOP画面のindexページを表示
        $this->set(compact('user', 'informations', 'newCommunities', 'homeCommunities', 'prefCommunities'));
    }

}
