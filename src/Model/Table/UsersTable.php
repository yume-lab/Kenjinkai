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

        $this->hasMany('UserHometowns', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('UserProfiles', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('UserHobbies', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('UserImages', [
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

    public function validationPassword(Validator $validator) {
        $validator->add('password', [
            'compare' => [
                'rule' => ['compareWith', 'confirm_password'],
                'message' => __('確認用パスワードと一致していません。')
            ]
        ]);

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
     */
    public function add($entity, $data)
    {
        $data = array_merge($data, [
            'registered' => new Time(),
            'is_deleted' => false,
        ]);
        $entity = $this->patchEntity($entity, $data, ['validate' => 'password']);
        if ($entity->errors()) {
            return $entity;
        }
        return parent::save($entity);
    }

    /**
     * ユーザー情報を取得します. 関連するテーブルのデータも取得します.
     *
     * @param $id int ユーザーID
     * @return Users ユーザー情報
     */
    public function findById($id) {
        return $this->get($id, [
            'contain' => [
                'UserProfiles',
                'UserHometowns',
                'UserImages' => function ($q) {
                    return $q->where(['UserImages.is_deleted' => false]);
                }
            ]
        ]);
    }

    public function resetPassword($id, $hash) {
        $user = $this->get($id);
        $data = [
            'password' => 'reset_password_'.date('YmdHis'),
            'reset_password_hash' => $hash,
            'password_reset_at' => new Time()
        ];
        $user = $this->patchEntity($user, $data);
        return $this->save($user);
    }

    public function tracking($id) {
        $user = $this->get($id);
        $lastLogin = $user->current_login_at;
        $now = new Time();
        $data = [
            'last_login_at' => empty($lastLogin) ? $now : $lastLogin,
            'current_login_at' => $now
        ];
        $user = $this->patchEntity($user, $data);
        return $this->save($user);
    }

}
