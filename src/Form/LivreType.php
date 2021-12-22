<?php
namespace App\Form;

use App\Entity\Auteur;
use App\Entity\Genre;
use App\Entity\Livre;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LivreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('titre', TextType::class)
        ->add('nbpages', IntegerType::class)
        ->add('auteurs', EntityType::class, ['class' => Auteur::class, 'choice_label' => 'nomPrenom', 'multiple' => true])
        ->add('genres', EntityType::class, ['class' => Genre::class, 'choice_label' => 'nom', 'multiple' => true])
        ->add('dateDeParution', DateType::class, ['widget' => 'single_text'])
        ->add('note', IntegerType::class);

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
        'data_class' => Livre::class,
        ]);
    }
}