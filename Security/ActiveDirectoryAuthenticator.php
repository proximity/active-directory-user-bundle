<?php

namespace Proximity\ActiveDirectoryUserBundle\Security;

use Symfony\Component\Debug\Exception\ContextErrorException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Authentication\SimpleFormAuthenticatorInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class ActiveDirectoryAuthenticator implements SimpleFormAuthenticatorInterface
{

    const LDAP_CONN_STRING = 'CN=%s,OU=Proximity WGN,DC=nz,DC=local';

    private $ldapHost;

    public function setHost($host)
    {
        $this->ldapHost = $host;
    }

    public function authenticateToken(TokenInterface $token, UserProviderInterface $userProvider, $providerKey)
    {
        try {
            $user = $userProvider->loadUserByUsername($token->getUsername());
        } catch (UsernameNotFoundException $e) {
            throw new AuthenticationException('Invalid username or password');
        }

        // Load from ldap
        $ds = ldap_connect($this->ldapHost);
        $dn = sprintf(self::LDAP_CONN_STRING, $user->getUsername());
        try {
            if (ldap_bind($ds, $dn, $token->getCredentials())) {


                return new UsernamePasswordToken(
                    $user,
                    $token->getCredentials(),
                    $providerKey,
                    $user->getRoles()
                );
            }
        } catch (ContextErrorException $e) {
            // Do nothing, the AuthenticationException will be thrown anyway
        } finally {
            ldap_close($ds);
        }

        // If none work, throw AuthenticationException
        throw new AuthenticationException('Invalid username or password');
    }

    public function supportsToken(TokenInterface $token, $providerKey)
    {
        return $token instanceof UsernamePasswordToken
               && $token->getProviderKey() === $providerKey;
    }

    public function createToken(Request $request, $username, $password, $providerKey)
    {
        return new UsernamePasswordToken($username, $password, $providerKey);
    }
}
