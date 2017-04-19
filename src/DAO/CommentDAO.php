<?php
/**
 * Created by PhpStorm.
 * User: TonyMalto
 * Date: 19/04/2017
 * Time: 17:14
 */

namespace Alaska\DAO;

use Alaska\Entity\Comment;

class CommentDAO extends DAO
{
    /**
     * @var \Alaska\DAO\ArticleDAO
     */
    private $articleDAO;

    public function setArticleDAO(ArticleDAO $articleDAO) {
        $this->articleDAO = $articleDAO;
    }

    // Prend l'id d'un article et et renvoie une tableau d'objets Alaska\Entity\Comment qui lui sont associés
    public function findAllByArticle($articleId) {
        // find() ne retourne qu'une seule colonne de bdd
        $article = $this->articleDAO->find($articleId);

        // renvoie tous les articles ayant pour art_id l'id fourni en param de la fonction
        $sql = "select com_id, com_content, com_author from t_comment where art_id=? order by com_id";
        $query_result = $this->getDb()->fetchAll($sql, array($articleId));

        $comments = array();
        foreach ($query_result as $row) {
            $comId = $row['com_id'];
            $comment = $this->buildEntityObject($row);
            // The associated article is defined for the constructed comment
            $comment->setArticle($article);
            $comments[$comId] = $comment;
        }
        return $comments;
    }

    /**
     * Creates an Comment object based on a DB row.
     *
     * @param array $row The DB row containing Comment data.
     * @return \Alaska\Entity\Comment
     */
    public function buildEntityObject(array $row) {
        $comment = new Comment();
        $comment->setId($row['com_id']);
        $comment->setContent(($row['com_content']));
        $comment->setAuthor($row['com_author']);

        // grâce à l'article_id => retrouver l'article par son id grâce à méthode de ArticleDAO puis le setter comme
        // propriété de Ciomment
        if(array_key_exists('art_id', $row)) {
            $article_id = $row['art_id'];
            $article = $this->articleDAO->find($article_id);
            $comment->setArticle($article);
        }
        return $comment;
    }
}