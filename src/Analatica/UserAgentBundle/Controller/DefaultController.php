<?php

namespace Analatica\UserAgentBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        $em = $this->getDoctrine()->getManager();
        $userAgent = $em->getRepository('AnalaticaUserAgentBundle:UserAgent')->findAll();
        return $userAgent;
    }
}
