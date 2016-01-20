<?php
namespace App\Model\Table;

use App\Model\Entity\AdAddres;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * AdAddress Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Kens
 * @property \Cake\ORM\Association\BelongsTo $Cities
 * @property \Cake\ORM\Association\BelongsTo $Towns
 * @property \Cake\ORM\Association\BelongsTo $News
 */
class AdAddressTable extends Table
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

        $this->table('ad_address');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Kens', [
            'foreignKey' => 'ken_id'
        ]);
        $this->belongsTo('Cities', [
            'foreignKey' => 'city_id'
        ]);
        $this->belongsTo('Towns', [
            'foreignKey' => 'town_id'
        ]);
        $this->belongsTo('News', [
            'foreignKey' => 'new_id'
        ]);
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
            ->allowEmpty('zip');

        $validator
            ->add('office_flg', 'valid', ['rule' => 'boolean'])
            ->allowEmpty('office_flg');

        $validator
            ->add('delete_flg', 'valid', ['rule' => 'boolean'])
            ->allowEmpty('delete_flg');

        $validator
            ->allowEmpty('ken_name');

        $validator
            ->allowEmpty('ken_furi');

        $validator
            ->allowEmpty('city_name');

        $validator
            ->allowEmpty('city_furi');

        $validator
            ->allowEmpty('town_name');

        $validator
            ->allowEmpty('town_furi');

        $validator
            ->allowEmpty('town_memo');

        $validator
            ->allowEmpty('kyoto_street');

        $validator
            ->allowEmpty('block_name');

        $validator
            ->allowEmpty('block_furi');

        $validator
            ->allowEmpty('memo');

        $validator
            ->allowEmpty('office_name');

        $validator
            ->allowEmpty('office_furi');

        $validator
            ->allowEmpty('office_address');

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
        $rules->add($rules->existsIn(['town_id'], 'Towns'));
        $rules->add($rules->existsIn(['new_id'], 'News'));
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
            ->group(['city_id'])
            ->order(['city_id']);
    }
}
