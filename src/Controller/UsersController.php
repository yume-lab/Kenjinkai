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
     * 初期処理.
     * @return void
     */
    public function initialize() {
        parent::initialize();
        $this->Auth->allow(['login', 'register', 'forgot']);

        $this->loadModel('PreRegistrations');
        $this->loadModel('UserProfiles');
        $this->loadModel('UserHometowns');
        $this->loadModel('UserHobbies');
        $this->loadModel('CityAddress');

        $this->loadComponent('Notification');
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
            $user = $this->Users->add($user, $this->request->data);
            $userId = $user->id;

            $this->UserProfiles->add($userId, $data['user_profile']);
            $this->UserHometowns->add($userId, $data['user_hometown']);
            $this->UserHobbies->add($userId, $data['user_hobbies']);

            $this->setUserInfo($userId);
            $this->Notification->send($userId, '/welcome');
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
     * アカウント設定
     */
    public function edit() {
        $user = $this->Users->findById($this->user['id']);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->data;
            $user = $this->Users->patchEntity($user, $data);
            if (isset($data['confirm_password'])) {
                $user = $this->Users->patchEntity($user, $data, ['validate' => 'password']);
                if ($user->errors()) {
                    $this->Flash->error(__('確認用パスワードが一致していません。'));
                    return $this->redirect(['action' => 'edit']);
                }
            }
            $this->Users->save($user);

            // セッション情報も上書き
            $user = $this->Users->findById($this->user['id']);
            $this->Auth->setUser($user->toArray());

            $this->Flash->success(__('プロフィールを更新しました。'));
            return $this->redirect(['action' => 'edit']);
        }
        $this->set(compact('user'));
    }

    /**
     * パスワード忘れた人用の再発行
     */
    public function forgot() {
        $this->viewBuilder()->layout('unregistered');

        $data = $this->request->data;
        $this->log($data);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $email = $data['email'];
            $user = $this->Users->findByEmail($email)->first();
            if (!$user) {
                $this->Flash->error(__('メールアドレスが存在しません。'));
                return $this->redirect(['action' => 'forgot']);
            }

            $conditions = [
                'user_id' => $user->id,
                'nickname' => $data['nickname'],
                'birthday' => $this->UserProfiles->convertBirthday($data['birthday'])
            ];
            if (!$this->UserProfiles->exists($conditions)) {
                $this->Flash->error(__('プロフィール情報に誤りがあります。'));
                return $this->redirect(['action' => 'forgot']);
            }

            // TODO: ハッシュ生成
            // TODO: ユーザーテーブル登録
        }
    }

    /**
     * ユーザーIDからユーザー情報をセッションに設定します.
     * @param int $userId ユーザーID
     * @return void
     */
    private function setUserInfo($userId)
    {
        $user = $this->Users->findById($userId);
        $this->Auth->setUser($user->toArray());
    }
}
