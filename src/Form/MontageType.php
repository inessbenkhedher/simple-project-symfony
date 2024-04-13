<?php

namespace App\Form;

use App\Entity\Montage;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class MontageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('nomMontage')
        ->add('client')
        ->add('created_At', DateTimeType::class, [
            'widget' => 'single_text',
            'html5' => true,
            'attr' => ['class' => 'form-control', 'style' => 'border-color: #f39c12;'],
        ])
        ->add('cout')
        ->add('image')
      
        ->add('valider',SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Montage::class,
        ]);
    }
}
