<?php

namespace AppBundle\Controller\Front;

use AppBundle\Entity\Article;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * SideBar controller.
 *
 * @Route("/side-bar")
 */
class SideBarController extends Controller
{
    /**
     * @Route("/categories", name="side_bar_categories")
     */
    public function categoriesAction()
    {
        $em = $this->getDoctrine()->getManager();
        $categories = $em->getRepository('AppBundle:Category')->findAll();

        return $this->render('AppBundle:Front/Sidebar:categories.html.twig', [
            'categories' => $categories
        ]);
    }

    /**
     * Finds and displays a Article entity.
     *
     * @Route("/recent-post", name="side_bar_recent_posts")
     */
    public function recentPostsAction()
    {
        $em = $this->getDoctrine()->getManager();
        $articles = $em->getRepository('AppBundle:Article')->findBy(['enabled' => true], ['createdAt' => 'DESC'], 5);

        return $this->render('AppBundle:Front/Sidebar:recent-posts.html.twig', array(
            'articles' => $articles,
        ));
    }
}
