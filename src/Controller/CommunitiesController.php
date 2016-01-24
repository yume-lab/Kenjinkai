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
        return $this->render('request_finish');
        /** @var \App\Model\Table\ReviewCommunitiesTable $ReviewCommunities */
        $ReviewCommunities = parent::loadTable('ReviewCommunities');
        /** @var \App\Model\Table\AdAddressTable $AdAddress */
        $AdAddress = parent::loadTable('AdAddress');
        /** @var \App\Model\Table\UserHobbiesTable $UserHobbies */
        $UserHobbies = parent::loadTable('UserHobbies');

        $user = $this->user;
        $profile = $this->profile;
        $hometown = $this->hometown;
        $genders = Configure::read('Define.genders');

        $city = $AdAddress->findCity($profile['prefectures_id'], $profile['city_id']);
        $home = $AdAddress->findCity($hometown['prefectures_id'], $hometown['city_id']);
        $hometown = array_merge($hometown, $home);
        $hobbies = $UserHobbies->findArray($user['id']);

        $community = $ReviewCommunities->newEntity(['user_id' => $user['id']]);
        if ($this->request->is(['post'])) {
            $this->log($this->request->data);
            $ReviewCommunities->request($community, $this->request->data);
            return $this->render('request_finish');
        }

        $this->set(compact('community', 'user', 'profile', 'genders', 'city', 'hometown', 'hobbies'));
        $this->set('_serialize', ['community']);
    }
}
