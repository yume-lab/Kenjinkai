<?php
namespace App\Model\Table;

use App\Model\Entity\UserHobby;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * UserHobbies Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Users
 */
class UserHobbiesTable extends Table
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

        $this->table('user_hobbies');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
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
            ->requirePresence('content', 'create')
            ->notEmpty('content');

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
        return $rules;
    }

    /**
     * 趣味情報の登録処理を行います.
     *
     * @param int $userId ユーザーID
     * @param array $data POSTされたデータ
     */
    public function add($userId, $data)
    {
        $content = json_encode($data);
        $record = ['user_id' => $userId, 'is_deleted' => false, 'content' => $content];
        $entity = $this->newEntity($record);
        return parent::save($entity);
    }

    /**
     * 趣味情報を配列で取得します.
     *
     * @param int $userId ユーザーID
     * @return array 趣味
     */
    public function findToArray($userId)
    {
        $hobby = $this->find()->select(['content'])->where(['user_id' => $userId])->first();
        if (empty($hobby)) {
            return [];
        }
        return json_decode($hobby->content);
    }
}
