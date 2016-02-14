<?php

namespace Proximity\LdapUserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('ProximityLdapUserBundle:Default:index.html.twig');
    }
}
