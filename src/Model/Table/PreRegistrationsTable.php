<?php
namespace App\Model\Table;

use App\Model\Entity\PreRegistration;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\I18n\Time;

/**
 * PreRegistrations Model
 *
 */
class PreRegistrationsTable extends Table
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

        $this->table('pre_registrations');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

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
            ->notEmpty('email');

        $validator
            ->requirePresence('hash', 'create')
            ->notEmpty('hash');

        $validator
            ->add('registered', 'valid', ['rule' => 'datetime'])
            ->requirePresence('registered', 'create')
            ->notEmpty('registered');

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
     * 仮登録テーブルにデータを登録します.
     * @param $email string メールアドレス
     * @param $hash string 識別キー
     * @return 処理結果
     */
    public function write($email, $hash)
    {
        $data = [
            'email' => $email,
            'hash' => $hash,
            'registered' => new Time()
        ];
        $entity = $this->newEntity($data);
        return $this->save($entity);
    }

}
