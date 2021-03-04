<?php
// Formulaire d'inscription - User()
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
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\Regex;

class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName',TextType::class,[
                'label' => 'Prénom',
                'constraints'=> [new Regex ([
                    'pattern' => '/^[A-Za-zéèàçâêûîôäëüïö\-\s]+$/',
                    'message' => 'Caratère(s) non valide(s)'
                ]),
                new Length (['min' =>2, 'max'=>30])],
                'attr' => [                     // Pour Mettre les options qu'on mettrait en attribut dans le formulaire HTML
                    'placeholder' => 'Camille',
                    'required' => true
                ]
            ])
            ->add('lastName', TextType::class, [
                'label' => 'Nom',
                'constraints'=> [new Regex ([
                    'pattern' => '/^[A-Za-zéèàçâêûîôäëüïö\-\s]+$/',
                    'message' => 'Caratère(s) non valide(s)'
                ]),
                new length (['min' =>2, 'max'=>30])],
                'attr' => [
                    'placeholder' => 'Dupont',
                    'required' => true
                ]
            ])
            ->add('phone', TextType::class, [
                'label' => 'Téléphone',
                'constraints'=> new Regex ([
                    'pattern' => '/^[0-9]{10}$/',
                    'message' => 'Caratère(s) non valide(s)'
                ]),
                'required' => false,
                'attr' => [
                    'placeholder' => '(facultatif)',
                ]
            ])
            ->add('email', RepeatedType::class, [
                'type' => EmailType::class,
                'label' => 'Email',
                'invalid_message' => 'Vos emails doivent êtres identiques',
                'required' => true,
                'first_options' =>
                    [
                    'label' => 'Email',
                    'constraints'=> [new Regex ([
                        'pattern' => '/^[a-zA-Z0-9.-_]+[@]{1}[a-zA-Z0-9.-_]+[.]{1}[a-z]{2,5}$/',
                        'message' => 'Caratère(s) non valide(s)'
                         ]),
                        new length (['min' =>5, 'max'=>30])],
                    'attr' =>
                        [
                        'placeholder' => 'camille.dupont@me.net'
                        ]
                    ],
                'second_options' =>
                    [
                        'label' => 'Confirmez votre Email',
                        'constraints'=> [new Regex ([
                            'pattern' => '/^[a-zA-Z0-9.-_]+[@]{1}[a-zA-Z0-9.-_]+[.]{1}[a-z]{2,5}$/',
                            'message' => 'Caratère(s) non valide(s)'
                             ]),
                            new length (['min' =>5, 'max'=>30])],
                        'attr' =>
                            [
                                'placeholder' => 'camille.dupont@me.net'
                            ]
                    ]
            ])
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'label' => 'Mot de Passe',
                'invalid_message' => 'Vos mots de passe doivent êtres identiques',
                'required' => true,
                'first_options' =>
                    [
                        'label' => 'Mot de passe',
                        'constraints'=> [new Regex ([
                            'pattern' => '/^[a-zA-Z0-9.-_,]+$/',
                            'message' => 'Caratère(s) non valide(s)'
                             ]),
                            new length (['min' =>5, 'max'=>30])],
                        'attr' =>
                            [
                                'placeholder' => '*******'
                            ]
                    ],
                'second_options' =>
                    [
                        'label' => 'Confirmez votre Mot de passe',
                        'constraints'=> [new Regex ([
                            'pattern' => '/^[a-zA-Z0-9.-_,]+$/',
                            'message' => 'Caratère(s) non valide(s)'
                             ]),
                            new length (['min' =>5, 'max'=>30])],
                        'attr' =>
                            [
                                'placeholder' => '*******'
                            ]
                    ]
            ])
            ->add('submit', SubmitType::class,[
                'label' => 'Inscription'
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
