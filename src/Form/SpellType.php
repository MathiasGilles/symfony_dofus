<?php

namespace App\Form;

use App\Entity\Race;
use App\Entity\Spell;
use App\Entity\Element;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;


class SpellType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('description')
            ->add('race', EntityType::class, [
                'choice_label' => 'name',
                'class' => Race::class,
                'property_path' => 'race',
                'multiple' => true,
                'expanded' => true,
            ])
            ->add('element', EntityType::class, [
                'choice_label' => 'name',
                'class' => Element::class,
                'property_path' => 'element',
                'multiple' => true,
                'expanded' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Spell::class,
        ]);
    }
}
