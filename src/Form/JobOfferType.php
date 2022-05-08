<?php

namespace App\Form;

use App\Entity\JobOffer;
use App\Entity\Stack;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Positive;
use Symfony\Component\Validator\Constraints\Range;

class JobOfferType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class)
            ->add('level_search', TextType::class)
            ->add('salary')
            ->add('experience_required', IntegerType::class)
            ->add('english_required')
            ->add('remote')
            ->add('comment', TextareaType::class, [
                'attr' => [
                    'rows' => '5'
                ]
            ])
            ->add('companies')
            ->add('stacks', EntityType::class, [
                'class' => Stack::class,
                'choice_label' => 'name',
                'multiple' => true,
            ])
            ->add('type_job');
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => JobOffer::class,
        ]);
    }
}
