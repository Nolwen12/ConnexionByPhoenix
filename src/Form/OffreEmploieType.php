<?php

namespace App\Form;

use App\Entity\Entreprise;
use App\Entity\OffreEmploie;
use App\Entity\TypeEmploie;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OffreEmploieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('mission')
            ->add('profil_rechercher')
            ->add('lieu')
            ->add('info')
            ->add('type_emploie', EntityType::class, [
                'class' => TypeEmploie::class,
                'choice_label' => 'id',
            ])
            ->add('entreprise', EntityType::class, [
                'class' => Entreprise::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => OffreEmploie::class,
        ]);
    }
}
