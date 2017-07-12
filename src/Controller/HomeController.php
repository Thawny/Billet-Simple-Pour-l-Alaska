<?php

/**
 * Created by PhpStorm.
 * User: TonyMalto
 * Date: 07/07/2017
 * Time: 11:51
 */

namespace Alaska\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Alaska\Entity\Article;
use Alaska\Entity\Comment;
use Alaska\Form\Type\CommentType;


class HomeController
{
    /**
     * Home page controller.
     *
     * @param Application $app Silex application
     */
    public function indexAction(Application $app) {
        $articles = $app['dao.article']->findAll();
        foreach ($articles as $article) {
            $raw_article = $article->getContent();
            $stripped_article = strip_tags($raw_article);
            $article->setContent($stripped_article);
        }
        return $app['twig']->render('home.html.twig', array('articles' => $articles));
    }

    /**
     * Article details controller.
     *
     * @param integer $id Article id
     * @param Request $request Incoming request
     * @param Application $app Silex application
     */
    public function articleAction($id, Request $request, Application $app) {
        $article = $app['dao.article']->find($id);
        $commentFormView = null;
        $comment = new Comment();
        $comment->setArticle($article);
        $commentForm = $app['form.factory']->create(CommentType::class, $comment);
        $commentForm->handleRequest($request);
        if ($commentForm->isSubmitted() && $commentForm->isValid()) {
            $app['dao.comment']->save($comment);
            $app['session']->getFlashBag()->add('success', 'Votre commentaire a été ajouté avec succès');
        }
        $commentFormView = $commentForm->createView();
        $comments = $app['dao.comment']->findAllByArticle($id);
        return $app['twig']->render('article.html.twig', array('article' => $article, 'comments' => $comments, 'commentForm' => $commentFormView));
    }

    /**
     * User login controller.
     *
     * @param Request $request Incoming request
     * @param Application $app Silex application
     */
    public function loginAction(Request $request, Application $app) {
        return $app['twig']->render('login.html.twig', array(
            'error'         => $app['security.last_error']($request),
            'last_username' => $app['session']->get('_security.last_username'),
        ));
    }



}