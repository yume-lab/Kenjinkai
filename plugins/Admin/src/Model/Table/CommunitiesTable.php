<?php
namespace Admin\Model\Table;

use Admin\Model\Entity\Community;
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

        $this->belongsTo('CommunityStatuses', [
            'foreignKey' => 'community_status_id',
            'joinType' => 'INNER',
            'className' => 'Admin.CommunityStatuses'
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
        $rules->add($rules->existsIn(['country_id'], 'Countries'));
        $rules->add($rules->existsIn(['ken_id'], 'Kens'));
        $rules->add($rules->existsIn(['city_id'], 'Cities'));
        $rules->add($rules->existsIn(['hometown_country_id'], 'HometownCountries'));
        $rules->add($rules->existsIn(['hometown_ken_id'], 'HometownKens'));
        $rules->add($rules->existsIn(['hometown_city_id'], 'HometownCities'));
        return $rules;
    }

    /**
     * 審査中コミュニティを取得するクエリーを生成するカスタムファインダーです.
     *
     * @return array 取得した情報
     */
    public function findInReview()
    {
        /** @var \Admin\Model\Table\CommunityStatusesTable $CommunityStatuses */
        $CommunityStatuses = TableRegistry::get('CommunityStatuses');
        $statusId = $CommunityStatuses->findIdByAlias('review');
        return $this->find()
            ->hydrate(false)
    		->select([
    			'id' => 'Communities.id',
    			'name' => 'Communities.name',
    			'nickname' => 'UserProfiles.nickname',
    			'ken_name' => 'AdAddress.ken_name',
    			'city_name' => 'AdAddress.city_name',
    			'hometown_ken_name' => 'HomeAdAddress.ken_name',
    			'hometown_city_name' => 'HomeAdAddress.city_name',
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
    			'table' => 'ad_address',
    			'alias' => 'AdAddress',
    			'type' => 'INNER',
    			'conditions' => [
    			    'AdAddress.ken_id = Communities.ken_id',
    			    'AdAddress.city_id = Communities.city_id',
    			]
            ])
            ->join([
    			'table' => 'ad_address',
    			'alias' => 'HomeAdAddress',
    			'type' => 'INNER',
    			'conditions' => [
    			    'HomeAdAddress.ken_id = Communities.hometown_ken_id',
    			    'HomeAdAddress.city_id = Communities.hometown_city_id',
    			]
            ])
            ->where([
                'Communities.is_deleted' => false,
                'Communities.community_status_id' => $statusId
            ]);
    }
}
