<?php
namespace App\Model\Table;

use App\Model\Entity\User;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\I18n\Time;

/**
 * Users Model
 *
 * @property \Cake\ORM\Association\HasMany $UserHometowns
 * @property \Cake\ORM\Association\HasMany $UserProfiles
 */
class UsersTable extends Table
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

        $this->table('users');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasOne('UserHometowns', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasOne('UserProfiles', [
            'foreignKey' => 'user_id'
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
            ->add('email', 'valid', ['rule' => 'email'])
            ->requirePresence('email', 'create')
            ->notEmpty('email')
            ->add('email', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->requirePresence('password', 'create')
            ->notEmpty('password');

        $validator
            ->add('registered', 'valid', ['rule' => 'datetime'])
            ->requirePresence('registered', 'create')
            ->notEmpty('registered');

        $validator
            ->add('exited', 'valid', ['rule' => 'datetime'])
            ->allowEmpty('exited');

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
        $rules->add($rules->isUnique(['email']));
        return $rules;
    }

    /**
     * ユーザーの登録処理を行います.
     *
     * @param $this $entity ユーザーモデルエンティティ
     * @param array $data POSTされたデータ
     * @param array $associated アソシエーション情報
     */
    public function add($entity, $data, $associated = [])
    {
        // FIXME: 暫定対応
        $profile = array_merge($data['user_profile'], ['is_deleted' => false]);
        $hometown = array_merge($data['user_hometown'], ['is_deleted' => false]);
        $profile['birthday'] = $this->convertBirthday($profile['birthday']);

        $additions = [
            'registered' => new Time(),
            'is_deleted' => false,
            'user_profile' => $profile,
            'user_hometown' => $hometown
        ];
        $data = array_merge($data, $additions);
        $entity = $this->patchEntity($entity, $data, $associated);
        return parent::save($entity);
    }

    /**
     * 生年月日の配列を文字列に変換します.
     *
     * @param array $birthArray 生年月日配列
     * @return string 生年月日文字列 yyyymmdd
     */
    private function convertBirthday($birthArray)
    {
        return $birthArray['year'] . $birthArray['month'] . $birthArray['day'];
    }
}
