<?php

namespace Admin\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\Controller\Component\AuthComponent;
use Cake\ORM\TableRegistry;

/**
 * Admin App Controller
 * 管理画面の既定クラス.
 */
class AppController extends Controller
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

        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');
        $this->loadComponent('Auth', [
            'authorize' => ['Controller'],
            'authenticate' => [
                'Form' => [
                    'userModel' => 'Admins',
                    'fields' => [
                        'username' => 'email',
                        'password' => 'password'
                    ]
                ]
            ],
            'loginAction' => [
                'controller' => 'Admins',
                'action' => 'login'
            ],
            'loginRedirect' => [ // TODO: テスト
                'controller' => 'Admins',
                'action' => 'index'
            ],
            'logoutRedirect' => [
                'controller' => 'Admins',
                'action' => 'login'
            ],
            'authError' => __('ログインしてください。')
        ]);
    }

    /**
     * リクエスト毎の処理.
     *
     * @param \Cake\Event\Event $event
     * @return void
     */
    public function beforeFilter(Event $event)
    {
        $this->viewBuilder()->layout('Admin.default');
        $this->Auth->sessionKey = 'Auth.Admin';

        $admin = $this->Auth->user();
        $this->set('admin', $admin);
        parent::beforeFilter($event);
    }

    /**
     * ログイン済判定処理を行います.
     *
     * @see \Cake\Controller\Component\AuthComponent $Auth
     * @param null $user
     * @return bool ログイン済であればtrue
     */
    public function isAuthorized($user = null)
    {
        return !empty($user);
    }

}
