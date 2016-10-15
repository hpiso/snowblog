<?php

namespace AppBundle\Controller\Front;

use AppBundle\Entity\Article;
use AppBundle\Entity\Comment;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bridge\PhpUnit\TextUI\Command;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\CommentType;

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
    public function showAction(Request $request, Article $article)
    {
        $em = $this->getDoctrine()->getManager();
        $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);

        $form->handleRequest($request);

        if ($form->isValid()) {

            $comment->setArticle($article);
            $em->persist($comment);
            $em->flush();

            $this->addFlash('notice', 'Your comment has been sent. It\'s going to be approved by an administrator');

            return $this->redirectToRoute('front_article_show', ['slug' => $article->getSlug()]);
        }

        $comments = $em->getRepository('AppBundle:Comment')->findBy(['enabled' => false], ['date' => 'DESC']);// todo change false

        return $this->render('AppBundle:Front/Article:show.html.twig', array(
            'article'  => $article,
            'form'     => $form->createView(),
            'comments' => $comments
        ));
    }
}
