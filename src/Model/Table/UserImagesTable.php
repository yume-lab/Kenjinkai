<?php
namespace App\Model\Table;

use App\Model\Entity\UserImage;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Utility\Security;

/**
 * UserImages Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Users
 */
class UserImagesTable extends Table
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

        $this->table('user_images');
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
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('hash', 'create')
            ->notEmpty('hash')
            ->add('hash', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->requirePresence('extension', 'create')
            ->notEmpty('extension');

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
        $rules->add($rules->isUnique(['hash']));
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        return $rules;
    }


    /**
     * アップロードファイルの登録を行います.
     *
     * @param int $userId ユーザーID
     * @param array $request アップロード情報
     * @return 処理結果
     */
    public function upload($userId, $request)
    {
        // 前のを全て無効にする
        $this->query()->update()
            ->set(['is_deleted' => true])
            ->where(['user_id' => $userId])
            ->execute();

        // 拡張子取り出し
        $split = explode('.', $request['name']);
        $extension = array_pop($split);
        // ハッシュ生成
        $hash = Security::hash(ceil(microtime(true) * 1000), 'sha1', true);
        $data = [
            'user_id' => $userId,
            'hash' => $hash,
            'name' => $request['name'],
            'mime_type' => $request['type'],
            'size' => $request['size'],
            'extension' => $extension,
            'is_deleted' => false
        ];
        $entity = $this->newEntity($data);
        return $this->save($entity);
    }

    /**
     * ハッシュから画像情報を取得します.
     *
     * @param string $hash ハッシュ
     * @return array 画像情報
     */
    public function findByHash($hash)
    {
        return $this->find()
            ->where(['is_deleted' => false])
            ->where(['hash LIKE ' => $hash.'%'])
            ->first()
            ->toArray();
    }

}
