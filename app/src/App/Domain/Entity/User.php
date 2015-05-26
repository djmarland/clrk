<?php

namespace App\Domain\Entity;

use App\Domain\ValueObject\Email;
use App\Domain\ValueObject\ID;
use App\Domain\ValueObject\Password;
use DateTime;

/**
 * Class User
 * For describe users of the system
 */
class User extends Entity
{
    const KEY_PREFIX = 'U';

    /**
     * @param ID $id
     * @param DateTime $createdAt
     * @param DateTime $updatedAt
     * @param $name
     * @param Email $email
     * @param $passwordDigest
     * @param bool $passwordExpired
     * @param bool $isAdmin
     */
    public function __construct(
        ID $id,
        DateTime $createdAt,
        DateTime $updatedAt,
        $name,
        Email $email,
        $passwordDigest,
        $passwordExpired = false,
        $isAdmin = false
    ) {
        parent::__construct(
            $id,
            $createdAt,
            $updatedAt
        );

        $this->name = $name;
        $this->email = $email;
        $this->passwordExpired = $passwordExpired;

        // ensure the password is a string (will convert a Password object)
        $this->passwordDigest = (string) $passwordDigest;
    }

    /**
     * @var string
     */
    private $name;

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        if ($name != $this->name) {
            // @todo - validate not empty
            $this->name = $name;
            $this->updated();
        }
    }

    /**
     * @var string
     */
    private $email;

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail(Email $email)
    {
        if ((string) $email != (string) $this->email) {
            // @todo - validate not empty

            // @todo - reset the user to unconfirmed
            $this->email = $email;
            $this->updated();
        }
    }

    /**
     * @var integer
     */
    private $passwordDigest;

    /**
     * @return integer
     */
    public function getPasswordDigest()
    {
        return $this->passwordDigest;
    }

    /**
     * @param Password $newPassword
     * @return int
     */
    public function setPasswordDigest(Password $newPassword)
    {
        $this->passwordDigest = (string) $newPassword;
    }

    public function passwordMatches($match)
    {
        $matches =  password_verify($match, $this->passwordDigest);
       // if ($matches && password_needs_rehash($this->passwordDigest, PASSWORD_DEFAULT)) {
            //$password = new Password($match);
            //$this->setPasswordDigest($password);
            // @todo - save this'll need to move into the login controller to work
        // as it needs access to the service
       // }
        return $matches;
    }

    /**
     * @var boolean
     */
    private $passwordExpired = false;

    /**
     * @return boolean
     */
    public function passwordHasExpired()
    {
        return $this->passwordExpired;
    }

    public function expirePassword()
    {
        $this->passwordExpired = true;
    }

    public function renewPassword()
    {
        $this->passwordExpired = false;
    }

    /**
     * @var boolean
     */
    private $isAdmin = false;

    /**
     * @return boolean
     */
    public function isAdmin()
    {
        return $this->isAdmin;
    }

    public function makeAdmin()
    {
        $this->isAdmin = true;
        $this->updated();
    }

    public function revokeAdmin()
    {
        $this->isAdmin = false;
        $this->updated();
    }
}
