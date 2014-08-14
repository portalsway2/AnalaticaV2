<?php

namespace Analatica\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('AnalaticaUserBundle:Default:index.html.twig', array('name' => $name));
    }
}
