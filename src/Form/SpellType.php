<?php

namespace App\Form;

use App\Entity\Spell;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Race;
use App\Entity\Element;


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
            ])
            ->add('elements', EntityType::class, [
                'choice_label' => 'name',
                'class' => Element::class,
                'property_path' => 'elements',
                'multiple' => true,
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
