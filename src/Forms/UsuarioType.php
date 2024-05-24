<?php

namespace App\Forms;

use App\Auth\Login\Domain\Model\Usuario;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UsuarioType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('usuario', TextType::class, [
                'attr' => ['class' => 'form-control mb-2']
            ])
            ->add('nombre', TextType::class, [
                'attr' => ['class' => 'form-control mb-2']
            ])
            ->add('password', PasswordType::class, [
                'attr' => ['class' => 'form-control mb-3']
            ])
            ->add('tiene_captcha', CheckboxType::class, [
                'required' => false,
                'label' => '¿Tiene captcha?',
                'attr' => ['class' => 'form-check-input mb-3']
            ])
            ->add('roles', TextType::class, [
                'mapped' => false,
                'required' => false,
                'attr' => [
                    'placeholder' => 'Comma separated roles'
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Usuario::class,
        ]);
    }
}
