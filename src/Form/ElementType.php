<?php

namespace App\Form;

use App\Entity\Element;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ElementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            //->add('spell', EntityType::class, [
            //    'choice_label' => 'name',
            //    'class' => Spell::class,
            //    'property_path' => 'spell',
            //    'multiple' => true,
            // ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Element::class,
        ]);
    }
}
