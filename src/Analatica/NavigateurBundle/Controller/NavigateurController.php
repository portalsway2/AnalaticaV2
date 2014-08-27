<?php

namespace Analatica\NavigateurBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Request\ParamFetcher;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations\QueryParam;
use Acme\DemoBundle\Form\ContactType;
use FOS\RestBundle\View\View;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Serializer;

/**
 * Navigateur controller.
 *
 */
class NavigateurController extends FOSRestController
{

    /**
     * Lists all Navigateur entities.
     *
     */
    public function getNavigateursAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AnalaticaNavigateurBundle:Navigateur')->findAll();

        $response = View::create()->setStatusCode(200)->setData(array('entities' => $entities,));
        return $this->getViewHandler()->handle($response);
    }

    /**
     * @param ParamFetcher $paramFetcher
     * @QueryParam(name="id")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getNavigateurAction(ParamFetcher $paramFetcher)
    {

        $id = $paramFetcher->get("id");
        $em = $this->getDoctrine()->getManager();
        $Navigateur = $em->getRepository('AnalaticaNavigateurBundle:Navigateur')->findById($id);

        $response = View::create()->setStatusCode(200)->setData(array("Navigateur" => $Navigateur));

        return $this->getViewHandler()->handle($response);
    }

    /**
     * @param ParamFetcher $paramFetcher
     * @QueryParam(name="id")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function putNavigateurAction(Request $request, ParamFetcher $paramFetcher)
    {
        $id = $paramFetcher->get("id");
        $em = $this->getDoctrine()->getManager();
        $normalizer = new GetSetMethodNormalizer();
        $encoder = new JsonEncoder();
        $serializer = new Serializer(array($normalizer), array($encoder));
        $Navigateur = $serializer->deserialize($request->getContent(), 'Analatica\NavigateurBundle\Entity\Navigateur', 'json');
        $Navigateur->setId($id);
        $em->flush();

        $response = View::create()->setStatusCode(200)->setData(array("Navigateur" => $Navigateur));

        return $this->getViewHandler()->handle($response);
    }

    /**
     * @param ParamFetcher $paramFetcher
     * @QueryParam(name="id")
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     */
    public function deleteNavigateurAction(ParamFetcher $paramFetcher)
    {
        $id = $paramFetcher->get("id");
        $em = $this->getDoctrine()->getManager();
        $Navigateur = $em->getRepository('Analatica\NavigateurBundle\Entity\Navigateur')->find($id);
        if (!$Navigateur) {
            $response = View::create()->setStatusCode(888)->setData(array("Navigateur" => "null"));

            return $this->getViewHandler()->handle($response);
        }
        $em->remove($Navigateur);
        $em->flush();

        $response = View::create()->setStatusCode(200)->setData(array("Navigateur" => null));

        return $this->getViewHandler()->handle($response);
    }

    /** * @return \FOS\RestBundle\View\ViewHandler */
    private function getViewHandler()
    {
        return $this->container->get('fos_rest.view_handler');
    }
}










