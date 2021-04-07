<?php declare(strict_types=1);

namespace App\Form;

use App\Entity\Customer;
use App\Entity\Order;
use App\Entity\Product;
use Doctrine\DBAL\Types\BooleanType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotNull;

class CreateOrderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('customer', EntityType::class, [
                'class' => Customer::class,
                'constraints' => [
                    new NotNull()
                ]
            ])
            ->add('products', EntityType::class, [
                'class' => Product::class,
                'multiple' => true,
                'constraints' => [
                    new NotNull()
                ]
            ])
            ->add('is_paid', CheckboxType::class, [
                'value' => Customer::class,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Order::class,
        ]);
    }
}
