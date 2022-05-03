<?php

namespace App\Form;

use App\Entity\Offer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\OffersType;
use App\Entity\Department;

class OfferType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('job_name')
            ->add('description')
            ->add('tasks')
            ->add('week_hours_number')
            ->add('town')
            ->add('address')
            ->add('company')
            ->add('experience')
            // ->add('active')
            ->add('offers_type', EntityType::class, [
                'class' => OffersType::class,
                'choice_label' => 'label',
            ])
            ->add('department', EntityType::class, [
                'class' => Department::class,
                'choice_label' => 'name',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Offer::class,
        ]);
    }
}
