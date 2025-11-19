<?php

namespace App\Form;

use App\Entity\Thumbnail;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ThumbnailType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('image', null, [
                'label' => 'Image (URL ou chemin relatif)',
                'attr' => [
                    'placeholder' => 'Entrez l\'URL ou le chemin relatif de l\'image',
                ],
                'row_attr' => [
                    'class' => 'form-floating mb-3',
                ],
            ])
            ->add('information', null, [
                'label' => 'Information / Note explicative',
                'attr' => [
                    'placeholder' => 'Entrez des informations supplémentaires sur l\'image',
                    'style' => 'height: 100px;',
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
            'data_class' => Thumbnail::class,
        ]);
    }
}
