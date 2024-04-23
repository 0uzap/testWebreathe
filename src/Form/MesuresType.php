<?php

namespace App\Form;

use App\Entity\DonneesNumeriques;
use App\Entity\Mesures;
use App\Entity\Module;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class MesuresType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('etatModule', TextType::class, [
                'label' => 'État du Module',
                'required' => false,
                'attr' => ['class' => 'form-control'],
                'label_attr' => ['class' => 'fw-bold textForm'],
            ])
            ->add('nouveau_module', TextType::class, [
                'mapped' => false,
                'required' => false,
                'label' => 'Nouveau Module',
                'attr' => ['class' => 'form-control'],
                'label_attr' => ['class' => 'fw-bold textForm'],
            ])
            ->add('donneesNumeriques', EntityType::class, [
                'class' => DonneesNumeriques::class,
                'choice_label' => 'type',
                'multiple' => false,
                'expanded' => true,
                'attr' => ['class' => 'form-control formCheckbox'], 
                'label_attr' => ['class' => 'fw-bold textForm'],
            ])
            ->add('ajouter', SubmitType::class, [
                'attr' => ['class'=> 'btn bouton m-4'],
                'row_attr' => ['class' => 'text-center'],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Mesures::class,
        ]);
    }
}
