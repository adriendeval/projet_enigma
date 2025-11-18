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
                    'placeholder' => 'Entrez le nom de l\'équipe'
                ],
                'row_attr' => [
                    'class' => 'form-floating mb-3',
                ],
            ])
            ->add('avatar', EntityType::class, [
                'class' => Avatar::class,
                'choice_label' => 'filename',
                'label' => 'Avatar',
                'placeholder' => 'Choisissez un avatar',
                'row_attr' => [
                    'class' => 'form-floating mb-3',
                ],
                'attr' => [
                    'class' => 'form-select',
                ],
            ]);
        if ($options['is_logged_in']) {
            $builder
                ->add('position')
                ->add('currentEnigma', null)
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
