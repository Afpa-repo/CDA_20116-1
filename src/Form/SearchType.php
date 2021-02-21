<?php

namespace App\Form;

use App\Classe\Search;
use App\Entity\Category;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchType extends \Symfony\Component\Form\AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('string', TextType::class, [
                'label' => false,
                'required' => false,
                'attr' => ['placeholder' => 'Recherchez']
            ])
            ->add('categories', EntityType::class, [
                'class' => Category::class,
                'label' => false,
                'required' => false,
                'multiple' => true,
                'expanded' => true
            ])
            ->add('submit', SubmitType::class, [
                'label'=> 'Filtrer',
                'attr' => ['class'=> 'btn btn-primary btn-block']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Search::class,
            'method' => 'GET',
            'csrf_protection' => false
        ]);
    }
    public function getBlockPrefix()
    {
        return ''; // Alors !! Si on ne mets pas ça le formulaire ne s'affiche jamais et on a une exeption symfony comme quoi il n'arrive pas à
                   // transformer notre objet Search en string CA MA BOUFFE 2H !!!!!!!!!!!!
    }
}
