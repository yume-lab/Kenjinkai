<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Core\Configure;

/**
 * Communities Controller
 * コミュニティに関するコントローラー
 */
class CommunitiesController extends AppController
{

    /**
     * コミュニティ申請ページ
     */
    public function request()
    {
        /** @var \App\Model\Table\ReviewCommunitiesTable $ReviewCommunities */
        $ReviewCommunities = parent::loadTable('ReviewCommunities');
        /** @var \App\Model\Table\CommunityStatusesTable $CommunityStatuses */
        $CommunityStatuses = parent::loadTable('CommunityStatuses');
        /** @var \App\Model\Table\AdAddressTable $AdAddress */
        $AdAddress = parent::loadTable('AdAddress');
        /** @var \App\Model\Table\UserHobbiesTable $UserHobbies */
        $UserHobbies = parent::loadTable('UserHobbies');

        $data = $this->__buildNewData();
        $genders = Configure::read('Define.genders');

        $city = $AdAddress->findCity($data['ken_id'], $data['city_id']);
        $hometown = $AdAddress->findCity($data['hometown_ken_id'], $data['hometown_city_id']);

        $statuses = $CommunityStatuses->map();

        $this->paginate = [
            'conditions' => [
                'ReviewCommunities.community_status_id' => $CommunityStatuses->findIdByAlias('review'),
                'ReviewCommunities.is_deleted' => false
            ],
            'limit' => 3, // TODO: 設定ファイル
            'order' => [
                'ReviewCommunities.id' => 'desc'
            ]
        ];

        $community = $ReviewCommunities->newEntity($data);
        if ($this->request->is(['post'])) {
            $this->log($this->request->data);
            $ReviewCommunities->request($community, $this->request->data);
            return $this->render('request_finish');
        }

        $this->set(compact('community', 'statuses', 'genders', 'city', 'hometown'));
        $this->set('inReviews', $this->paginate($ReviewCommunities));
        $this->set('_serialize', ['community']);
    }

    /**
     * 申請データの初期データを生成します.
     *
     * @return array 初期データ
     */
    private function __buildNewData()
    {
        $data = [
            'user_id' => $this->user['id'],
            'country_id' => $this->profile['country_id'],
            'ken_id' => $this->profile['ken_id'],
            'city_id' => $this->profile['city_id'],
            'hometown_country_id' => $this->hometown['country_id'],
            'hometown_ken_id' => $this->hometown['ken_id'],
            'hometown_city_id' => $this->hometown['city_id']
        ];
        return $data;
    }
}
