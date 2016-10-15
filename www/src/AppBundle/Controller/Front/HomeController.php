<?php

namespace AppBundle\Controller\Front;

use AppBundle\Entity\Article;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class HomeController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $articles = $em->getRepository('AppBundle:Article')->findBy(['enabled' => true], ['createdAt' => 'DESC']);

        return $this->render('AppBundle:Front/Home:index.html.twig', [
            'articles' => $articles
        ]);
    }

    /**
     * Finds and displays a Article entity.
     *
     * @Route("/{slug}", name="front_article_show")
     */
    public function showAction(Article $article)
    {
        return $this->render('AppBundle:Front/Article:show.html.twig', array(
            'article' => $article,
        ));
    }
}
