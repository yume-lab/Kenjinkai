<?php
namespace App\Model\Table;

use App\Model\Entity\Community;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\TableRegistry;

/**
 * Communities Model
 *
 * @property \Cake\ORM\Association\BelongsTo $CommunityStatuses
 * @property \Cake\ORM\Association\BelongsTo $Countries
 * @property \Cake\ORM\Association\BelongsTo $Kens
 * @property \Cake\ORM\Association\BelongsTo $Cities
 * @property \Cake\ORM\Association\BelongsTo $HometownCountries
 * @property \Cake\ORM\Association\BelongsTo $HometownKens
 * @property \Cake\ORM\Association\BelongsTo $HometownCities
 */
class CommunitiesTable extends Table
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

        $this->table('communities');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('ReviewCommunities', [
            'foreignKey' => 'community_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('CommunityStatuses', [
            'foreignKey' => 'community_status_id',
            'joinType' => 'INNER'
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
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->add('is_deleted', 'valid', ['rule' => 'boolean'])
            ->requirePresence('is_deleted', 'create')
            ->notEmpty('is_deleted');

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
        $rules->add($rules->existsIn(['community_status_id'], 'CommunityStatuses'));
        return $rules;
    }

    /**
     * 申請されたコミュニティデータを登録します.
     *
     * @param object $entity テーブルオブジェクト
     * @param array $data 入力データ
     */
    public function request($entity, $data)
    {
        /** @var \App\Model\Table\CommunityStatusesTable $CommunityStatuses */
        $CommunityStatuses = TableRegistry::get('CommunityStatuses');
        $statusId = $CommunityStatuses->findIdByAlias('review');
        $data = array_merge($data, [
            'community_status_id' => $statusId,
            'is_deleted' => false
        ]);
        $entity = $this->patchEntity($entity, $data);
        return parent::save($entity);
    }

    /**
     * 審査中コミュニティを取得するクエリーを生成するカスタムファインダーです.
     *
     * @return array 取得した情報
     */
    public function findInReview()
    {
        /** @var \App\Model\Table\CommunityStatusesTable $CommunityStatuses */
        $CommunityStatuses = TableRegistry::get('CommunityStatuses');
        $statusId = $CommunityStatuses->findIdByAlias('review');
        return $this->find()
            ->hydrate(false)
    		->select([
    			'id' => 'Communities.id',
    			'name' => 'Communities.name',
    			'message' => 'ReviewCommunities.message',
    			'created' => 'ReviewCommunities.created',
    		])
            ->join([
    			'table' => 'review_communities',
    			'alias' => 'ReviewCommunities',
    			'type' => 'INNER',
    			'conditions' => 'Communities.id = ReviewCommunities.community_id',
            ])
            ->join([
    			'table' => 'users',
    			'alias' => 'Users',
    			'type' => 'INNER',
    			'conditions' => 'Users.id = ReviewCommunities.user_id',
            ])
            ->where([
                'Communities.is_deleted' => false,
                'Communities.community_status_id' => $statusId
            ]);
    }

    /**
     * 対象コミュニティの詳細情報を取得します.
     *
     * @param int $id コミュニティテーブルのID
     * @return コミュニティデータ
     */
    public function findDetails($id)
    {
        return $this->find()
            ->hydrate(false)
    		->select([
    			'id' => 'Communities.id',
    			'name' => 'Communities.name',
    			'nickname' => 'UserProfiles.nickname',
    			'ken_name' => 'CityAddress.ken_name',
    			'city_name' => 'CityAddress.city_name',
    			'hometown_ken_name' => 'HometownCityAddress.ken_name',
    			'hometown_city_name' => 'HometownCityAddress.city_name',
    			'message' => 'ReviewCommunities.message',
    			'created' => 'ReviewCommunities.created',
    		])
            ->join([
    			'table' => 'review_communities',
    			'alias' => 'ReviewCommunities',
    			'type' => 'INNER',
    			'conditions' => 'Communities.id = ReviewCommunities.community_id',
            ])
            ->join([
    			'table' => 'users',
    			'alias' => 'Users',
    			'type' => 'INNER',
    			'conditions' => 'Users.id = ReviewCommunities.user_id',
            ])
            ->join([
    			'table' => 'user_profiles',
    			'alias' => 'UserProfiles',
    			'type' => 'INNER',
    			'conditions' => 'UserProfiles.user_id = ReviewCommunities.user_id',
            ])
            ->join([
    			'table' => 'city_address',
    			'alias' => 'CityAddress',
    			'type' => 'INNER',
    			'conditions' => [
    			    'CityAddress.ken_id = Communities.ken_id',
    			    'CityAddress.city_id = Communities.city_id',
    			]
            ])
            ->join([
    			'table' => 'city_address',
    			'alias' => 'HometownCityAddress',
    			'type' => 'INNER',
    			'conditions' => [
    			    'HometownCityAddress.ken_id = Communities.hometown_ken_id',
    			    'HometownCityAddress.city_id = Communities.hometown_city_id',
    			]
            ])
            ->where([
                'Communities.id' => $id
            ])
            ->first();
    }
}
