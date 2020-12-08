<?php

namespace App\Form;

use App\Entity\DoDonate;
use App\Entity\Parameter;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Intl\Countries;
use Symfony\Component\Mime\Message;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

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
            ->add('civility', EntityType::class, [
                'class' => Parameter::class,
                'choice_label' => 'label'
            ])
            ->add('address')
            ->add('address_complement')
            ->add('postal_code', IntegerType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Le code postal est obligatoire.'
                    ]),
                    new Length([
                        'min' => 5,
                        'minMessage' => 'Le code postal doit comporter {{ limit }} chiffre',
                        'max' => 5,
                    ]),
                ]
            ])
            ->add('city', TextType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'La ville est obligatoire.'
                    ]),
                ]
            ])
            ->add('country', CountryType::class, [
                'choices' => $countries,
                'required' => true
            ])
            ->add('mobile_phone')
            ->add('receive_info', CheckboxType::class, [
                'label' => 'Oui, j\'accepte de recevoir des informations de Yattim-mr par e-mail et téléphone',
                'required' => false
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => DoDonate::class,
        ]);
    }
}
