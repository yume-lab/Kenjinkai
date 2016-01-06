<?php
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\Controller\Component\AuthComponent;

/**
 * Application Controller
 *
 * 全コントローラーの既定クラス.
 */
class AppController extends Controller
{
    /**
     * 使用ヘルパー
     * @var array
     */
    public $helpers = ['Charisma'];

    /** @var array ユーザー情報 */
    protected $user;

    /** @var array プロフィール情報 */
    protected $profile;

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
                    'userModel' => 'Users',
                    'fields' => [
                        'username' => 'email',
                        'password' => 'password'
                    ]
                ]
            ],
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

        // セッション内のユーザー情報をバラしてフィールドに設定する.
        // セッション操作をここだけにする
        $user = $this->Auth->user();
        $profile = $user['user_profile'];
        unset($user['user_profile']);

        $this->user = $user;
        $this->profile = $profile;

        $this->set(compact('user', 'profile'));
    }

    /**
     * レンダリング直前処理.
     *
     * @param \Cake\Event\Event $event The beforeRender event.
     * @return void
     */
    public function beforeRender(Event $event)
    {
        if (!array_key_exists('_serialize', $this->viewVars) &&
            in_array($this->response->type(), ['application/json', 'application/xml'])
        ) {
            $this->set('_serialize', true);
        }
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

    /**
     * 認証判定を行い、状態に合わせたリダイレクトを行います.
     *
     * @param string $redirectTo 認証済であった場合にリダイレクトさせたいURL
     *  リダイレクトさせずに普通にレンダリングするのであれば空のまま
     */
    protected function redirectAuthorized($redirectTo = '')
    {
        $user = $this->Auth->user();
        if (!$this->isAuthorized($user)) {
            // 未ログインの場合はLPに飛ばす
            return $this->redirect('/landing');
        }

        if (empty($redirectTo)) {
            return;
        }
        return $this->redirect($redirectTo);
    }
}
