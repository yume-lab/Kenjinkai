<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * UserInformations Controller
 * お知らせ一覧コントローラー
 *
 * @property \App\Model\Table\UserInformationsTable $UserInformations
 */
class UserInformationsController extends AppController
{

    /**
     * Initialization method.
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Notification');
    }

    /**
     * 一覧を表示します.
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = ['limit' => 10]; // TODO: configに
        $informations = $this->paginate($this->UserInformations->findByUserId($this->user['id']));
        $this->set(compact('informations'));
    }

}
