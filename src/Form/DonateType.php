<?php

namespace App\Form;

use App\Entity\Donate;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Intl\Countries;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DonateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $countries = Countries::getNames();;
        $builder
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
            ->add('firstname', TextType::class, [
                'required' => true
            ])
            ->add('lastname', TextType::class, [
                'required' => true
            ])
            ->add('address', TextType::class, [
                'required' => true
            ])
            ->add('address_complement')
            ->add('postal_code', TextType::class, [
                'required' => true
            ])
            ->add('city', TextType::class, [
                'required' => true
            ])
            ->add('country', CountryType::class, [
                'choices' => $countries,
                'required' => true
            ])
            ->add('mobile_phone')
            ->add('receive_info')
           ->add('amountOnce',ChoiceType::class,array(
               'choices'  => array(
                   '20€' => 20,
                   '30€' => 30,
                   '40€' => 40,
                   '50€' => 50
               ),
               'expanded' => true,
               'multiple' => false,
               'required' => false,
               'label' => false

           ))
            ->add('amountFree', TextType::class, [
                'required' => false
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Donate::class,
        ]);
    }
}
