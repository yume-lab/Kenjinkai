<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Core\Configure;

/**
 * Communities Controller
 * コミュニティに関するコントローラー
 *
 * @property \App\Model\Table\Communitiesable $Communities
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

        $data = $this->__buildNewData();

        $city = $AdAddress->findCity($data['ken_id'], $data['city_id']);
        $hometown = $AdAddress->findCity($data['hometown_ken_id'], $data['hometown_city_id']);

        $statuses = $CommunityStatuses->map();

        $community = $this->Communities->newEntity($data);
        if ($this->request->is(['post'])) {
            $data = $this->request->data;
            $this->log($data);
            $this->log($community);

            $results = $this->Communities->request($community, $data);
            $ReviewCommunities->add($data, $results->id);
            return $this->render('request_finish');
        }

        $this->set(compact('community', 'statuses', 'city', 'hometown'));
        $this->set('_serialize', ['community']);
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
        $review = [
            'review_community' => [
                'user_id' => $this->user['id'],
                'message' => '',
            ]
        ];
        return array_merge($community, $review);
    }
}
