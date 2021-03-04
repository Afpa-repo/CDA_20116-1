<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ResetPasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('new_password', RepeatedType::class, [ // RepeatedType pour avoir 2 champs liés, ils doivent correspondent
                'required' => true,
                'mapped' => false,
                'type' => PasswordType::class,
                'invalid_message' => 'Les mots de passe doivent êtres identiques',
            'first_options' =>
            [
                'label' => 'Nouveau mot de passe',
                'constraints'=> [new Regex ([
                    'pattern' => '/^[a-zA-Z0-9.-_,]+$/',
                    'message' => 'Caratère(s) non valide(s)'
                     ]),
                    new length (['min' =>5, 'max'=>30])],
            ],
        'second_options' =>
            [
                'label' => 'Confirmez votre Mot de passe',
                'constraints'=> [new Regex ([
                    'pattern' => '/^[a-zA-Z0-9.-_,]+$/',
                    'message' => 'Caratère(s) non valide(s)'
                     ]),
                    new length (['min' =>5, 'max'=>30])],
            ]
    ])
            ->add('submit', SubmitType::class, [
                'label' => 'Enregistrer'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
