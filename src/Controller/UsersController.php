<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController
{
    private $options = [
        'associated' => [
            'UserProfiles',
            'UserHometowns'
        ]
    ];

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
     */
    public function register($hash = '')
    {
        $this->viewBuilder()->layout('unregistered');

        // TODO: 入力チェック
        // TODO: 生年月日のデータ組み換え
        $user = $this->Users->newEntity(null, $this->options);
        if ($this->request->is(['post'])) {
            $this->Users->add($user, $this->request->data, $this->options);
        }
        $prefectures = $this->buildPrefectures();
        $this->set(compact('user', 'prefectures'));
        $this->set('_serialize', ['user']);
    }
    
    /**
     * 都道府県の選択肢を構築します.
     */
    private function buildPrefectures()
    {
        /** @var \App\Model\Table\AdAddressTable $AdAddress */
        $AdAddress = TableRegistry::get('AdAddress');
        $prefectures = $AdAddress->findPrefectures();

        $results = [];
        foreach ($prefectures as $pref) {
            $results[] = [
                'value' => $pref->ken_id,
                'text' => $pref->ken_name
            ];
        }
        return $results;
    }
    
    /**
     * TODO: ここではなく、API用の別コントローラーを作る.
     * 市町村を取得するAPIです.
     */
    public function cities()
    {
        $this->autoRender = false;

        $prefectureId = $this->request->query('prefectureId');
        /** @var \App\Model\Table\AdAddressTable $AdAddress */
        $AdAddress = TableRegistry::get('AdAddress');
        $cities = $AdAddress->findCities($prefectureId);
        $results = [];
        foreach ($cities as $city) {
            $results[] = [
                'value' => $city->city_id,
                'label' => $city->city_name
            ];
        }
        echo json_encode($results);
    }
    
}
