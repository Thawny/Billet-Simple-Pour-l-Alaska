<?php

/**
 * Created by PhpStorm.
 * User: TonyMalto
 * Date: 15/07/2017
 * Time: 11:35
 */

namespace Alaska\Form\Model;

class ArticleModel
{

    /**
     * Article id.
     *
     * @var integer
     */
    public $id;

    /**
     * Article title.
     *
     * @var string
     */
    public $title;

    /**
     * Article content.
     *
     * @var string
     */
    public $content;

    /**
     * @var
     *  @Assert\File(mimeTypes={ "image/jpeg" })
     */
    public $imageToUpload;

    /**
     * @var string
     */
    public $image;

    public $chapitre;


}