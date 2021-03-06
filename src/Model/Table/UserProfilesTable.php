<?php
namespace App\Model\Table;

use App\Model\Entity\UserProfile;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * UserProfiles Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Users
 */
class UserProfilesTable extends Table
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

        $this->table('user_profiles');
        $this->displayField('name');
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
            ->add('gender', 'valid', ['rule' => 'numeric'])
            ->requirePresence('gender', 'create')
            ->notEmpty('gender');

        $validator
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->requirePresence('nickname', 'create')
            ->notEmpty('nickname');

        $validator
            ->requirePresence('birthday', 'create')
            ->notEmpty('birthday');

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
     * ユーザープロフィールの登録処理を行います.
     *
     * @param int $userId ユーザーID
     * @param array $data POSTされたデータ
     */
    public function add($userId, $data)
    {
        $record = [
            'user_id' => $userId,
            'is_deleted' => false,
            'birthday' => $this->convertBirthday($data['birthday'])
        ];
        $entity = $this->newEntity(array_merge($data, $record));
        return $this->save($entity);
    }

    /**
     * ユーザープロフィールの更新処理を行います.
     *
     * @param int $id ID
     * @param array $data POSTされたデータ
     */
    public function update($id, $data)
    {
        $profile = $this->get($id);
        $record = [
            'name' => $data['name'],
            'nickname' => $data['nickname'],
            'ken_id' => $data['ken_id'],
            'city_id' => $data['city_id']
        ];
        $entity = $this->patchEntity($profile, $record);
        return $this->save($entity);
    }

    /**
     * 生年月日の配列を文字列に変換します.
     *
     * @param array $birthArray 生年月日配列
     * @return string 生年月日文字列 yyyymmdd
     */
    public function convertBirthday($birthArray)
    {
        return $birthArray['year'] . $birthArray['month'] . $birthArray['day'];
    }
}
