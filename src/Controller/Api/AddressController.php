<?php
namespace App\Controller\Api;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * Address Controller
 *
 * @property \App\Model\Table\AddressTable $Address
 */
class AddressController extends AppController
{
    var $autoRender = false;
    
    public function cities()
    {
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
