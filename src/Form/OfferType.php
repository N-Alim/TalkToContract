<?php

namespace App\Form;

use App\Entity\Offer;
use App\Entity\Skill;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\OffersType;
use App\Entity\Department;
use App\Entity\SubCategory;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;


class OfferType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('job_name', TextType::class, [
                'label' => 'Nom du poste',
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description',
            ])
            ->add('subCategory', EntityType::class, [
                'class' => SubCategory::class,
                'choice_label' => 'name',
                'label' => "Sous-catégorie",
            ])
            ->add('tasks', TextareaType::class, [
                'label' => 'Tâches',
            ])
            ->add('week_hours_number', NumberType ::class, [
                'label' => 'Nombre d\'heures par semaine',
            ])
            ->add('town', TextType::class, [
                'label' => 'Ville',
            ])
            ->add('address', TextareaType::class, [
                'label' => 'Addresse',
            ])
            ->add('company', TextType::class, [
                'label' => 'Entreprise',
            ])
            ->add('experience', NumberType ::class, [
                'label' => 'Nombre d\'années d\'expériences requises',
            ])
            // ->add('active')
            ->add('offers_type', EntityType::class, [
                'class' => OffersType::class,
                'choice_label' => 'label',
                'label' => "Type d'offre"
            ])
            ->add('department', EntityType::class, [
                'class' => Department::class,
                'choice_label' => 'name',
                'label' => "Département"
            ]);
            // ->add('skills', EntityType::class, [
            //     'class' => Skill::class,
            //     'choice_label' => 'name',
            //     'label' => "Compétences",
            //     'multiple' => true
            // ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Offer::class,
        ]);
    }
}
