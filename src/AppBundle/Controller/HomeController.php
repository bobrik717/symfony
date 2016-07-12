<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Home;
use AppBundle\Entity\HomeNotes;
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

        $note = new HomeNotes();
        $note->setUsername('AquaWeaver');
        $note->setAvatar('ryan.jpeg');
        $note->setNote('I counted 8 legs... as they wrapped around me');
        $note->setCreatedAt(new \DateTime('-1 month'));
        $note->setHome($text);

        $em = $this->getDoctrine()->getManager();
        $em->persist($text);
        $em->persist($note);
        $em->flush();

        return new Response('<html><body>Text added</body></html>');
    }

    /**
     * @Route("/home")
     */
    public function listAction()
    {
        $em = $this->getDoctrine()->getManager();
        $text = $em->getRepository('AppBundle:Home')->findAllPublishedOrderRecentlyActive();

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

        $countNotes = $em->getRepository('AppBundle:HomeNotes')
            ->findAllRecentNotesForHome($model);

        return $this->render('home/test.html.twig',[
            'model' => $model,
            'count' => count($countNotes),
        ]);
    }

    /**
     * @Route("/test/{name}/text",name="site_show_text")
     * @Method("GET")
     *
     * @param Home $home
     * @return JsonResponse
     */
    public function getTextAction(Home $home)
    {
        $texts = [];
        foreach($home->getNotes() as $note){
            $texts[] = [
                'id' => $note->getId(),
                'username' => $note->getUsername(),
                'avatarUri' => '/images/' . $note->getAvatar(),
                'note' => $note->getNote(),
                'date' => $note->getCreatedAt()->format('Y-m-d')
            ];
        }

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
