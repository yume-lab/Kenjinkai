<?php
namespace App\Model\Table;

use App\Model\Entity\UserInformation;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * UserInformations Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Users
 * @property \Cake\ORM\Association\BelongsTo $Information
 */
class UserInformationsTable extends Table
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

        $this->table('user_informations');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Informations', [
            'foreignKey' => 'information_id',
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
            ->allowEmpty('convert_info');

        $validator
            ->add('read_date', 'valid', ['rule' => 'datetime'])
            ->allowEmpty('read_date');

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
        $rules->add($rules->existsIn(['information_id'], 'Informations'));
        return $rules;
    }

    /**
     * ユーザーにお知らせを送信します.
     *
     * @param int $userId ユーザーID
     * @param string $path お知らせマスタのショートカット
     * @param array $convert 置き換え情報
     * @retrun 処理結果
     */
    public function send($userId, $path, $convert = [])
    {
        $information = $this->Informations->findByPath($path);
        if (empty($information)) {
            return false;
        }
        $data = [
            'user_id' => $userId,
            'information_id' => $information->id,
            'convert_info' => json_encode($convert),
            'read_date' => null,
            'is_deleted' => false
        ];
        $entity = $this->newEntity($data);
        return $this->save($entity);
    }

    /**
     * 対象ユーザーのお知らせを取得します.
     *
     * @param int $userId ユーザーID
     * @param bool $unreadOnly 未読のみ取得する場合はtrueを指定
     * @return array お知らせ情報
     */
    public function findByUserId($userId, $unreadOnly = false)
    {
        $conditions = [
            'UserInformations.user_id' => $userId,
            'UserInformations.is_deleted' => false
        ];
        if ($unreadOnly) {
            $conditions = array_merge(['UserInformations.read_date is NULL']);
        }
        return $this->find()->contain('Informations')->where($conditions);
    }
}
