<?php

namespace App\Form;

use App\Entity\Game;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GameType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', null, [
                'label' => 'Nom du jeu',
                'attr' => [
                    'placeholder' => 'Entrez le nom du jeu',
                ],
                'row_attr' => [
                    'class' => 'form-floating mb-3',
                ],
            ])
            ->add('welcomeMessage', null, [
                'label' => 'Message de bienvenue',
                'attr' => [
                    'placeholder' => 'Entrez le message de bienvenue',
                ],
                'row_attr' => [
                    'class' => 'form-floating mb-3',
                ],
            ])
            ->add('welcomeImage', null, [
                'label' => 'Image de bienvenue',
                'attr' => [
                    'placeholder' => 'Téléchargez l\'image de bienvenue',
                ],
                'row_attr' => [
                    'class' => 'form-floating mb-3',
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Game::class,
        ]);
    }
}
