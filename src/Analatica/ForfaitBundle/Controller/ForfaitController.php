<?php
namespace Analatica\ForfaitBundle\Controller;

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

class ForfaitController extends FOSRestController
{


    /**
     * @return View
     */
    public function getForfaitsAction()
    {
        $em = $this->getDoctrine()->getManager();
        $Forfait = $em->getRepository('AnalaticaForfaitBundle:Forfait')->findAll();
        $response = View::create()->setStatusCode(200)->setData(array("Forfait" => $Forfait));

        return $this->getViewHandler()->handle($response);
    }

    /**
     * @param ParamFetcher $paramFetcher
     * @QueryParam(name="id")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getForfaitAction(ParamFetcher $paramFetcher)
    {

        $id = $paramFetcher->get("id");
        $em = $this->getDoctrine()->getManager();
        $Forfait = $em->getRepository('AnalaticaForfaitBundle:Forfait')->findById($id);

        $response = View::create()->setStatusCode(200)->setData(array("Forfait" => $Forfait));

        return $this->getViewHandler()->handle($response);
    }

    /**
     * @param ParamFetcher $paramFetcher
     * @QueryParam(name="id")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function putForfaitAction(Request $request, ParamFetcher $paramFetcher)
    {
        $id = $paramFetcher->get("id");
        $em = $this->getDoctrine()->getManager();
        $normalizer = new GetSetMethodNormalizer();
        $encoder = new JsonEncoder();
        $serializer = new Serializer(array($normalizer), array($encoder));
        $Forfait = $serializer->deserialize($request->getContent(), 'Analatica\ForfaitBundle\Entity\Forfait','json');
        $Forfait->setId($id);
        $em->flush();

        $response = View::create()->setStatusCode(200)->setData(array("Forfait" => $Forfait));

        return $this->getViewHandler()->handle($response);
    }


    /**
     * @param ParamFetcher $paramFetcher
     * @QueryParam(name="id")
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     */
    public function deleteForfaitAction(ParamFetcher $paramFetcher)
    {
        $id=$paramFetcher->get("id");
        $em = $this->getDoctrine()->getManager();
        $Forfait = $em->getRepository('Analatica\ForfaitBundle\Entity\Forfait')->find($id);
        if (!$Forfait) {
            $response = View::create()->setStatusCode(888)->setData(array("Forfait" => "null"));

            return $this->getViewHandler()->handle($response);
        }
        $em->remove($Forfait);
        $em->flush();

        $response = View::create()->setStatusCode(200)->setData(array("Forfait" => null));

        return $this->getViewHandler()->handle($response);
    }
    /**
     *
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function postForfaitsAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $normalizer = new GetSetMethodNormalizer();
        $encoder = new JsonEncoder();
        $serializer = new Serializer(array($normalizer), array($encoder));
        $Forfait = $serializer->deserialize($request->getContent(), 'Analatica\ForfaitBundle\Entity\Forfait', 'json');
        $em->persist($Forfait);
        $em->flush();
        $response = View::create()->setStatusCode(200)->setData(array("Forfait" => $Forfait));

        return $this->getViewHandler()->handle($response);
    }

    /** * @return \FOS\RestBundle\View\ViewHandler */
    private function getViewHandler()
    {
        return $this->container->get('fos_rest.view_handler');
    }
}
