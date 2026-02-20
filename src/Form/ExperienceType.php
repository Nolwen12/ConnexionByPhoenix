<?php

namespace App\Form;

use App\Entity\DemandeurEmploie;
use App\Entity\Experience;
use App\Entity\TypeEmploie;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ExperienceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom_poste')
            ->add('nom_entreprise')
            ->add('date_debut')
            ->add('date_fin')
            ->add('adresse')
            ->add('cp')
            ->add('ville')
            ->add('type_emploie', EntityType::class, [
                'class' => TypeEmploie::class,
                'choice_label' => 'id',
            ])
            ->add('demandeur_emploie', EntityType::class, [
                'class' => DemandeurEmploie::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Experience::class,
        ]);
    }
}
