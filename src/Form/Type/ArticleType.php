<?php
/**
 * Created by PhpStorm.
 * User: TonyMalto
 * Date: 29/05/2017
 * Time: 16:15
 */

namespace Alaska\Form\Type;


use Alaska\Form\Model\ArticleModel;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;



class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, array(
                'label' => 'Titre'
            ))
            ->add('content', TextareaType::class, array(
                'label' => 'Corps de l\'article'
            ))
            ->add('imageToUpload',  FileType::class, array(
                'label' => 'image associée',
                'required' => false,
                'constraints' => new Assert\File(array('mimeTypes' => array('image/jpg', 'image/jpeg', 'image/png')))
            ))
            ->add('chapitre', IntegerType::class, array(
                'label' => 'Numéro de chapitre'
            ))
            ->add('image', TextType::class, array('attr' =>
                array('read_only' => true), 'required' => false
            ));

    }

    public function getName()
    {
        return 'article';
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => ArticleModel::class,
        ));
    }


}