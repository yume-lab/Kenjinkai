<?php
namespace App\Controller\Api;

use App\Controller\AppController;

/**
 * Address Controller
 *
 * @property \App\Model\Table\AddressTable $Address
 */
class AddressController extends AppController
{
    var $autoRender = false;

    /**
     * 初期処理.
     * @return void
     */
    public function initialize() {
        parent::initialize();
        $this->Auth->allow(['cities']);
    }

    /**
     * 都道府県IDをGETで受け取り、属する市町村を取得します.
     */
    public function cities()
    {
        $prefectureId = $this->request->query('prefectureId');
        /** @var \App\Model\Table\CityAddressTable $CityAddress */
        $CityAddress = parent::loadTable('CityAddress');
        $cities = $CityAddress->findCities($prefectureId);
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
