<?php
/**
 * Created by PhpStorm.
 * User: TonyMalto
 * Date: 19/04/2017
 * Time: 15:03
 */

use \Symfony\Component\HttpFoundation\Request;
use Alaska\Form\Type\CommentType;

$app->get('/', function() use($app) {
    $articles = $app['dao.article']->findAll();

    foreach ($articles as $article) {
        $string = $article->getContent();
        $short_string = substr($string, 0, 780);
        $short_string = $short_string . "...";
        $article->setContent($short_string);
    }

    return $app['twig']->render('home.html.twig', array('articles' => $articles));

})->bind('home');

$app->match('/article/{id}', function($id, Request $request) use ($app) {
    $article = $app['dao.article']->find($id);
    $commentFormView = null;
    $comment = new \Alaska\Entity\Comment();
    $comment->setArticle($article);
    $commentForm = $app['form.factory']->create(CommentType::class, $comment);
    $commentForm->handleRequest($request);
    if ($commentForm->isSubmitted() && $commentForm->isValid()) {
        $app['dao.comment']->save($comment);
        $app['session']->getFlashBag()->add('success', 'your comment was successfully added');
    }
    $commentFormView = $commentForm->createView();
    $comments = $app['dao.comment']->findAllByArticle($id);
    return $app['twig']->render('article.html.twig', array('article' => $article, 'comments' => $comments, 'commentForm' => $commentFormView));
})->bind('article');

//login form
$app->get('/login', function (Request $request) use ($app) {
    return $app['twig']->render('login.html.twig', array(
        'error'         => $app['security.last_error']($request),
        'last_username' => $app['session']->get('_security.last_username'),
    ));
})->bind('login');