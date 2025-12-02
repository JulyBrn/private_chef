<?php

namespace App\Form;

use App\Entity\Article;
use App\Entity\Menu;
use App\Entity\Plats;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MenuForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('plats', EntityType::class, array(
                'class'        => Plats::class,
                'expanded'     => true,
                'multiple'     => true,
                'by_reference' => false,
                'label'        => 'Ajouter des plats'
            ))
            ->add('newPlats', CollectionType::class, array(
              'entry_type'   => PlatsTypeForm::class,
              'allow_add'    => true,
              'allow_delete' => true,
              'by_reference' => false,
              'mapped'       => false,
              'label'        => false,
            ));
    }
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Menu::class,
        ]);
    }
}
