<?php

namespace Analatica\NavigateurBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    /*
     *
     */
    public function indexAction($name)
    {
        return $this->render('AnalaticaNavigateurBundle:Default:index.html.twig', array('name' => $name));
    }
}
