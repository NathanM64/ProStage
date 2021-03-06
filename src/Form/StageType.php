<?php

namespace App\Form;

use App\Entity\Entreprise;
use App\Entity\Stage;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use App\Form\EntrepriseType;
use App\Entity\Formations;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class StageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre', TextType::class)
            ->add('email', EmailType::class)
            ->add('descriptionMission', TextareaType::class)
            ->add('entreprise', EntrepriseType::class)
            ->add('formations', EntityType::class, ['class' => Formations::class,
                                                    'choice_label' => 'nomComplet',
                                                    'expanded' => true,
                                                    'multiple' => true])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Stage::class,
        ]);
    }
}
