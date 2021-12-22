<?php

namespace App\Form;

use App\Entity\AuteurSearch;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\Auteur;

class AuteurSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomPrenom', TextType::class, [
                'required' => false
            ])
            ->add('sexe', ChoiceType::class, ['choices' => Auteur::SEXE, 'required' => false,'placeholder' => 'Sexe'])
            ->add('dateDeNaissance', DateType::class, [ 'required' => false, 'widget' => 'single_text'])
            ->add('nationalite', TextType::class, ['required' => false])
            ->add('nbLivre', IntegerType::class, ['required' => false]);

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => AuteurSearch::class,
            'method' => 'get',
            'csrf_protection' => false
        ]);
    }

    public function getBlockPrefix()
    {
        return '';
    }
}
