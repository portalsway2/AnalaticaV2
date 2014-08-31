<?php

namespace Web\OsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('WebOsBundle:Default:index.html.twig', array('name' => $name));
    }
}
