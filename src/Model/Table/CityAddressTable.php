<?php
namespace App\Model\Table;

use App\Model\Entity\CityAddres;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CityAddress Model
 */
class CityAddressTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('city_address');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');


    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->add('id', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('ken_name', 'create')
            ->notEmpty('ken_name');

        $validator
            ->requirePresence('ken_furi', 'create')
            ->notEmpty('ken_furi');

        $validator
            ->requirePresence('city_name', 'create')
            ->notEmpty('city_name');

        $validator
            ->requirePresence('city_furi', 'create')
            ->notEmpty('city_furi');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['ken_id'], 'Kens'));
        $rules->add($rules->existsIn(['city_id'], 'Cities'));
        return $rules;
    }

    /**
     * 都道府県を取得します.
     */
    public function findPrefectures()
    {
        return $this->find()
            ->select(['ken_id', 'ken_name'])
            ->where(['delete_flg' => false])
            ->group(['ken_id'])
            ->order(['ken_id']);
    }

    /**
     * 都道府県の選択肢を構築します.
     */
    public function getOptions()
    {
        $prefectures = $this->findPrefectures();
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
     * 都道府県IDから、該当する市町村を検索します.
     * @param $kenId string 都道府県ID
     */
    public function findCities($kenId)
    {
        return $this->find()
            ->select(['city_id', 'city_name'])
            ->where(['ken_id' => $kenId])
            ->where(['delete_flg' => false])
            ->order(['city_id']);
    }

    /**
     * 都道府県ID、市町村IDから、該当する市町村情報を検索します.
     *
     * @param $kenId string 都道府県ID
     * @param $cityId string 市町村ID
     * @return array 市町村情報
     */
    public function findCity($kenId, $cityId)
    {
        return $this->find()
            ->select(['city_id', 'city_name', 'ken_id', 'ken_name'])
            ->where(['ken_id' => $kenId])
            ->where(['city_id' => $cityId])
            ->where(['delete_flg' => false])
            ->first()
            ->toArray();
    }
}
