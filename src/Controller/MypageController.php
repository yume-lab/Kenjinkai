<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Core\Configure;

/**
 * Mypage Controller
 *
 * マイページ、プロフィール編集コントローラー.
 * @property \App\Model\Table\UsersTable $Users
 * @property \App\Model\Table\UserProfilesTable $UserProfiles
 * @property \App\Model\Table\CityAddressTable $CityAddress
 */
class MypageController extends AppController
{

    /**
     * 初期処理.
     * @return void
     */
    public function initialize() {
        parent::initialize();

        $this->loadModel('Users');
        $this->loadModel('UserProfiles');
        $this->loadModel('CityAddress');

        $this->loadComponent('Images');
    }

    /**
     * 更新を行います.
     *
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit()
    {
        $user = $this->Users->findById($this->user['id']);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->data;

            // TODO: メールアドレスとかも
            $this->UserProfiles->update($user->user_profiles[0]['id'], $data['user_profiles'][0]);

            if (isset($data['user_images'])) {
                // 画像保存
                $this->Images->saveProfile($this->user['id'], $data['user_images']);
            }

            // セッション情報も上書き
            $user = $this->Users->findById($this->user['id']);
            $this->Auth->setUser($user->toArray());

            $this->Flash->success(__('プロフィールを更新しました。'));
            return $this->redirect(['action' => 'edit']);
        }
        $prefectures = $this->CityAddress->getOptions();
        $genders = Configure::read('Define.genders');
        $this->set(compact('user', 'prefectures', 'genders'));
    }
}
