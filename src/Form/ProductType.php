<?php

namespace App\Form;

use App\Entity\Product;
use App\Entity\Discount;
use App\Entity\Producer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('code')
            ->add('name')
            ->add('stock')
            ->add('price')
            ->add('producer', EntityType::class, [
                'class' => Producer::class,
                'choice_label' => 'name'
            ])
            ->add('discount', EntityType::class, [
                'class' => Discount::class,
                'choice_label' => 'name'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
