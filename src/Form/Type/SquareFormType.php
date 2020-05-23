<?php

declare(strict_types = 1);

namespace App\Form\Type;

use App\Entity\Square;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SquareFormType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
          ->add(
            'latitudeA',
            NumberType::class,
            ['label'  => 'Latitude']
          )
          ->add(
            'longitudeA',
            NumberType::class,
            ['label'  => 'Longitude']
          )
          ->add(
            'latitudeB',
            NumberType::class,
            ['label'  => 'Latitude']
          )
          ->add(
            'longitudeB',
            NumberType::class,
            ['label'  => 'Longitude'],
          )
          ->add(
            'submit',
            SubmitType::class,
            ['label'  => 'Calculate'],
          );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(['data_class' => Square::class]);
    }

}