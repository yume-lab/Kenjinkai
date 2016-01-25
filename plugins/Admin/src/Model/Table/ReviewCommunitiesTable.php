<?php
namespace Admin\Model\Table;

use Admin\Model\Entity\ReviewCommunity;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\TableRegistry;

/**
 * ReviewCommunities Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Users
 * @property \Cake\ORM\Association\BelongsTo $CommunityStatuses
 */
class ReviewCommunitiesTable extends Table
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

        $this->table('review_communities');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
            'className' => 'Admin.Users'
        ]);
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
            ->requirePresence('message', 'create')
            ->notEmpty('message');

        $validator
            ->requirePresence('comment', 'create')
            ->notEmpty('comment');

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
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        $rules->add($rules->existsIn(['community_status_id'], 'CommunityStatuses'));
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
    			'id' => 'ReviewCommunities.id',
    			'user_id' => 'Users.id',
    			'nickname' => 'UserProfiles.nickname',
    			'community_status_id' => 'ReviewCommunities.community_status_id',
    			'message' => 'ReviewCommunities.message',
    			'created' => 'ReviewCommunities.created',
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
            ->where([
                'ReviewCommunities.is_deleted' => false,
                'ReviewCommunities.community_status_id' => $statusId
            ]);
    }
}
