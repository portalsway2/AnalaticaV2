<?php

namespace Web\ForfaitBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * @Route("/forfait")
 * Class ForfaitController
 * @package Web\ForfaitBundle\Controller
 */
class ForfaitController extends Controller
{


    /**
     * @Route ("/" ,name="forfait_index")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        return $this->render('WebForfaitBundle:Default:index.html.twig', array('name' => 'dd'));
    }

    /**
     * @Route ("/show",name="forfait_show")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showAction()
    {

        return $this->redirect($this->generateUrl('get_forfaits'));

    }
}