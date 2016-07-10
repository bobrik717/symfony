<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Home;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class HomeController extends Controller
{
    /**
     * @Route("/test/new")
     */
    public function newAction()
    {
        $text = new Home();
        $text->setName('new-text'.rand(1,100));
        $text->setSubFamaly('New SubFamaly');
        $text->setSpeciesCount(rand(100,9999));

        $em = $this->getDoctrine()->getManager();
        $em->persist($text);
        $em->flush();

        return new Response('<html><body>Text added</body></html>');
    }

    /**
     * @Route("/home")
     */
    public function listAction()
    {
        $em = $this->getDoctrine()->getManager();
        $text = $em->getRepository('AppBundle:Home')->findAllPublishedOrderBySize();

        return $this->render('home/list.html.twig',[
            'models' => $text,
        ]);
    }

    /**
     * @Route("/test/{name}", name="page_show")
     *
     * @param $name
     * @return Response
     */
    public function testAction($name)
    {
        $em = $this->getDoctrine()->getManager();
        $model = $em->getRepository('AppBundle:Home')->findOneBy(['name' => $name]);

        if(!$model){
            throw new NotFoundHttpException('Page dosn\'t exist');
        }
        /*
        $cache = $this->get('doctrine_cache.providers.my_markdown_cache');

        $key = md5($funFact);
        if($cache->contains($key)){
            $funFact = $cache->fetch($key);
        }else{
            $funFact = $this->get('markdown.parser')->transformMarkdown($funFact);
            $cache->save($key,$funFact);
        }
        */

        return $this->render('home/test.html.twig',[
            'model' => $model
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
            'texts' => $texts,
        ];

        return new JsonResponse($data);
    }

    /**
     * @return Response
     */
    public function indexAction()
    {
        return $this->render('home/index.html.twig', [
            //'name' => $name
            ]
        );
    }
}
