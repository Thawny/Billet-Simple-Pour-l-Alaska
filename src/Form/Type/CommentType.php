<?php

/**
 * Created by PhpStorm.
 * User: TonyMalto
 * Date: 24/04/2017
 * Time: 12:36
 */

namespace Alaska\Form\Type;

use \Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;


class CommentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('content', TextareaType::class);
        $builder->add('author', TextType::class);
    }

    public function getName()
    {
        return 'comment';
    }
}