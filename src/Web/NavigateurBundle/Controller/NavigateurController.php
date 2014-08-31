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
        $Navigateurs = $em->getRepository('AnalaticaNavigateurBundle:Navigateur')->findAll();
        $stat = array();
        $stat1 = array();
        foreach ($Navigateurs as $nav) {
            $var = array();
            $var1 = array();
            $resultFind = false;
            $resultFind1 = false;


            foreach ($stat1 as $index1 => $s1) {

                if ($s1[0] == $nav->getNavigateur()) {
                    $stat1[$index1][1] += 1;
                    $resultFind1 = true;
                };
            }
            if (!$resultFind1) {
                $var1[0] = $nav->getNavigateur();
                $var1[1] = 1;
                array_push($stat1, $var1);
            }

        }

        return $this->render('WebNavigateurBundle:show:index.html.twig', array("stat" => $stat1));


    }

}