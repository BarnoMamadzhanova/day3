<?php

namespace App\Form;

use App\Entity\Todo;
use App\Entity\Status;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints\File;

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
            ->add('image', FileType::class, [
                'label' => 'Task image',
                'attr' => ['class' => 'form-control', 'style' => 'margin-bottom:15px'],

                // unmapped means that this field is not associated to any entity property
                'mapped' => false,

                // make it optional so you don't have to re-upload the PDF file
                // every time you edit the Product details
                'required' => true,

                // unmapped fields can't define their validation using attributes
                // in the associated entity, so you can use the PHP constraint classes
                'constraints' => [
                    new File([
                        'maxSize' => '1024k',
                        'mimeTypes' => [
                           'image/png',
                           'image/jpeg',
                           'image/jpg',
                       ],
                       'mimeTypesMessage' => 'Please upload a valid image file',
                    ])
                ],
            ])
            ->add('priority', ChoiceType::class, [
                'choices' => ['Low' => 'Low', 'Normal' => 'Normal', 'High' => 'High'],
                'attr' => ['class' => 'form-control', 'style' => 'margin-bottom:15px']
            ])
            ->add('fk_status', EntityType::class, [
                'class' => Status::class,
                'choice_label' => 'name',
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