<?php

namespace App\Form;

use App\Entity\Entreprise;
use App\Entity\SecteurActivite;
use App\Entity\StatutEntreprise;
use App\Entity\TailleEntreprise;
use App\Entity\Users;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EntrepriseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('nationalite')
            ->add('activite')
            ->add('type')
            ->add('champs_action')
            ->add('statut', EntityType::class, [
                'class' => StatutEntreprise::class,
                'choice_label' => 'id',
            ])
            ->add('taille', EntityType::class, [
                'class' => TailleEntreprise::class,
                'choice_label' => 'id',
            ])
            ->add('secteur_activite', EntityType::class, [
                'class' => SecteurActivite::class,
                'choice_label' => 'id',
            ])
            ->add('user', EntityType::class, [
                'class' => Users::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Entreprise::class,
        ]);
    }
}
