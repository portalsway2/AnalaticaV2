<?php
namespace Analatica\OsBundle\Controller;

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

class OsController extends FOSRestController
{


    /**
     * @return View
     */
    public function getOssAction()
    {
        $em = $this->getDoctrine()->getManager();
        $Os = $em->getRepository('AnalaticaOsBundle:Os')->findAll();
        $response = View::create()->setStatusCode(200)->setData(array("Os" => $Os));

        return $this->getViewHandler()->handle($response);
    }

    /**
     * @param ParamFetcher $paramFetcher
     * @QueryParam(name="id")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getOsAction(ParamFetcher $paramFetcher)
    {

        $id = $paramFetcher->get("id");
        $em = $this->getDoctrine()->getManager();
        $Os = $em->getRepository('AnalaticaOsBundle:Os')->findById($id);

        $response = View::create()->setStatusCode(200)->setData(array("Os" => $Os));

        return $this->getViewHandler()->handle($response);
    }

    /**
     * @param ParamFetcher $paramFetcher
     * @QueryParam(name="id")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function putOsAction(Request $request, ParamFetcher $paramFetcher)
    {
        $id = $paramFetcher->get("id");
        $em = $this->getDoctrine()->getManager();
        $normalizer = new GetSetMethodNormalizer();
        $encoder = new JsonEncoder();
        $serializer = new Serializer(array($normalizer), array($encoder));
        $Os = $serializer->deserialize($request->getContent(), 'Analatica\OsBundle\Entity\Os','json');
        $Os->setId($id);
        $em->flush();

        $response = View::create()->setStatusCode(200)->setData(array("Os" => $Os));

        return $this->getViewHandler()->handle($response);
    }


    /**
     * @param ParamFetcher $paramFetcher
     * @QueryParam(name="id")
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     */
    public function deleteOsAction(ParamFetcher $paramFetcher)
    {
        $id=$paramFetcher->get("id");
        $em = $this->getDoctrine()->getManager();
        $Os = $em->getRepository('Analatica\OsBundle\Entity\Os')->find($id);
        if (!$Os) {
            $response = View::create()->setStatusCode(888)->setData(array("Os" => "null"));

            return $this->getViewHandler()->handle($response);
        }
        $em->remove($Os);
        $em->flush();

        $response = View::create()->setStatusCode(200)->setData(array("Os" => null));

        return $this->getViewHandler()->handle($response);
    }

    /** * @return \FOS\RestBundle\View\ViewHandler */
    private function getViewHandler()
    {
        return $this->container->get('fos_rest.view_handler');
    }
}
