<?php
/**
 * Created by PhpStorm.
 * User: TonyMalto
 * Date: 29/05/2017
 * Time: 16:15
 */

namespace Alaska\Form\Type;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class)
            ->add('content', TextareaType::class);
    }

    public function getName()
    {
        return 'article';
    }
}