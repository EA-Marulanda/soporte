<?php

namespace App\Forms\Soporte;

use App\Soporte\Dominio\Entidades\Soporte;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;

class SoporteType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {


        $builder
            ->add('cedula', IntegerType::class, [
                'attr' => ['class' => 'form-control mb-2'],
                'constraints' => [
                    new Length([
                        'max' => 10,
                        'maxMessage' => 'La cédula no puede tener más de {{ limit }} dígitos.'
                    ])
                ]
            ])
            ->add('nombre', TextType::class, [
                'attr' => ['class' => 'form-control mb-2'],
                'constraints' => [
                    new Regex([
                        'pattern' => '/^[a-zA-Z\s]+$/',
                        'message' => 'El nombre solo puede contener letras y espacios.'
                    ]),
                    new Length([
                        'min' => 5,
                        'max' => 50,
                        'minMessage' => 'El nombre debe tener al menos {{ limit }} caracteres.',
                        'maxMessage' => 'El nombre no puede tener más de {{ limit }} caracteres.'
                    ])
                ]
            ])
            ->add('correo', EmailType::class, [
                'attr' => ['class' => 'form-control mb-3'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'La contraseña no puede estar en blanco.',
                    ]),
                    new Length([
                        'min' => 15,
                        'minMessage' => 'La contraseña debe tener al menos {{ limit }} caracteres.',
                    ]),
                ],
            ])
            ->add('prioridad', ChoiceType::class, [
                'choices' => [
                    '1' => 1,
                    '2' => 2,
                    '3' => 3,
                    '4' => 4,
                    '5' => 5,
                ],
                'attr' => ['class' => 'form-control form-select mb-2'],
            ])
            ->add('asunto', TextType::class, [
                'attr' => ['class' => 'form-control mb-2'],
                'constraints' => [
                    new Length([
                        'min' => 10,
                        'max' => 50,
                        'minMessage' => 'El usuario debe tener al menos {{ limit }} caracteres.',
                        'maxMessage' => 'El usuario no puede tener más de {{ limit }} caracteres.'
                    ])
                ]
            ])
            ->add('descripcion', TextareaType::class, [
                'attr' => ['class' => 'form-control mb-2'],
                'constraints' => [
                    new Length([
                        'min' => 15,
                        'max' => 150,
                        'minMessage' => 'El usuario debe tener al menos {{ limit }} caracteres.',
                        'maxMessage' => 'El usuario no puede tener más de {{ limit }} caracteres.'
                    ])
                ]
            ]);
    }


}
