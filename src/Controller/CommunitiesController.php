<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Core\Configure;

/**
 * Communities Controller
 * コミュニティに関するコントローラー
 *
 * @property \App\Model\Table\CommunitiesTable $Communities
 * @property \App\Model\Table\ReviewCommunitiesTable $ReviewCommunities
 * @property \App\Model\Table\CityAddressTable $CityAddress
 * @property \App\Model\Table\CommunityImagesTable $CommunityImages
 * @property \App\Model\Table\CommunitySettingsTable $CommunitySettings
 */
class CommunitiesController extends AppController
{

    /**
     * Initialization method.
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();
        $this->loadModel('ReviewCommunities');
        $this->loadModel('CityAddress');
        $this->loadModel('CommunityImages');
        $this->loadModel('CommunityStatuses');
        $this->loadModel('UserCommunities');
        $this->loadModel('CommunitySettings');
        $this->loadModel('CommunityRoles');
        $this->loadModel('CommunityThreads');
        $this->loadModel('CommunityCategories');
        $this->loadModel('ThreadCategories');

        $this->loadComponent('Images');
    }

    /**
     * コミュニティ一覧. 検索
     */
    public function index() {
        $this->paginate = ['limit' => 10]; // TODO: configに
        $communities = $this->paginate($this->Communities->search($this->request->query));
        $prefectures = $this->CityAddress->getOptions();
        $categories = $this->CommunityCategories->find('list')->toArray();
        $this->request->data = $this->request->query;
        $this->set(compact('prefectures', 'categories', 'communities'));
    }

    /**
     * コミュニティ申請ページ
     */
    public function request()
    {
        $data = $this->__buildNewData();

        $city = $this->CityAddress->findCity($data['ken_id'], $data['city_id']);
        $hometown = $this->CityAddress->findCity($data['hometown_ken_id'], $data['hometown_city_id']);

        $this->paginate = ['limit' => 10]; // TODO: configに
        $reviews = $this->paginate($this->Communities->findInReview());

        $community = $this->Communities->newEntity($data, ['validate' => false]);
        if ($this->request->is(['post'])) {
            $data = $this->request->data;
            $results = $this->Communities->request($community, $data);
            $this->ReviewCommunities->add($data, $results->id, $this->user['id']);
            if ($this->Images->canUpload($data, 'community_images')) {
                // 画像保存
                $this->Images->saveCommunity($results->id, $data['community_images']);
            }
            return $this->render('request_finish');
        }

        $this->set(compact('community', 'city', 'hometown', 'reviews'));
        $this->set('_serialize', ['community']);
    }

    public function edit($id) {
        $community = $this->Communities->get($id,[
            'contain' => [
                'CityAddress',
                'ReviewCommunities',
                'HomeCityAddress',
                'CommunityImages'  => function ($q) {
                    return $q->where(['CommunityImages.is_deleted' => false]);
                }
            ]
        ]);

        $categories = $this->CommunityCategories->find('list')->toArray();
        if ($this->request->is(['post', 'put', 'patch'])) {
            $data = $this->request->data;
            if ($this->Images->canUpload($data, 'community_images')) {
                // 画像保存
                $this->Images->saveCommunity($id, $data['community_images']);
            }
            $community = $this->Communities->patchEntity($community, $data);
            $this->Communities->save($community, $data);
            $this->Flash->success(__('コミュニティ情報を更新しました！'));
            return $this->redirect(['action' => 'view', $id]);
        }
        $this->set(compact('community', 'categories'));
        $this->set('_serialize', ['community']);
    }

    /**
     * コミュニティ初期設定画面.
     *
     * GETでコミュニティのIDを受取ります.
     */
    public function init($id)
    {
        $community = $this->Communities->get($id,[
            'contain' => [
                'CityAddress',
                'ReviewCommunities',
                'HomeCityAddress',
                'CommunityImages'  => function ($q) {
                    return $q->where(['CommunityImages.is_deleted' => false]);
                }
            ]
        ]);
        $publishStatusId = $this->CommunityStatuses->findIdByAlias('publish');
        if ($publishStatusId == $community->community_status_id) {
            return $this->redirect(['action' => 'view', $id]);
        }

        if ($this->request->is(['post', 'put', 'patch'])) {
            $data = $this->request->data;
            $communityId = $data['id'];
            $this->CommunitySettings->register($communityId, $data['community_settings']);
            $community = $this->Communities->patchEntity($community, $data);
            if ($this->Communities->save($community, $data)) {
                $this->UserCommunities->link($data['user_id'], $data['id'], 'leader');
                $this->Flash->success(__('コミュニティの初期設定が完了しました！'));
                return $this->redirect(['action' => 'init', $id]);
            }
        }
        $genders = Configure::read('Define.genders');
        $age = range(10, 100, 10);
        $generations = array_combine($age, $age);

        $this->set(compact('community', 'genders', 'generations', 'publishStatusId'));
        $this->set('_serialize', ['community']);
    }

    /**
     * コミュニティ詳細ページです.
     */
    public function view($id)
    {
        $community = $this->Communities->get($id,[
            'contain' => [
                'CityAddress',
                'ReviewCommunities',
                'HomeCityAddress',
                'CommunityImages' => function ($q) {
                    return $q->where(['CommunityImages.is_deleted' => false]);
                }
            ]
        ]);

        $members = $this->UserCommunities->findByCommunityId($community['id']);
        $belongsTo = $this->UserCommunities->hasBelong($community['id'], $this->user['id']);
        $isLeader = $this->UserCommunities->isLeader($community['id'], $this->user['id']);

        $this->paginate = ['limit' => 10]; // TODO: configに
        $threads = $this->paginate($this->CommunityThreads->findLatest($community['id']));
        $threadCategories = $this->ThreadCategories->find('list')->toArray();

        $categories = $this->CommunityCategories->find('list')->toArray();

        $this->set(compact('community', 'members', 'categories', 'belongsTo', 'isLeader', 'threads', 'threadCategories'));
        $this->set('_serialize', ['community']);
    }

    /**
     * コミュニティ参加処理.
     * @param $id int コミュニティID
     */
    public function join($id) {
        if ($this->UserCommunities->link($this->user['id'], $id, 'general')) {
            $this->Flash->success(__('コミュニティに参加しました！'));
            return $this->redirect(['action' => 'view', $id]);
        }
        $this->Flash->error(__('コミュニティ参加に失敗しました。'));
    }

    /**
     * コミュニティ退会処理.
     * @param $id int コミュニティID
     */
    public function unjoin($id) {
        if ($this->UserCommunities->unlink($this->user['id'], $id)) {
            $this->Flash->success(__('コミュニティを退会しました。'));
            return $this->redirect(['action' => 'view', $id]);
        }
        $this->Flash->error(__('コミュニティ参加に失敗しました。'));
    }

    /**
     * 申請データの初期データを生成します.
     *
     * @return array 初期データ
     */
    private function __buildNewData()
    {
        $community = [
            'country_id' => $this->profile['country_id'],
            'ken_id' => $this->profile['ken_id'],
            'city_id' => $this->profile['city_id'],
            'hometown_country_id' => $this->hometown['country_id'],
            'hometown_ken_id' => $this->hometown['ken_id'],
            'hometown_city_id' => $this->hometown['city_id']
        ];
        return $community;
    }
}
