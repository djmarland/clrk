<?php
namespace App\Infrastructure;

use App\Domain\Exception\ValidationException;
use Symfony\Component\Security\Core\Encoder\BasePasswordEncoder;

class PasswordEncoderProvider extends BasePasswordEncoder
{
    public function __construct()
    {

    }

    public function encodePassword($plain, $salt = '') {
        if (strlen($plain) < 6) {
            throw new ValidationException('Password must be at least 6 characters long');
        }
        if (in_array($plain, [
            '123456',
            'password'
        ])) {
            throw new ValidationException('You must choose a more secure password');
        }
        return password_hash($plain, PASSWORD_DEFAULT);
    }

    public function isPasswordValid($encoded, $plain, $salt = '') {
        return password_verify($plain, $encoded);
    }

}