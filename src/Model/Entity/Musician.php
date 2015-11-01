<?php
namespace App\Model\Entity;

use Cake\Auth\DefaultPasswordHasher;
use Cake\ORM\Entity;

/**
 * Musician Entity.
 *
 * @property string $username
 * @property int $band_id
 * @property \App\Model\Entity\Band $band
 * @property string $password
 * @property string $first_name
 * @property string $last_name
 * @property \Cake\I18n\Time $dob
 * @property string $portrait
 * @property string $email
 * @property int $contact_number
 * @property int $post_code
 * @property \Cake\I18n\Time $joined
 */
class Musician extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'username' => true,
    ];


    protected function _setPassword($value) {
        $hasher = new DefaultPasswordHasher();
        return $hasher->hash($value);
    }
}
