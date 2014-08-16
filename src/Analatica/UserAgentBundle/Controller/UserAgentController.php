<?php
namespace Analatica\UserAgentBundle\Controller;

use Analatica\NavigateurBundle\Entity\Navigateur;
use Analatica\OsBundle\Entity\Os;
use Analatica\UserAgentBundle\Entity\Info;
use Analatica\UserAgentBundle\Entity\UserAgent;
use Analatica\UserBundle\Entity\User;
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

class UserAgentController extends FOSRestController

{


    private function ConverterOs(UserAgent $userAgent)
    {

        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AnalaticaRegexBundle:RegexOs')->findAll();

        $convert = "false";
        $version = "null";
        $os = "null";

        /** @var  $agent UserAgent */
        $agent=$userAgent;

        foreach ($entities as $entiy) {

            if (preg_match($entiy->getRegex(), $agent->getUserAgent(), $mot)) {

                $convert = "true";
                $os = $mot[0];
                $version = $mot[1];
                $Os=new Os();
                $Os->setSystem($os);
                $Os->setVersion($version);
                $Os->setIdUserAgent($userAgent);
                $em->persist($Os);
                $em->flush();
                break;

            }
        }

        return array(

            "convert" => $convert,
            "version" => $version,
            "os" => $os

        );

    }



    // Navigateur
    private function ConverterBrowser(UserAgent $userAgent)
    {

        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AnalaticaRegexBundle:RegexBrowsers')->findAll();

        $convert = "false";
        $version = "null";
        $navigateur = "null";

        /** @var  $agent UserAgent */
        $agent=$userAgent;

        foreach ($entities as $entiy) {

            if (preg_match($entiy->getRegexbrowsers(), $agent->getUserAgent(), $mot)) {


                $convert = "true";
                $navigateur = $mot[0];
                $version = $mot[1];

                $Navigateur=new Navigateur();
                $Navigateur->setNavigateur($navigateur);
                $Navigateur->setVersion($version);
                $Navigateur->setIdUserAgent($userAgent);
                $em->persist($Navigateur);
                $em->flush();

            }


        }

        return array(

            "convert" => $convert,
            "version" => $version,
            "navigateur" => $navigateur

        );

    }
    private function verifyUser($token)
    {
        $em = $this->getDoctrine()->getManager();

        $user = $em->getRepository('AnalaticaUserBundle:User')->findByToken( $token);
        return $user[0];

    }

    private function SaveUserAgent($content, $user)
    {
        $em = $this->getDoctrine()->getManager();
        $normalizer = new GetSetMethodNormalizer();

        $encoder = new JsonEncoder();
        $serializer = new Serializer(array($normalizer), array($encoder));
        /** @var  $userAgent UserAgent */
        $userAgent = $serializer->deserialize($content, 'Analatica\UserAgentBundle\Entity\UserAgent', 'json');
        $userAgent->setIdUser($user);
        $em->persist($userAgent);
        $em->flush();
        return $userAgent;


    }


    private function saveInfo($UserAgent, $Info)
    {

        $em = $this->getDoctrine()->getManager();
        $normalizer = new GetSetMethodNormalizer();
        $encoder = new JsonEncoder();
        $serializer = new Serializer(array($normalizer), array($encoder));
        /** @var  $Info Info */
        $Info = $serializer->deserialize($Info, 'Analatica\UserAgentBundle\Entity\Info', 'json');

        $Info->setUserAgent($UserAgent);
        $em->persist($Info);
        $em->flush();
        return $Info;
    }

    public function postSaveUserAgentAction(Request $request)
    {


        $headers = $request->headers;
        $contentUserAgent = $request->get("UserAgent");
        $contentInfo = $request->get("Info");

        $user = $this->container->get('security.context')->getToken()->getUser();

        $userAgent = $this->SaveUserAgent(json_encode($contentUserAgent), $user);
        $ResultConvertB=$this->ConverterBrowser($userAgent);
            $ResultConvert=$this->ConverterOs($userAgent);
        $Ip = $this->saveInfo($userAgent, json_encode($contentInfo));


        $response = View::create()->setStatusCode(200)->setData(

            array(
                "userAgents" => $userAgent,
                "Navigateur"=>$ResultConvertB,
                "Os"=>$ResultConvert


            ));

        return $this->getViewHandler()->handle($response);
    }

    /**
     * @return View
     */
    public function getUserAgentsAction()
    {
        $em = $this->getDoctrine()->getManager();
        $userAgent = $em->getRepository('AnalaticaUserAgentBundle:UserAgent')->findAll();

        $response = View::create()->setStatusCode(200)->setData(array("userAgents" => $userAgent));

        return $this->getViewHandler()->handle($response);
    }

    /**
     * @param ParamFetcher $paramFetcher
     * @QueryParam(name="id")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getUserAgentAction(ParamFetcher $paramFetcher)
    {

        $id = $paramFetcher->get("id");
        $em = $this->getDoctrine()->getManager();
        $userAgent = $em->getRepository('AnalaticaUserAgentBundle:UserAgent')->findById($id);

        $response = View::create()->setStatusCode(200)->setData(array("userAgents" => $userAgent));

        return $this->getViewHandler()->handle($response);
    }

    /**
     * @param ParamFetcher $paramFetcher
     * @QueryParam(name="id")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function putUserAgentAction(Request $request, ParamFetcher $paramFetcher)
    {
        $id = $paramFetcher->get("id");
        $em = $this->getDoctrine()->getManager();
        $normalizer = new GetSetMethodNormalizer();

        $encoder = new JsonEncoder();
        $serializer = new Serializer(array($normalizer), array($encoder));
        $userAgent = $serializer->deserialize($request->getContent(), 'Analatica\UserAgentBundle\Entity\UserAgent', 'json');
        $userAgent->setId($id);
        $em->flush();

        $response = View::create()->setStatusCode(200)->setData(array("userAgents" => $userAgent));

        return $this->getViewHandler()->handle($response);
    }


    /**
     * @param ParamFetcher $paramFetcher
     * @QueryParam(name="id")
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     */
    public function deleteUserAgentAction(ParamFetcher $paramFetcher)
    {
        $id = $paramFetcher->get("id");
        $em = $this->getDoctrine()->getManager();
        $UserAgent = $em->getRepository('Analatica\UserAgentBundle\Entity\UserAgent')->find($id);
        if (!$UserAgent) {
            $response = View::create()->setStatusCode(888)->setData(array("userAgents" => "null"));

            return $this->getViewHandler()->handle($response);
        }
        $em->remove($UserAgent);
        $em->flush();

        $response = View::create()->setStatusCode(200)->setData(array("userAgents" => null));

        return $this->getViewHandler()->handle($response);
    }

    /**
     *
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function postUsersAgentsAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $normalizer = new GetSetMethodNormalizer();
        $encoder = new JsonEncoder();
        $serializer = new Serializer(array($normalizer), array($encoder));
        $userAgent = $serializer->deserialize($request->getContent(), 'Analatica\UserAgentBundle\Entity\UserAgent', 'json');
        $em->persist($userAgent);
        $em->flush();
        $response = View::create()->setStatusCode(200)->setData(array("userAgents" => $userAgent));

        return $this->getViewHandler()->handle($response);
    }

    /** * @return \FOS\RestBundle\View\ViewHandler */
    private function getViewHandler()
    {
        return $this->container->get('fos_rest.view_handler');

    }

}