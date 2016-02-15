Proximity Active Directory User Bundle
======================================

The ProximityActiveDirectoryUserBundle is a Symfony3 bundle that attempt to ease user authentication through Microsoft Active Directory.

## Documentation

### Installation

#### Get the bundle using composer

The bundle is not yet deployed on packagist. Start by requiering the bundle to your composer.json file as vcs:

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
imports:
    # ...
    - { resource: '@ProximityActiveDirectoryUserBundle/Resources/config/security.xml' }
    # ...
proximity_active_directory_user:
    ldap_host: 'your.ldap.host'
    organizational_unit: 'Your OU'
    domain_components: [ 'acme_dc', 'another_dc' ]
```

#### Configure the security.yml

```yaml
# app/config/security.yml
security:
    # ...

    providers:
        active_directory:
            id: proximity_active_directory_user.user_provider
    # use the authenticator for your firewall. Example with simple_form:
    firewalls:
        # ...
        default:
        # ...
            simple_form:
                authenticator: proximity_active_directory_user.authenticator
```
