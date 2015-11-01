<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Band Entity.
 *
 * @property int $id
 * @property string $band_name
 * @property string $genre
 * @property string $logo
 * @property \Cake\I18n\Time $created
 * @property \App\Model\Entity\Musician[] $musician
 */
class Band extends Entity
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
        'id' => false,
    ];
}
