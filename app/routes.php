<?php
/**
 * Created by PhpStorm.
 * User: TonyMalto
 * Date: 19/04/2017
 * Time: 15:03
 */

$app->get('/', function() use($app) {
    $articles = $app['dao.article']->findAll();

    ob_start();             // start buffering HTML output
    require '../views/view.php';
    $view = ob_get_clean(); // assign HTML output to $view
    return $view;
});