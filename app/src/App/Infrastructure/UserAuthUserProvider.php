<?php
namespace App\Infrastructure;

use App\Domain\Entity\User;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;

class UserAuthUserProvider implements UserProviderInterface
{

    private $serviceFactory;

    public function __construct(ServiceFactory $serviceFactory)
    {
        $this->serviceFactory = $serviceFactory;
    }

    public function loadUserByUsername($email)
    {
        $user = $this->serviceFactory->createService('users')
            ->findByEmail($email);

        if ($user) {
            return $user;
        }

        throw new UsernameNotFoundException(
            'No such user with this e-mail address'
        );
    }

    public function refreshUser(UserInterface $user)
    {
        if (!$user instanceof User) {
            throw new UnsupportedUserException(
                sprintf('Instances of "%s" are not supported.', get_class($user))
            );
        }

        return $this->loadUserByUsername($user->getUsername());
    }

    public function supportsClass($class)
    {
        return $class === 'App\Domain\Entity\User';
    }
}