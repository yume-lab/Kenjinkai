<?php

namespace Admin\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\Controller\Component\AuthComponent;

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
            /*
            'loginAction' => [
                'controller' => 'Landing',
                'action' => 'index'
            ],
            'loginRedirect' => [
                'controller' => 'Top',
                'action' => 'index'
            ],
            'logoutRedirect' => [
                'controller' => 'Landing',
                'action' => 'index'
            ],
            */
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
