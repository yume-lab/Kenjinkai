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

        $user = $this->user;
        $profile = $this->profile;
        $hometown = $this->hometown;
        $genders = Configure::read('Define.genders');

        $city = $AdAddress->findCity($profile['prefectures_id'], $profile['city_id']);
        $hometown = array_merge($hometown, $AdAddress->findCity($hometown['prefectures_id'], $hometown['city_id']));
        $hobbies = $UserHobbies->findToArray($user['id']);
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

        $community = $ReviewCommunities->newEntity(['user_id' => $user['id']]);
        if ($this->request->is(['post'])) {
            $this->log($this->request->data);
            $ReviewCommunities->request($community, $this->request->data);
            return $this->render('request_finish');
        }

        $this->set(compact('community', 'statuses', 'profile', 'genders', 'city', 'hometown', 'hobbies'));
        $this->set('inReviews', $this->paginate($ReviewCommunities));
        $this->set('_serialize', ['community']);
    }
}
