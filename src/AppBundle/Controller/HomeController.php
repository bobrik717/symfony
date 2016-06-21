<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class HomeController extends Controller
{
    /**
     * @Route("/test/{name}")
     *
     * @param $name
     * @return Response
     */
    public function testAction($name)
    {
        return $this->render('home/test.html.twig',[
            'name' => $name,
        ]);
    }

    /**
     * @Route("/test/{name}/text",name="site_show_text")
     * @Method("GET")
     *
     * @param $name
     * @return JsonResponse
     */
    public function getTextAction($name)
    {
        $texts = [
            ['id' => 1, 'username' => 'AquaPelham', 'avatarUri' => '/images/leanna.jpeg', 'note' => 'Octopus asked me a riddle, outsmarted me', 'date' => 'Dec. 10, 2015'],
            ['id' => 2, 'username' => 'AquaWeaver', 'avatarUri' => '/images/ryan.jpeg', 'note' => 'I counted 8 legs... as they wrapped around me', 'date' => 'Dec. 1, 2015'],
            ['id' => 3, 'username' => 'AquaPelham', 'avatarUri' => '/images/leanna.jpeg', 'note' => 'Inked!', 'date' => 'Aug. 20, 2015'],
        ];

        $data = [
            'texts' => $texts
        ];

        return new JsonResponse($data);
    }

    /**
     * @Route("/")
     *
     * @param $name
     * @return Response
     */
    public function indexAction($name)
    {
        return $this->render('home/index.html.twig', [
            'name' => $name]
        );
    }
}
