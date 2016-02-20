<?php
namespace App\Model\Table;

use App\Model\Entity\CommunitySetting;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CommunitySettings Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Communities
 */
class CommunitySettingsTable extends Table
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

        $this->table('community_settings');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Communities', [
            'foreignKey' => 'community_id',
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
            ->integer('gender')
            ->allowEmpty('gender');

        $validator
            ->integer('lower_age')
            ->allowEmpty('lower_age');

        $validator
            ->integer('upper_age')
            ->allowEmpty('upper_age');

        $validator
            ->requirePresence('column_name', 'create')
            ->notEmpty('column_name');

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
        $rules->add($rules->existsIn(['community_id'], 'Communities'));
        return $rules;
    }
}
