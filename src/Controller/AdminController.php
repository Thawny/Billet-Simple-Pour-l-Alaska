<?php
/**
 * Created by PhpStorm.
 * User: TonyMalto
 * Date: 07/07/2017
 * Time: 14:21
 */

namespace Alaska\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Alaska\Entity\Article;
use Alaska\Entity\User;
use Alaska\Form\Type\ArticleType;
use Alaska\Form\Type\CommentType;
use Alaska\Form\Type\UserType;


class AdminController
{
    /**
     * Admin home page controller.
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
        $comments = $app['dao.comment']->findAll();
        $users = $app['dao.user']->findAll();
        return $app['twig']->render('admin.html.twig', array(
            'articles' => $articles,
            'comments' => $comments,
            'users' => $users));
    }

    /**
     * Add article controller.
     *
     * @param Request $request Incoming request
     * @param Application $app Silex application
     */
    public function addArticleAction(Request $request, Application $app) {
        $article = new Article();
        $articleForm = $app['form.factory']->create(ArticleType::class, $article);
        $articleForm->handleRequest($request);
        if ($articleForm->isSubmitted() && $articleForm->isValid()) {

            if ($article->getImage()) {
                $file = $article->getImage();

                $imageName = md5(uniqid()).'.'.$file->guessExtension();

                $file->move(
                    'uploads',
                    $imageName
                );

                $article->setImage($imageName);

            }

            $app['dao.article']->save($article);
            $app['session']->getFlashBag()->add('success', 'The article was successfully created.');

            return $app->redirect($app['url_generator']->generate('admin'));

        }
        return $app['twig']->render('article_form.html.twig', array(
            'title' => 'Nouvel Article',
            'articleForm' => $articleForm->createView()));
    }

    /**
     * Edit article controller.
     *
     * @param integer $id Article id
     * @param Request $request Incoming request
     * @param Application $app Silex application
     */
    public function editArticleAction($id, Request $request, Application $app) {
        $article = $app['dao.article']->find($id);
        $articleForm = $app['form.factory']->create(ArticleType::class, $article);
        $articleForm->handleRequest($request);
        if ($articleForm->isSubmitted() && $articleForm->isValid()) {
            $app['dao.article']->save($article);
            $app['session']->getFlashBag()->add('success', 'The article was successfully updated.');
        }
        return $app['twig']->render('article_form.html.twig', array(
            'title' => 'Edit article',
            'articleForm' => $articleForm->createView()));
    }
}