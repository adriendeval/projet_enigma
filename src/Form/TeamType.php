<?php

namespace App\Form;

use App\Entity\Avatar;
use App\Entity\Team;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TeamType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', null, [
            'label' => 'Nom',
            'attr' => [
                'placeholder' => 'Entrez le nom de l\'équipe',
                'class' => 'form-control',
            ],
            'row_attr' => [
                'class' => 'form-floating mb-3',
            ],
            ])
            ->add('avatar', EntityType::class, [
            'class' => Avatar::class,
            'choice_label' => 'filename',
            'label' => 'Avatar',
            'placeholder' => false,
            'expanded' => true,
            'multiple' => false,
            'choice_attr' => function (Avatar $avatar) {
                return ['data-image-url' => $avatar->getFilename()];
            },
            'label_html' => true,
            'choice_label' => function (Avatar $avatar) {
                return sprintf('<img src="%s" alt="Avatar" style="width: 35px; height: 35px; object-fit: cover;">', $avatar->getFilename());
            },
            'row_attr' => ['class' => 'mb-3',
            ],
            ]);
        if ($options['is_logged_in']) {
            $builder
                ->add('position')
                ->add('currentEnigma')
                ->add('note');
        }
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Team::class,
            'is_logged_in' => false,
        ]);
    }
}
