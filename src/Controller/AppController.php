<?php
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\Controller\Component\AuthComponent;
use Cake\ORM\TableRegistry;
use Cake\Utility\Security;

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

    /** @var array 故郷情報 */
    protected $hometown;

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
        if (empty($user)) {
            return;
        }

        $profile = array_shift($user['user_profiles']);
        $hometown = array_shift($user['user_hometowns']);
        $image = array_shift($user['user_images']);
        unset($user['user_profiles']);
        unset($user['user_images']);
        unset($user['user_hometowns']);

        $hasImage = !empty($image);
        $imageUrl = '/images/no_image.png';
        if ($hasImage) {
            $imageUrl = '/images/profile/'.$image['hash'];
        }

        $this->user = $user;
        $this->profile = $profile;
        $this->hometown = $hometown;

        // 右のサイドバーの新着コミュニティ
        $this->loadModel('Communities');
        $latestCommunities = $this->Communities->findLatests(5);

        $this->set(compact('user', 'profile', 'latestCommunities', 'imageUrl'));
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

    /**
     * 指定されたモデルのインスタンスを返します.
     * @param string $name モデル名
     * @return Table 指定されたモデルのインスタンス
     */
    protected function loadTable($name)
    {
        return TableRegistry::get($name);
    }

}
