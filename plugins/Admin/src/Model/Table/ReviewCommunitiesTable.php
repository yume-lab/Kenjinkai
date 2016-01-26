<?php
namespace Admin\Model\Table;

use Admin\Model\Entity\ReviewCommunity;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ReviewCommunities Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Users
 * @property \Cake\ORM\Association\BelongsTo $Communities
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
        $this->belongsTo('Communities', [
            'foreignKey' => 'community_id',
            'joinType' => 'INNER',
            'className' => 'Admin.Communities'
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
        $rules->add($rules->existsIn(['community_id'], 'Communities'));
        return $rules;
    }

    /**
     * 審査コメントを更新します.
     *
     * @param int $communityId コミュニティID
     * @param string $comment コメント
     *
     * @return 更新後のモデル
     */
    public function updateComment($communityId, $comment)
    {
        $entity = $this->find()->where(['community_id' => $communityId])->first();
        $entity = $this->patchEntity($entity, ['comment' => $comment]);
        return $this->save($entity);
    }

}
