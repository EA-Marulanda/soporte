<?php

namespace App\Forms;

use App\Auth\Login\Domain\Model\Usuario;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;

class UsuarioType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $roles = $options['roles'];

        $builder
            ->add('usuario', TextType::class, [
                'attr' => ['class' => 'form-control mb-2'],
                'constraints' => [
                    new Length([
                        'min' => 3,
                        'max' => 15,
                        'minMessage' => 'El usuario debe tener al menos {{ limit }} caracteres.',
                        'maxMessage' => 'El usuario no puede tener más de {{ limit }} caracteres.'
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
            ->add('password', PasswordType::class, [
                'attr' => ['class' => 'form-control mb-3'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'La contraseña no puede estar en blanco.',
                    ]),
                    new Length([
                        'min' => 5,
                        'minMessage' => 'La contraseña debe tener al menos {{ limit }} caracteres.',
                    ]),
                ],
            ])
            ->add('tiene_captcha', CheckboxType::class, [
                'required' => false,
                'label' => '¿Tiene captcha?',
                'attr' => ['class' => 'form-check-input mb-3']
            ])
            ->add('rol', ChoiceType::class, [
                'choices' => $roles,
                'choice_label' => function ($rol) {
                    return $rol->getName();
                },
                'attr' => ['class' => 'form-control form-select mb-2'],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Usuario::class,
            'roles' => [],
        ]);
    }
}
