<?php
/**
 * Created by PhpStorm.
 * User: TonyMalto
 * Date: 19/04/2017
 * Time: 14:48
 */

function getArticles() {
    $bdd = new PDO('mysql:host=localhost;dbname=Alaska;charset=utf8', 'root', 'root');
    $articles = $bdd->query('select * from t_article order by art_id desc');
    return $articles;
}