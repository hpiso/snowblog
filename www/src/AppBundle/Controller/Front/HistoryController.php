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
require_once('sparqllib.php');

/**
 * @Route("/histories")
 */
class HistoryController extends Controller
{
    /**
     * @Route("/", name="histories_all")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $histories = $em->getRepository('AppBundle:History')->findAll();

        return $this->render('AppBundle:Front/History:index.html.twig', [
            'histories' => $histories
        ]);
    }
}
