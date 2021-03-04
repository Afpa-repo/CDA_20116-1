<?php
// Formulaire d'ajout ou de modification d'une adresse
namespace App\Form;

use App\Entity\Address;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\Regex;

class AddressType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Quel nom souhaitez-vous donner à votre adresse ?',
                'constraints' => [new Regex([
                    'pattern' => '/^[a-zA-Z0-9.-_,\s]+$/',
                    'message' => 'Caratère(s) non valide(s)'
                ])],
                'attr' => [
                    'placeholder' => 'Nommez votre adresse'
                ]
            ])
            ->add('firstname', TextType::class, [
                'label' => 'Votre prénom',
                'constraints' => [
                    new Regex([
                        'pattern' => '/^[A-Za-zéèàçâêûîôäëüïö\-\s]+$/',
                        'message' => 'Caratère(s) non valide(s)'
                    ]),
                    new Length(['min' => 2, 'max' => 30])
                ],
                'attr' => [
                    'placeholder' => 'Entre votre prénom'
                ]
            ])
            ->add('lastname', TextType::class, [
                'label' => 'Votre nom',
                'constraints' => [
                    new Regex([
                        'pattern' => '/^[A-Za-zéèàçâêûîôäëüïö\-\s]+$/',
                        'message' => 'Caratère(s) non valide(s)'
                    ]),
                    new Length(['min' => 2, 'max' => 30])
                ],
                'attr' => [
                    'placeholder' => 'Entrez votre nom'
                ]
            ])
            ->add('company', TextType::class, [
                'label' => 'Votre société (facultatif)',
                'constraints' => [new Regex([
                    'pattern' => '/^[a-zA-Z0-9.-_,\s]+$/',
                    'message' => 'Caratère(s) non valide(s)'
                ])],
                'required' => false,
                'attr' => [
                    'placeholder' => 'Entrez le nom de votre société'
                ]
            ])
            ->add('address', TextType::class, [
                'label' => 'Votre adresse',
                'constraints' => new Regex([
                    'pattern' => '/^[A-Za-z0-9,-\s]+$/',
                    'message' => 'Caratère(s) non valide(s)'
                ]),
                'attr' => [
                    'placeholder' => 'Entrez votre adresse'
                ]
            ])
            ->add('postal', TextType::class, [
                'label' => 'Votre code postal',
                'constraints' => new Regex([
                    'pattern' => '/^[0-9A-Z]{5,6}$/',
                    'message' => 'Caratère(s) non valide(s)'
                ]),
                'attr' => [
                    'placeholder' => 'Code Postal'
                ]
            ])
            ->add('city', TextType::class, [
                'label' => 'Ville',
                'constraints' => [new Regex([
                    'pattern' => '/^[a-zA-Z0-9.-_,\s]+$/',
                    'message' => 'Caratère(s) non valide(s)'
                ])],
                'attr' => [
                    'placeholder' => 'Entrez votre ville'
                ]
            ])
            ->add('country', CountryType::class, [
                'label' => 'Votre pays',
                'constraints' => [new Regex([
                    'pattern' => '/^[a-zA-Z\s]+$/',
                    'message' => 'Caratère(s) non valide(s)'
                ])],
                'attr' => [
                    'placeholder' => 'Entrez votre pays'
                ]
            ])
            ->add('phone', TextType::class, [
                'label' => 'Téléphone',
                'constraints' => new Regex([
                    'pattern' => '/^[0-9]{10}$/',
                    'message' => 'Caratère(s) non valide(s)'
                ]),
                'attr' => [
                    'placeholder' => 'Entrez votre numéro de téléphone'
                ]
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Valider',
                'attr' => [
                    'class' => 'btn-block btn-info'
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Address::class,
        ]);
    }
}
