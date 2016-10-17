<?php

namespace AppBundle\Controller\Admin;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DashboardController extends Controller
{
    /**
     * @Route("/", name="homepage_admin")
     */
    public function indexAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $articles   = $em->getRepository('AppBundle:Article')->findAll();
        $categories = $em->getRepository('AppBundle:Category')->findAll();
        $comments   = $em->getRepository('AppBundle:Comment')->findAll();
        $commentsToApproved   = $em->getRepository('AppBundle:Comment')->findBy(['enabled' => false]);

        return $this->render('AppBundle:Admin/Dashboard:index.html.twig', [
            'comments'   => $comments,
            'articles'   => $articles,
            'categories' => $categories,
            'commentsToApproved' => $commentsToApproved,
        ]);
    }
}
