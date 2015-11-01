<?php
namespace App\Model\Table;

use App\Model\Entity\Instrument;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Instrument Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Musician
 */
class InstrumentTable extends Table
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

        $this->table('instrument');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Musician', [
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
            ->requirePresence('type', 'create')
            ->notEmpty('type');

        $validator
            ->requirePresence('make', 'create')
            ->notEmpty('make');

        $validator
            ->requirePresence('model', 'create')
            ->notEmpty('model');

        $validator
            ->add('year', 'valid', ['rule' => 'numeric'])
            ->requirePresence('year', 'create')
            ->notEmpty('year');

        $validator
            ->allowEmpty('portrait');

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
        $rules->add($rules->existsIn(['user_id'], 'Musician'));
        return $rules;
    }
}
