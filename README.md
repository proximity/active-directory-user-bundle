Proximity Active Directory User Bundle
======================================

The ProximityActiveDirectoryUserBundle is a Symfony3 bundle that attempt to ease user authentication through Microsoft Active Directory.

## Documentation

### Installation

#### Get the bundle using composer

The bundle is not yet deployed on packagist. Start by requiring the bundle to your composer.json file as vcs:

```json
// composer.json
{
    "require": {
        "proximity/active-directory-user-bundle": "dev-master"
    },
    "repositories" : [{
        "type" : "vcs",
        "url" : "https://github.com/proximity/active-directory-user-bundle.git"
    }]
}
```

#### Enable the bundle

Register the bundle in your application's kernel class:

```php
// app/AppKernel.php
public function registerBundles()
{
    $bundles = array(
        // ...
        new Proximity\ActiveDirectoryUserBundle\ProximityActiveDirectoryUserBundle(),
        // ...
    );
}
```

#### Configure your Active Directory details

Tell the bundle what parameters to use for accessing your Active Directory instance:

```yaml
# app/config/config.yml
# ...
proximity_active_directory_user:
    ldap_host: 'your.ldap.host'
    organizational_unit: 'Your OU'
    domain_components: [ 'acme_dc', 'another_dc' ]
```

#### Configure the security.yml to use the authenticator

```yaml
# app/config/security.yml
security:
    # ...
    firewalls:
        # ...
        default:
        # ...
            simple_form:
                authenticator: proximity_active_directory_user.authenticator
```

This bundle does not come with a user provider or any login functionality since creating a user entity is up to each project logic. Refer to the [Symfony doc](http://symfony.com/doc/current/cookbook/security/custom_provider.html).
