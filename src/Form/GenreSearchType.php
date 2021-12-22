<?php

namespace App\Form;


use App\Entity\Genre;
use App\Entity\GenreSearch;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GenreSearchType extends AbstractType {
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add('nom', EntityType::class, ['required' => false, 'class' => Genre::class, 'choice_label' => 'nom', 'multiple' => true]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => GenreSearch::class,
            'method' => 'get',
            'csrf_protection' => false
        ]);
    }

    public function getBlockPrefix()
    {
        return '';
    }
}