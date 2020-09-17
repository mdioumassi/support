<?php

namespace App\Form;

use App\Entity\DoDonate;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Intl\Countries;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DoDonateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $countries = Countries::getNames();;
        $builder
            ->add('firstname')
            ->add('lastname')
            ->add('email', EmailType::class, [
                'required' => true
            ])
            ->add('civility', ChoiceType::class, [
                'placeholder' => 'Choisir',
                'choices'  => [
                    'Mr' => 'monsieur',
                    'Mme' => 'madame',
                    'Mll' => 'mademoiselle',
                ],
                'required' => true
            ])
            ->add('address')
            ->add('address_complement')
            ->add('postal_code')
            ->add('city')
            ->add('country', CountryType::class, [
                'choices' => $countries,
                'required' => true
            ])
            ->add('mobile_phone')
            ->add('amount_free')
          ->add('amountOnce',ChoiceType::class,array(
                'choices'  => array(
                    '20€' => 20,
                    '30€' => 30,
                    '40€' => 40,
                    '50€' => 50
                ),
       //         'data' => '20',
                'expanded' => true,
                'multiple' => false,
                'required' => false,
                'label' => false
            ))
            ->add('receive_info')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => DoDonate::class,
        ]);
    }
}
