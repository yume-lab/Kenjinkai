<?php
namespace App\Model\Table;

use App\Model\Entity\ThreadMessage;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\I18n\Time;

/**
 * ThreadMessages Model
 *
 * @property \Cake\ORM\Association\BelongsTo $CommunityThreads
 * @property \Cake\ORM\Association\BelongsTo $Users
 */
class ThreadMessagesTable extends Table
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

        $this->table('thread_messages');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('CommunityThreads', [
            'foreignKey' => 'thread_id',
            'joinType' => 'INNER'
        ]);
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
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('sequence', 'create')
            ->notEmpty('sequence');

        $validator
            ->allowEmpty('parent_sequence');

        $validator
            ->requirePresence('content', 'create')
            ->notEmpty('content');

        $validator
            ->requirePresence('ip_address', 'create')
            ->notEmpty('ip_address');

        $validator
            ->requirePresence('user_agent', 'create')
            ->notEmpty('user_agent');

        $validator
            ->requirePresence('posted', 'create')
            ->notEmpty('posted');

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
        $rules->add($rules->existsIn(['thread_id'], 'CommunityThreads'));
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        return $rules;
    }

    public function write($threadId, $data) {
        $defaults = [
            'thread_id' => $threadId,
            'posted' => new Time(),
            'is_deleted' => false,
            'sequence' => $this->__nextSequence($threadId)
        ];
        $record = array_merge($defaults, $data);
        $entiry = $this->newEntity($record);
        return $this->save($entiry);
    }

    public function messages($threadId) {
        return $this->find()
                    ->contain([
                        'Users' => function ($q) {
                            return $q->where(['Users.is_deleted' => false]);
                        },
                        'Users.UserProfiles',
                        'Users.UserImages' => function ($q) {
                            return $q->where(['UserImages.is_deleted' => false]);
                        }
                    ])
                    ->where(['thread_id' => $threadId])
                    ->order(['sequence' => 'DESC']);
    }

    public function __nextSequence($threadId) {
        $query = $this->find()->where(['thread_id' => $threadId]);
        $maxSequence = $query->max(function ($row) {
            return $row->sequence;
        });
        $nextSequence = 0;
        if (!empty($maxSequence)) {
            $nextSequence = $maxSequence->sequence;
        }
        return $nextSequence + 1;
    }
}
