<?php

namespace Proximity\LdapUserBundle\Security\User;

use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;

class LdapUserProvider implements UserProviderInterface
{
    public function loadUserByUsername($username)
    {
        // @todo: find a way to plug user function functionality

        // We're not even checking if the user exists because the version of of the ldap doesn't allow us to do so
        return new LdapUser($username);
    }

    public function refreshUser(UserInterface $user)
    {
        if (!$user instanceof LdapUser) {
            throw new UnsupportedUserException(
                sprintf('Instances of "%s" are not supported.', get_class($user))
            );
        }

        return $this->loadUserByUsername($user->getUsername());
    }

    public function supportsClass($class)
    {
        return $class === LdapUser::class;
    }

}