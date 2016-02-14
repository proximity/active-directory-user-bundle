Proximity Active Directory User Bundle
======================================

The ProximityActiveDirectoryUserBundle is a Symfony3 bundle that attempt to ease user authentication through Microsoft Active Directory.

## Documentation

 1. [Installation](/#Installation)
 2. [Usage](/#Usage)

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
