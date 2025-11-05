<?php

namespace App\Form;

use App\Entity\Enigma;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EnigmaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', null, [
                'label' => 'Titre',
                'attr' => [
                    'placeholder' => 'Entrez le titre de l\'énigme',
                    'class' => 'form-control',
                ],
            ])
            ->add('description', null, [
                'label' => 'Description',
                'attr' => [
                    'placeholder' => 'Entrez la description de l\'énigme',
                    'class' => 'form-control',
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Enigma::class,
        ]);
    }
}
