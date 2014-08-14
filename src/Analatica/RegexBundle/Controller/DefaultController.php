<?php

namespace Analatica\RegexBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('AnalaticaRegexBundle:Default:index.html.twig', array('name' => $name));
    }
}
