<?php

/**
 * Created by PhpStorm.
 * User: TonyMalto
 * Date: 19/04/2017
 * Time: 15:21
 */

namespace Alaska\DAO;

use Alaska\Entity\Article;

class ArticleDAO extends DAO
{

    // findAll() renvoie un array d'objets Alaska/Entity/Article
    /**
     * Return a list of all articles, sorted by date (most recent first).
     *
     * @return array A list of all articles.
     */
    public function findAll() {
        $sql = "select * from t_article order by art_id desc";
        $fetch_result = $this->getDb()->fetchAll($sql);

        // Converti $fetch_result en tableau d'objets Alaska/Entity/Article
        $articles = array();
        foreach($fetch_result as $row) {
            $articleId = $row['art_id'];
            $articles[$articleId] = $this->buildEntityObject($row);
        }
        return $articles;
    }


    /**
     * @param $id
     * @return Article
     * @throws \Exception
     */
    public function find($id) {
        $sql = "select * from t_article where art_id=?";
        $row = $this->getDb()->fetchAssoc($sql, array($id));

        if ($row)
            return $this->buildEntityObject($row);
        else
            throw new \Exception("No article matching id " . $id);
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
        $article->setImage($row['art_image']);
        $article->setChapitre($row['art_chapitre']);
        return $article;
    }


    /**
     * Saves an article into the database.
     *
     * @param \Alaska\Entity\Article $article The article to save
     */
    public function save(Article $article) {
        $articleData = array(
            'art_title' => $article->getTitle(),
            'art_content' => $article->getContent(),
            'art_image' => $article->getImage(),
            'art_chapitre' => $article->getChapitre()
        );

        if ($article->getId()) {
            // The article has already been saved : update it
            $this->getDb()->update('t_article', $articleData, array('art_id' => $article->getId()));
        } else {
            // The article has never been saved : insert it
            $this->getDb()->insert('t_article', $articleData);
            // Get the id of the newly created article and set it on the entity.
            $id = $this->getDb()->lastInsertId();
            $article->setId($id);
        }
    }

    /**
     * Removes an article from the database.
     *
     * @param integer $id The article id.
     */
    public function delete($id) {
        // Delete the article

        $this->getDb()->delete('t_article', array('art_id' => $id));
    }


    public function getArticleImageById($id) {
        $sql = "select art_image from t_article where art_id=?";
        $row = $this->getDb()->fetchAssoc($sql, array($id));

    }




}