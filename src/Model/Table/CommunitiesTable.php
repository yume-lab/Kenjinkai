<?php
namespace App\Model\Table;

use App\Model\Entity\Community;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Communities Model
 *
 * @property \Cake\ORM\Association\BelongsTo $CommunityStatuses
 * @property \Cake\ORM\Association\BelongsTo $Countries
 * @property \Cake\ORM\Association\BelongsTo $Kens
 * @property \Cake\ORM\Association\BelongsTo $Cities
 * @property \Cake\ORM\Association\BelongsTo $HometownCountries
 * @property \Cake\ORM\Association\BelongsTo $HometownKens
 * @property \Cake\ORM\Association\BelongsTo $HometownCities
 */
class CommunitiesTable extends Table
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

        $this->table('communities');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('CommunityStatuses', [
            'foreignKey' => 'community_status_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Countries', [
            'foreignKey' => 'country_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Kens', [
            'foreignKey' => 'ken_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Cities', [
            'foreignKey' => 'city_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('HometownCountries', [
            'foreignKey' => 'hometown_country_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('HometownKens', [
            'foreignKey' => 'hometown_ken_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('HometownCities', [
            'foreignKey' => 'hometown_city_id',
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
            ->requirePresence('name', 'create')
            ->notEmpty('name');

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
        $rules->add($rules->existsIn(['community_status_id'], 'CommunityStatuses'));
        $rules->add($rules->existsIn(['country_id'], 'Countries'));
        $rules->add($rules->existsIn(['ken_id'], 'Kens'));
        $rules->add($rules->existsIn(['city_id'], 'Cities'));
        $rules->add($rules->existsIn(['hometown_country_id'], 'HometownCountries'));
        $rules->add($rules->existsIn(['hometown_ken_id'], 'HometownKens'));
        $rules->add($rules->existsIn(['hometown_city_id'], 'HometownCities'));
        return $rules;
    }
}
