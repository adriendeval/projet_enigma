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
            ->add('position')
            ->add('currentEnigma')
            ->add('note')
            ->add('avatar', EntityType::class, [
                'class' => Avatar::class,
                'choice_label' => 'filename',
                'label' => 'Avatar',
                'placeholder' => 'Choisissez un avatar',
                'row_attr' => [
                    'class' => 'mb-3',
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Team::class,
        ]);
    }
}
