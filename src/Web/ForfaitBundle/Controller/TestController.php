<?php

namespace Web\ForfaitBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @Route("/yyy")
 */
class TestController extends Controller
{
    /**
     * @Route ("/rsir" ,name="popo")
     */
    public function indexAction($name)
    {
        return $this->render('WebForfaitBundle:Default:index.html.twig', array('name' => $name));
    }

    /**
     * @Route ("/sss" ,name="popo")
     */
    public function testAction()
    {

    }
}
