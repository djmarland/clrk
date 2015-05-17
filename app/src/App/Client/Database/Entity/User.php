<?php

namespace App\Client\Database\Entity;

/**
 * @Entity
 * @Table(name="users")
 */
class User extends Entity
{
    /** @Column(type="string") */
    public $name;

    /** @Column(type="string") */
    public $email;

    /** @Column(type="string") */
    public $password_digest;

    /** @Column(type="boolean") */
    public $is_admin;
}
