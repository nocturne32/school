<?php declare(strict_types=1);

namespace App\Form;

use App\Entity\Customer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotNull;

class CreateCustomerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'constraints' => [
                    new NotNull()
                ]
            ])
            ->add('firstname', TextType::class, [
                'constraints' => [
                    new NotNull()
                ]
            ])
            ->add('lastname', TextType::class, [
                'constraints' => [
                    new NotNull()
                ]
            ])
            ->add('street', TextType::class, [
                'constraints' => [
                    new NotNull()
                ]
            ])
            ->add('city', TextType::class, [
                'constraints' => [
                    new NotNull()
                ]
            ])
            ->add('postal_code', TextType::class, [
                'constraints' => [
                    new NotNull()
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Customer::class,
        ]);
    }
}
