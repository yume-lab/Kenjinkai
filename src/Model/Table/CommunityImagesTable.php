<?php
namespace App\Model\Table;

use App\Model\Entity\CommunityImage;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Utility\Security;

/**
 * CommunityImages Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Communities
 */
class CommunityImagesTable extends Table
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

        $this->table('community_images');
        $this->displayField('name');
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
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('hash', 'create')
            ->notEmpty('hash')
            ->add('hash', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->requirePresence('mime_type', 'create')
            ->notEmpty('mime_type');

        // TODO: 画像の最大サイズのバリデーションをかく
        $validator
            ->requirePresence('size', 'create')
            ->notEmpty('size');

        $validator
            ->requirePresence('extension', 'create')
            ->notEmpty('extension');

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
        $rules->add($rules->isUnique(['hash']));
        $rules->add($rules->existsIn(['community_id'], 'Communities'));
        return $rules;
    }

    /**
     * アップロードファイルの登録を行います.
     *
     * @param int $communityId コミュニティID
     * @param array $request アップロード情報
     * @return 処理結果
     */
    public function upload($communityId, $request)
    {
        // 拡張子取り出し
        $split = explode('.', $request['name']);
        $extension = array_pop($split);
        // ハッシュ生成
        $hash = Security::hash(ceil(microtime(true) * 1000), 'sha1', true);
        $data = [
            'community_id' => $communityId,
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
