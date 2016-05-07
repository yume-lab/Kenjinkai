<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Core\Configure;
use Cake\Mailer\Email;
use Cake\Utility\Security;

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
        $this->Auth->allow([
            'login',
            'register',
            'forgot',
            'password',
            'init',
        ]);

        $this->loadModel('PreRegistrations');
        $this->loadModel('UserProfiles');
        $this->loadModel('UserHometowns');
        $this->loadModel('UserHobbies');
        $this->loadModel('CityAddress');

        $this->loadComponent('Notification');
        $this->loadComponent('SecurityUtil');
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
        $user = $this->Users->newEntity(['email' => $data->email], ['validate' => false]);
        $prefectures = $this->CityAddress->getOptions();
        $genders = Configure::read('Define.genders');
        $this->set(compact('user', 'prefectures', 'genders'));
        $this->set('_serialize', ['user']);

        if ($this->request->is(['post'])) {
            $data = $this->request->data;
            $user = $this->Users->add($user, $this->request->data);
            if ($user->errors()) {
                $errors = $user->errors();
                if (isset($errors['password'])) {
                    $this->Flash->error(__('確認用パスワードが一致していません。'));
                    return $this->render('register');
                }
            }
            $userId = $user->id;

            $this->UserProfiles->add($userId, $data['user_profile']);
            $this->UserHometowns->add($userId, $data['user_hometown']);

            $this->setUserInfo($userId);
            $this->Notification->send($userId, '/welcome');
            return $this->render('finished');
        }
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
                $this->Users->tracking($user['id']);
//                return $this->redirect($this->Auth->redirectUrl());
                // ログインしたら必ずTOPに
                return $this->redirect('/');
            } else {
                $this->Flash->error(__('メールアドレス、またはパスワードが正しくありません。'));
            }
        }
    }

    /**
     * 初回登録画面.
     */
    public function init()
    {
        $this->viewBuilder()->layout('unregistered');
        if ($this->request->is('post')) {
            $data = $this->request->data;
            if (empty($data['email'])) {
                $this->Flash->error(__('メールアドレスが未入力です。'));
                return $this->render('init');
            }
            if (empty($data['is_agree'])) {
                $this->Flash->error(__('利用規約への同意をお願い致します。'));
                return $this->render('init');
            }

            $email = $data['email'];
            if ($this->Users->exists(['email' => $email])) {
                $this->Flash->success(__('すでに登録済です。下記からログインしてください。'));
                return $this->redirect(['controller' => 'Users', 'action' => 'login']);
            }

            // FIXME: 仮登録テーブルの再利用, ここから本登録に遷移させる
            $hash = Security::hash(ceil(microtime(true) * 1000), 'sha1', true);
            $this->PreRegistrations->write($email, $hash);

            $this->Flash->success(__('ご登録ありがとうございます！続けてプロフィールの入力をお願いします。'));
            return $this->redirect(['controller' => 'Users', 'action' => 'register', $hash]);
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

            $userId = $user->id;
            $hash = $this->SecurityUtil->encrypt($userId.date('YmdHis'));
            $this->Users->resetPassword($userId, $hash);

            $urlFormat = '%s://%s/users/password/%s';
            $url = sprintf($urlFormat, $this->request->scheme(), $this->request->host(), $hash);

            // TODO: メール送信ログ
            $mailer = new Email('reset_password');
            $mailer->to($email)->viewVars(['url' => $url, 'name' => $data['nickname']])->send();
            $this->Flash->success(__('パスワード再設定の案内をメールにて送信しました。'));
            return $this->redirect(['action' => 'forgot']);
        }
    }

    public function password($hash) {
        $this->viewBuilder()->layout('unregistered');
        $user = $this->Users->findByResetPasswordHash($hash)->first();
        if (!$user) {
            $this->Flash->error(__('パスワード再設定のURLが正しくありません。'));
            $this->redirect(['action' => 'login']);
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->data;
            $data = array_merge($data, ['reset_password_hash' => null]);
            $user = $this->Users->patchEntity($user, $data, ['validate' => 'password']);
            if ($user->errors()) {
                $this->Flash->error(__('確認用パスワードが一致していません。'));
                return $this->redirect(['action' => 'password', $hash]);
            }
            $this->Users->save($user);
            $this->Flash->success(__('パスワードを再設定しました。'));
            return $this->redirect(['action' => 'login']);
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
