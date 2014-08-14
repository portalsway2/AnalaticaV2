<?php

namespace Analatica\OsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('AnalaticaOsBundle:Default:index.html.twig', array('name' => $name));
    }
}
