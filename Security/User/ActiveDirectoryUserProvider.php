<?php

namespace Proximity\ActiveDirectoryUserBundle\Security\User;

use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;

class ActiveDirectoryUserProvider implements UserProviderInterface
{
    public function loadUserByUsername($username)
    {
        // @todo: find a way to plug user function functionality
        // @todo: check if user exists

        return new ActiveDirectoryUser($username);
    }

    public function refreshUser(UserInterface $user)
    {
        if ( ! $user instanceof ActiveDirectoryUser) {
            throw new UnsupportedUserException(
                sprintf('Instances of "%s" are not supported.', get_class($user))
            );
        }

        return $this->loadUserByUsername($user->getUsername());
    }

    public function supportsClass($class)
    {
        return $class === ActiveDirectoryUser::class;
    }

}