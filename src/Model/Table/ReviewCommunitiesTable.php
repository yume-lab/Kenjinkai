<?php
namespace App\Model\Table;

use App\Model\Entity\ReviewCommunity;
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
     * コミュニティ申請データに登録します.
     *
     * @param object $entity テーブルオブジェクト
     * @param array $data 入力データ
     */
    public function request($entity, $data)
    {
        /** @var \App\Model\Table\CommunityStatusesTable $CommunityStatuses */
        $CommunityStatuses = TableRegistry::get('CommunityStatuses');
        $statusId = $CommunityStatuses->findIdByAlias('review');
        $data = [
            'community_status_id' => $statusId,
            'message' => $data['message'],
            'comment' => ' ',
            'is_deleted' => false
        ];
        $entity = $this->patchEntity($entity, $data);
        return parent::save($entity);
    }

    /**
     * 審査コミュニティからデータを取得します.
     *
     * @param int $userId 対象のユーザーID
     * @param string $alias 取得したいステータスを指定
     * @return array 取得した情報
     */
    public function findByUserId($userId, $alias = '')
    {
        $where = ['user_id' => $userId, 'is_deleted' => false];
        if (!empty($alias)) {
            /** @var \App\Model\Table\CommunityStatusesTable $CommunityStatuses */
            $CommunityStatuses = TableRegistry::get('CommunityStatuses');
            $statusId = $CommunityStatuses->findIdByAlias($alias);
            $where = array_merge($where, ['community_status_id' => $statusId]);
        }
        return $this->find()->where($where)->toArray();;
    }
}
