<?php
namespace Proximity\ActiveDirectoryUserBundle\Security\User;

use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\EquatableInterface;

class ActiveDirectoryUser implements UserInterface, EquatableInterface
{
    private $username;
    private $roles;

    public function __construct($username)
    {
        $this->username = $username;
    }

    public function getRoles()
    {
        return $this->roles;
    }

    public function getPassword()
    {
        return;
    }

    public function getSalt()
    {
        return;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function eraseCredentials()
    {
    }

    public function isEqualTo(UserInterface $user)
    {
        if (!$user instanceof ActiveDirectoryUser) {
            return false;
        }

        if ($this->username !== $user->getUsername()) {
            return false;
        }

        return true;
    }
}