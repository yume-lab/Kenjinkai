<?php
namespace App\Model\Table;

use App\Model\Entity\Information;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Informations Model
 *
 * @property \Cake\ORM\Association\BelongsTo $InformationTypes
 */
class InformationsTable extends Table
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

        $this->table('informations');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('InformationTypes', [
            'foreignKey' => 'information_type_id',
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
            ->requirePresence('path', 'create')
            ->notEmpty('path')
            ->add('path', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->requirePresence('content', 'create')
            ->notEmpty('content');

        $validator
            ->add('is_deleted', 'valid', ['rule' => 'boolean'])
            ->requirePresence('is_deleted', 'create')
            ->notEmpty('is_deleted');

        $validator
            ->requirePresence('title', 'create')
            ->notEmpty('title');

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
        $rules->add($rules->isUnique(['path']));
        $rules->add($rules->existsIn(['information_type_id'], 'InformationTypes'));
        return $rules;
    }

    /**
     * お知らせ種別から、お知らせ情報を取得します.
     *
     * @param string $alias InformationTypes.alias
     * @return array 取得したお知らせ情報
     */
    public function findByTypeAlias($alias)
    {
        $typeId = $this->InformationTypes->findIdByAlias($alias);
        return $this->find()->where(['information_type_id' => $typeId]);
    }

    /**
     * 対象のお知らせ情報を取得します.
     *
     * @param string $path お知らせ情報のショートカット
     * @return array お知らせ情報
     */
    public function findByPath($path)
    {
        return $this->find()->where(['path' => $path])->first();
    }

}
