<?php
namespace App\Model\Table;

use App\Model\Entity\UserCommunity;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * UserCommunities Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Users
 * @property \Cake\ORM\Association\BelongsTo $Communities
 * @property \Cake\ORM\Association\BelongsTo $CommunityRoles
 */
class UserCommunitiesTable extends Table
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

        $this->table('user_communities');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Communities', [
            'foreignKey' => 'community_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('CommunityRoles', [
            'foreignKey' => 'community_role_id',
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
            ->allowEmpty('id', 'create');

        $validator
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
        $rules->add($rules->existsIn(['community_role_id'], 'CommunityRoles'));
        return $rules;
    }

    /**
     * ユーザーとコミュニティの紐付けを行います.
     *
     * @param int $userId ユーザーID
     * @param int $communityId コミュニティID
     * @param string $role 役割のエイリアス
     */
    public function link($userId, $communityId, $role)
    {
        $roleId = $this->CommunityRoles->findIdByAlias($role);
        $entity = $this->find()
               ->where(['user_id' => $userId])
               ->where(['community_id' => $communityId])
               ->first();
        if (!$entity) {
            $entity = $this->newEntity();
        }
        $data = [
            'user_id' => $userId,
            'community_id' => $communityId,
            'community_role_id' => $roleId,
            'is_deleted' => false
        ];
        $entity = $this->patchEntity($entity, $data);
        return $this->save($entity);
    }

    /**
     * ユーザーとコミュニティの紐付けを削除します.
     *
     * @param int $userId ユーザーID
     * @param int $communityId コミュニティID
     * @param string $role 役割のエイリアス
     */
    public function unlink($userId, $communityId)
    {
        $entity = $this->find()
                       ->where(['user_id' => $userId])
                       ->where(['community_id' => $communityId])
                       ->where(['is_deleted' => false])
                       ->first();
        $entity = $this->patchEntity($entity, ['is_deleted' => true]);
        return $this->save($entity);
    }

    /**
     * コミュニティIDから所属しているユーザー情報も取得します.
     * @param int $communityId コミュニティID
     * @return array 対象データ
     */
    public function findByCommunityId($communityId) {
        return $this->find()
                    ->contain([
                        'CommunityRoles',
                        'Users' => function ($q) {
                            return $q->where(['Users.is_deleted' => false]);
                        },
                        'Users.UserProfiles',
                        'Users.UserImages' => function ($q) {
                            return $q->where(['UserImages.is_deleted' => false]);
                        },
                    ])
                    ->where(['UserCommunities.community_id' => $communityId])
                    ->where(['UserCommunities.is_deleted' => false])
                    ->all();
    }

    public function hasBelong($communityId, $userId) {
        $options = [
            'community_id' => $communityId,
            'user_id' => $userId,
            'is_deleted' => false
        ];
        return $this->exists($options);
    }

}
