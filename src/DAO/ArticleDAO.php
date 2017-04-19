<?php

/**
 * Created by PhpStorm.
 * User: TonyMalto
 * Date: 19/04/2017
 * Time: 15:21
 */

namespace Alaska\DAO;

use Doctrine\DBAL\Connection;
use Alaska\Entity\Article;

class ArticleDAO
{
    private $db;

    public function __construct(Connection $db)
    {
        $this->db = $db;
    }

    // findAll() renvoie un array d'objets Alaska/Entity/Article
    /**
     * Return a list of all articles, sorted by date (most recent first).
     *
     * @return array A list of all articles.
     */
    public function findAll() {
        $sql = "select * from t_article order by art_id desc";
        $fetch_result = $this->db->fetchAll($sql);

        // Converti $fetch_result en tableau d'objets Alaska/Entity/Article
        $articles = array();
        foreach($fetch_result as $row) {
            $articleId = $row['art_id'];
            $articles[$articleId] = $this->buildEntityObject($row);
        }
        return $articles;
    }


    // buildEntityObject() prend une entrée de la table t_articles et renvoie un objet Alaska\Entity\Article
    /**
     * Creates an Article object based on a DB row.
     *
     * @param array $row The DB row containing Article data.
     * @return \Alaska\Entity\Article
     */
    public function buildEntityObject(array $row) {
        $article = new Article();
        $article->setId($row['art_id']);
        $article->setTitle($row['art_title']);
        $article->setContent($row['art_content']);
        return $article;
    }


}