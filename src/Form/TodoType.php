<?php

namespace App\Form;

use App\Entity\Todo;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class TodoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'attr' => ['class' => 'form-control', 'style' => 'margin-bottom:15px']
            ])
            ->add('category', TextType::class, [
                'attr' => ['class' => 'form-control', 'style' => 'margin-bottom:15px']
            ])
            ->add('description', TextType::class, [
                'attr' => ['class' => 'form-control', 'style' => 'margin-bottom:15px']
            ])
            ->add('priority', ChoiceType::class, [
                'choices' => ['Low' => 'Low', 'Normal' => 'Normal', 'High' => 'High'],
                'attr' => ['class' => 'form-control', 'style' => 'margin-bottom:15px']
            ])
            ->add('due_date', DateTimeType::class, [
                'attr' => ['style' => 'margin-bottom:15px']
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Create task',
                'attr' => ['class' => 'btnCreate', 'style' => 'margin-bottom:15px']
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Todo::class,
        ]);
    }
}

// ->add('create_date')