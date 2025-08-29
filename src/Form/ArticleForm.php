<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
             ->add('imageFile', FileType::class, ['label'=> 'Image', 'required' => false])
            ->add('subtitle', TextType::class, ['label'=> 'Tag'])
            ->add('title', TextType::class, ['required' => true, 'label'=> 'Titre'])
            ->add('text', TextareaType::class, ['required' => true]);
            // ->add('modifier', SubmitType::class, ['label' => 'Modifier']);
        
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
