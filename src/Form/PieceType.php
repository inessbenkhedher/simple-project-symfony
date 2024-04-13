<?php

namespace App\Form;

use App\Entity\Piece;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\Montage;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class PieceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomPiece')
            ->add('quantite')
            ->add('unite')
            ->add('fournisseur')
            ->add('image')
            ->add('montage', EntityType::class, [
                'class' => Montage::class,
                'choice_label' => 'nomMontage',
            ])
            
    
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Piece::class,
        ]);
    }
}
