<?php

namespace Web\NavigateurBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * @Route("/navigateur")
 * Class NavigateurController
 * @package Web\NavigateurBundle\Controller
 */
class NavigateurController extends Controller
{


    /**
     * @Route ("/" ,name="navigateur_index")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        return $this->render('WebNavigateurBundle:Default:index.html.twig', array('name' => 'admin'));
    }

    /**
     * @Route ("/show",name="navidgateur_show")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showAction()
    {
        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('AnalaticaNavigateurBundle:Navigateur')->findAll();
        return $this->render('WebNavigateurBundle:Navigateur:showN.html.twig', array(
            'entities' => $entities));


    }
}