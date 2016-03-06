<?php
namespace App\Model\Table;

use App\Model\Entity\CommunityRole;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CommunityRoles Model
 *
 * @property \Cake\ORM\Association\HasMany $UserCommunities
 */
class CommunityRolesTable extends Table
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

        $this->table('community_roles');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('UserCommunities', [
            'foreignKey' => 'community_role_id'
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
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('alias', 'create')
            ->notEmpty('alias')
            ->add('alias', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->boolean('is_deleted')
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
        $rules->add($rules->isUnique(['alias']));
        return $rules;
    }

        /**
     * エイリアスからデータを取得します.
     *
     * @param string $alias CommunityStatus.alias
     */
    public function findByAlias($alias)
    {
        $status = $this->find()->where(['alias' => $alias])->first();
        if (!empty($status)) {
            return $status;
        }
        throw new NotFoundException();
    }

    /**
     * エイリアスから対象のIDを取得します.
     *
     * @param string $alias CommunityStatus.alias
     */
    public function findIdByAlias($alias)
    {
        $status = $this->findByAlias($alias);
        return $status->id;
    }
}
