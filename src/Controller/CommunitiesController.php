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
            $this->log($data);
            $this->log($community);

            $results = $this->Communities->request($community, $data);
            $this->ReviewCommunities->add($data, $results->id, $this->user['id']);
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
                'HomeCityAddress'
            ]
        ]);

        if ($this->request->is('post')) {
            // TODO: 画像アップデート
            // TODO: コミュニティ設定の更新
            // TODO: コミュニティ紐付けテーブルに、ログインユーザーをリーダーで
        }

        $this->set(compact('community'));
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
        return $community;
    }
}
