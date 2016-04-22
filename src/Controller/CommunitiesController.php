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

        $this->loadComponent('Images');
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

        $community = $this->Communities->newEntity($data);
        if ($this->request->is(['post'])) {
            $data = $this->request->data;
            $results = $this->Communities->request($community, $data);
            $this->ReviewCommunities->add($data, $results->id, $this->user['id']);
            if (isset($data['community_images'])) {
                // 画像保存
                $this->Images->saveCommunity($results->id, $data['community_images']);
            }
            return $this->render('request_finish');
        }

        $this->set(compact('community', 'city', 'hometown', 'reviews'));
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
        $checkDefaultOptions = [
            'UserCommunities.community_id' => $community['id'],
            'UserCommunities.user_id' => $this->user['id'],
            'UserCommunities.is_deleted' => false
        ];
        $belongsTo = $this->UserCommunities->exists($checkDefaultOptions);

        $adminRoleId = $this->CommunityRoles->findIdByAlias('leader');
        $isLeader = $this->UserCommunities->exists(array_merge(
            $checkDefaultOptions,
            ['community_role_id' => $adminRoleId]
        ));
        $this->set(compact('community', 'members', 'belongsTo', 'isLeader'));
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
