<?php

namespace Web\NavigateurBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('WebNavigateurBundle:Default:index.html.twig', array('name' => $name));
    }
}
