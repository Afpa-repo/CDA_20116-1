<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use function Sodium\add;

class ModifyPasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName', TextType::class, [
                'label' => 'Prénom',
                'disabled' => true
            ])
            ->add('lastName', TextType::class, [
                'label' => 'Nom',
                'disabled' => true
            ])
            ->add('phone', TextType::class, [
                'label' => 'Téléphone',
                'disabled' => true
            ])
            ->add('email', EmailType::class, [
                'label' => 'Email',
                'disabled' => true
            ])
            ->add('old_password', PasswordType::class, [
                'label' => 'Mot de passe actuel',
                'required' => true,
                'mapped' => false
            ])
            ->add('new_password', RepeatedType::class, [
                'required' => true,
                'mapped' => false,
                'type' => PasswordType::class,
                'invalid_message' => 'Les mots de passe doivent êtres identiques',
                'first_options' =>
                [
                    'label' => 'Nouveau mot de passe'
                ],
                'second_options' =>
                [
                    'label' => 'Confirmer votre mot de passe'
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
            'data_class' => User::class,
        ]);
    }
}
