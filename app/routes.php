<?php
/**
 * Created by PhpStorm.
 * User: TonyMalto
 * Date: 19/04/2017
 * Time: 15:03
 */

use \Symfony\Component\HttpFoundation\Request;
use Alaska\Entity\Article;
use Alaska\Entity\Comment;
use Alaska\Form\Type\ArticleType;
use Alaska\Form\Type\CommentType;
use Alaska\Entity\User;
use Alaska\Form\Type\UserType;


$app->get('/', 'Alaska\Controller\HomeController::indexAction'
)->bind('home');

$app->match('/article/{id}', 'Alaska\Controller\HomeController::articleAction'
)->bind('article');

//login form
$app->get('/login', 'Alaska\Controller\HomeController::loginAction'
)->bind('login');


$app->get('/admin', 'Alaska\Controller\AdminController::indexAction'
)->bind('admin');




// ADMIN

// Add a new article
$app->match('/admin/article/add', 'Alaska\Controller\AdminController::addArticleAction'
)->bind('admin_article_add');



// Edit an existing article
$app->match('/admin/article/{id}/edit', 'Alaska\Controller\AdminController::editArticleAction'
)->bind('admin_article_edit');



// Remove an article
$app->get('/admin/article/{id}/delete', 'Alaska\Controller\AdminController::deleteArticleAction'
)->bind('admin_article_delete');



// Edit an existing comment
$app->match('/admin/comment/{id}/edit', 'Alaska\Controller\AdminController::editCommentAction'
)->bind('admin_comment_edit');



// Remove a comment
$app->get('/admin/comment/{id}/delete', 'Alaska\Controller\AdminController::deleteCommentAction'
)->bind('admin_comment_delete');




// Add a user
$app->match('/admin/user/add', 'Alaska\Controller\AdminController::addUserAction'
)->bind('admin_user_add');

// Edit an existing user
$app->match('/admin/user/{id}/edit', 'Alaska\Controller\AdminController::editUserAction'
)->bind('admin_user_edit');

// Remove a user
$app->get('/admin/user/{id}/delete', 'Alaska\Controller\AdminController::deleteUserAction'
)->bind('admin_user_delete');