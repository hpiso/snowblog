<?php

namespace AppBundle\Controller\Front;

use AppBundle\Entity\Article;
use AppBundle\Entity\Comment;
use AppBundle\Entity\Snowboarder;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bridge\PhpUnit\TextUI\Command;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\CommentType;

/**
 * @Route("/snowboarders")
 */
class SnowboarderController extends Controller
{
    /**
     * @Route("/", name="snowboarders_all")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $snowboarders = $em->getRepository('AppBundle:Snowboarder')->findAll();

        return $this->render('AppBundle:Front/Snowboarder:index.html.twig', [
            'snowboarders' => $snowboarders
        ]);
    }

    /**
     * @Route("/show/{id}", name="snowboarders_show")
     */
    public function showAction(Request $request, Snowboarder $snowboarder)
    {
        return $this->render('AppBundle:Front/Snowboarder:show.html.twig', [
            'snowboarder' => $snowboarder
        ]);
    }
}
