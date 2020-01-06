<?php

namespace App\Form;

use App\Entity\Equipement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\Panoplie;
use App\Entity\Ressource;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;


class EquipementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('price')
            ->add('panoplie', EntityType::class, [
                'choice_label' => 'name',
                'class' => Panoplie::class,
            ])
            ->add('ressources', EntityType::class, [
                'choice_label' => 'name',
                'class' => Ressource::class,
                'property_path' => 'ressources',
                'multiple' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Equipement::class,
        ]);
    }
}
