<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Core\Configure;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 * @property \App\Model\Table\PreRegistrationsTable $PreRegistrations
 * @property \App\Model\Table\UserProfilesTable $UserProfiles
 * @property \App\Model\Table\UserHometownsTable $UserHometowns
 * @property \App\Model\Table\UserHobbiesTable $UserHobbies
 * @property \App\Model\Table\CityAddressTable $CityAddress
 */
class UsersController extends AppController
{
    /**
     * テーブル操作オプション
     */
    private $options = [
        'associated' => [
            'UserProfiles',
            'UserHometowns',
            'UserHobbies'
        ]
    ];

    /**
     * 初期処理.
     * @return void
     */
    public function initialize() {
        parent::initialize();
        $this->Auth->allow(['login', 'register']);

        $this->loadModel('PreRegistrations');
        $this->loadModel('UserProfiles');
        $this->loadModel('UserHometowns');
        $this->loadModel('UserHobbies');
        $this->loadModel('CityAddress');
    }

    /**
     * ユーザー登録処理を行います.
     * @param string $hash 仮登録時のキー
     */
    public function register($hash)
    {
        $this->viewBuilder()->layout('unregistered');

        $data = $this->PreRegistrations->findByHash($hash);

        // 新規エンティティ作成時は一時的にバリデーションを無効にする
        $user = $this->Users->newEntity(['email' => $data->email]);
        if ($this->request->is(['post'])) {
            $data = $this->request->data;
            $this->log($data);
            $user = $this->Users->add($user, $this->request->data);
            $this->log($user);
            $userId = $user->id;

            $this->UserProfiles->add($userId, $data['user_profile']);
            $this->UserHometowns->add($userId, $data['user_hometown']);
            $this->UserHobbies->add($userId, $data['user_hobbies']);

            $this->setUserInfo($userId);
            return $this->render('finished');
        }
        $prefectures = $this->CityAddress->getOptions();

        $genders = Configure::read('Define.genders');

        $this->set(compact('user', 'prefectures', 'genders'));
        $this->set('_serialize', ['user']);
    }

    /**
     * ログイン画面.
     */
    public function login()
    {
        $this->viewBuilder()->layout('unregistered');
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            $this->log($user);
            if ($user) {
                $this->setUserInfo($user['id']);
                return $this->redirect($this->Auth->redirectUrl());
            } else {
                $this->Flash->error(__('メールアドレス、またはパスワードが正しくありません。'));
            }
        }
    }

    /**
     * ログアウト処理を行います.
     */
    public function logout()
    {
        return $this->redirect($this->Auth->logout());
    }

    /**
     * ユーザーIDからユーザー情報をセッションに設定します.
     * @param int $userId ユーザーID
     * @return void
     */
    private function setUserInfo($userId)
    {
        $user = $this->Users->get($userId, [
            'contain' => [
                'UserProfiles',
                'UserHometowns',
                'UserImages' => function ($q) {
                    return $q->where(['UserImages.is_deleted' => false]);
                }
            ]
        ])->toArray();

        $this->Auth->setUser($user);
    }
}
