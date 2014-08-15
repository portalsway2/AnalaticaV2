<?php

namespace Analatica\ForfaitBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {


        return $this->render('AnalaticaForfaitBundle:Default:index.html.twig', array('name' => $name));
    }
}
