<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
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
        $texts = [
            'adsf sad fasdf asdf asdf asdf asd',
            'asdf safd safdsfdaasfd 34434  sdf',
            'sdaf323 234 23 we qwer q32 32 23 s'
        ];
        return $this->render('home/test.html.twig',[
            'name' => $name,
            'texts' => $texts
        ]);
    }

    public function indexAction($name)
    {
        return $this->render('', array('name' => $name));
    }
}
