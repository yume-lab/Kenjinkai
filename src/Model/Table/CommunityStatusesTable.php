<?php
namespace App\Model\Table;

use App\Model\Entity\CommunityStatus;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CommunityStatuses Model
 *
 * @property \Cake\ORM\Association\HasMany $ReviewCommunities
 */
class CommunityStatusesTable extends Table
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

        $this->table('community_statuses');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('ReviewCommunities', [
            'foreignKey' => 'community_status_id'
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
            ->requirePresence('alias', 'create')
            ->notEmpty('alias')
            ->add('alias', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

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

    /**
     * ステータス情報を、キーにID、名称をvalueとする連想配列で取得します.
     *
     * @return array key: ID, value: name のハッシュマップ.
     */
    public function map()
    {
        $statuses = $this->find()->toArray();
        $results = [];
        foreach ($statuses as $status) {
            $results[$status['id']] = $status['name'];
        }
        return $results;
    }
}
