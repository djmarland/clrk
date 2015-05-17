<?php
/**
 * Doctrine! Why must you force Annotations upon us!?
 * At least its usage is self-contained in this Client section
 */

namespace App\Client\Database\Entity;

/** @MappedSuperclass */
abstract class Entity
{
    /** @Id @Column(type="integer") @GeneratedValue */
    public $id;

    /** @Column(type="datetime") */
    public $updated_at;

    /** @Column(type="datetime") */
    public $created_at;
}
