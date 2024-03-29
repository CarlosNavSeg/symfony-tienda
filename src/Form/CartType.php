<?php

namespace App\Form;

use App\Entity\Order;
use App\Form\EventListener\ClearCartListener;
use App\Form\EventListener\RemoveCartListener;
use Symfony\Component\ErrorHandler\Debug;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CartType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('orderItems', CollectionType::class, [
            'entry_type' => CartItemType::class
        ])
        ->add('save', SubmitType::class)
        ->add('clear', SubmitType::class)
        ;
        $builder->addEventSubscriber(new RemoveCartListener());
        $builder->addEventSubscriber(new ClearCartListener());
        Debug::enable();
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Order::class,
        ]);
    }
}
