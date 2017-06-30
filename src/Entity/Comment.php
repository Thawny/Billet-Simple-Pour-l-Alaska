<?php
/**
 * Created by PhpStorm.
 * User: TonyMalto
 * Date: 19/04/2017
 * Time: 17:13
 */

namespace Alaska\Entity;


class Comment
{
    /**
     * Comment id.
     *
     * @var integer
     */
    private $id;

    /**
     * Comment author.
     *
     * @var string
     */
    private $author;

    /**
     * Comment content.
     *
     * @var integer
     */
    private $content;

    /**
     * Associated article.
     *
     * @var \Alaska\Entity\Article
     */
    private $article;

    /**
     * Associated comments
     *
     * @var array
     */
    private $responseComments;

    private $parentCommentId;


    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function getAuthor() {
        return $this->author;
    }

    public function setAuthor($author) {
        $this->author = $author;
        return $this;
    }

    public function getContent() {
        return $this->content;
    }

    public function setContent($content) {
        $this->content = $content;
        return $this;
    }

    public function getArticle() {
        return $this->article;
    }

    public function setArticle(Article $article) {
        $this->article = $article;
        return $this;
    }

    /**
     * @return array
     */
    public function getResponseComments()
    {
        return $this->responseComments;
    }


    public function setResponseComments($responseComments)
    {
        $this->responseComments = $responseComments;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getParentCommentId()
    {
        return $this->parentCommentId;
    }

    /**
     * @param mixed $parentCommentId
     */
    public function setParentCommentId($parentCommentId)
    {
        $this->parentCommentId = $parentCommentId;
    }
}