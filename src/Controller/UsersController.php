<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Core\Configure;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
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
    }

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->set('users', $this->paginate($this->Users));
        $this->set('_serialize', ['users']);
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => ['UserHometowns', 'UserProfiles']
        ]);
        $this->set('user', $user);
        $this->set('_serialize', ['user']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The user could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The user could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }

    /**
     * ユーザー登録処理を行います.
     * @param string $hash 仮登録時のキー
     */
    public function register($hash)
    {
        $this->viewBuilder()->layout('unregistered');

        /** @var \App\Model\Table\PreRegistrationsTable $PreRegistrations */
        $PreRegistrations = parent::loadTable('PreRegistrations');
        $data = $PreRegistrations->findByHash($hash);

        // 新規エンティティ作成時は一時的にバリデーションを無効にする
        $user = $this->Users->newEntity(['email' => $data->email]);
        if ($this->request->is(['post'])) {
            $data = $this->request->data;
            $this->log($data);
            $user = $this->Users->add($user, $this->request->data);
            $this->log($user);
            $userId = $user->id;

            /** @var \App\Model\Table\UserProfilesTable $UserProfiles */
            $UserProfiles = parent::loadTable('UserProfiles');
            $UserProfiles->add($userId, $data['user_profile']);

            /** @var \App\Model\Table\UserHometownsTable $UserHometowns */
            $UserHometowns = parent::loadTable('UserHometowns');
            $UserHometowns->add($userId, $data['user_hometown']);

            /** @var \App\Model\Table\UserHobbiesTable $UserHobbies */
            $UserHobbies = parent::loadTable('UserHobbies');
            $UserHobbies->add($userId, $data['user_hobbies']);

            $this->setUserInfo($userId);
            return $this->render('finished');
        }
        /** @var \App\Model\Table\CityAddressTable $CityAddress */
        $CityAddress = parent::loadTable('CityAddress');
        $prefectures = $CityAddress->getOptions();

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
            'contain' => ['UserProfiles', 'UserHometowns']
        ])->toArray();

        $this->Auth->setUser($user);
    }
}
