<?php

namespace App\Form;

use App\Entity\Enigma;
use App\Entity\Type;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EnigmaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('position', EntityType::class, [
                'class' => Enigma::class,
                'choice_label' => 'position',
                'label' => 'Position dans la série d\'énigmes',
                'attr' => [
                    'class' => 'form-select mb-3',
                ],
            ])
            ->add('title')
            ->add('instruction')
            ->add('secretCode')
            ->add('type', EntityType::class, [
                'class' => Type::class,
                'choice_label' => 'label',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Enigma::class,
        ]);
    }
}
