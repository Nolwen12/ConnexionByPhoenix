<?php

namespace App\Form;

use App\Entity\DemandeurEmploie;
use App\Entity\Formation;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FormationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom_ecole')
            ->add('diplome')
            ->add('date_debut')
            ->add('date_fin')
            ->add('adresse')
            ->add('cp')
            ->add('ville')
            ->add('demandeur_emploie', EntityType::class, [
                'class' => DemandeurEmploie::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Formation::class,
        ]);
    }
}
