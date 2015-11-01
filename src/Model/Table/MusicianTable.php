<?php
namespace App\Model\Table;

use App\Model\Entity\Musician;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Musician Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Band
 */
class MusicianTable extends Table
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

        $this->table('musician');
        $this->displayField('username');
        $this->primaryKey('username');

        $this->belongsTo('Band', [
            'foreignKey' => 'band_id'
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
            ->requirePresence('username', 'create')
            ->notEmpty('username');

        $validator
            ->requirePresence('password', 'create')
            ->notEmpty('password');

        $validator
            ->requirePresence('first_name', 'create')
            ->notEmpty('first_name');

        $validator
            ->requirePresence('last_name', 'create')
            ->notEmpty('last_name');

        $validator
            ->add('dob', 'valid', ['rule' => 'date'])
            ->allowEmpty('dob');

        $validator
            ->allowEmpty('portrait');

        $validator
            ->allowEmpty('bio');

        $validator
            ->allowEmpty('speciality');

        $validator
            ->add('email', 'valid', ['rule' => 'email'])
            ->requirePresence('email', 'create')
            ->notEmpty('email');

        $validator
            ->add('contact_number', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('contact_number');

        $validator
            ->add('post_code', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('post_code');

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
        $rules->add($rules->isUnique(['username']));
        $rules->add($rules->isUnique(['email']));
        $rules->add($rules->existsIn(['band_id'], 'Band'));
        return $rules;
    }
}
