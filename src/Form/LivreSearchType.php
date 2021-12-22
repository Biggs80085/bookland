<?php

namespace App\Form;

use App\Entity\Livre;
use App\Entity\LivreSearch;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LivreSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre', TextType::class, ['required' => false])
            ->add('nbpages', IntegerType::class, ['required' => false])
            ->add('dateDeParution', DateType::class, ['required' => false, 'widget' => 'single_text'])
            ->add('dateDeParution1', DateType::class, ['required' => false, 'widget' => 'single_text'])
            ->add('note', IntegerType::class, ['required' => false])
            ->add('note1', IntegerType::class, ['required' => false]);

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => LivreSearch::class,
            'method' => 'get',
            'csrf_protection' => false
        ]);
    }

    public function getBlockPrefix()
    {
        return '';
    }
}