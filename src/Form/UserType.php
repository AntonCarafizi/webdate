<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Intl\Countries;
use Symfony\Component\Translation\Translator;


class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $translator = new Translator('en');
        $countries = Countries::getNames();
        $countries_en = [];
        foreach ($countries as $country) {
            $countries_en[] = $translator->trans($country);
        }

        $builder
            ->add('name', null,
                [
                    'label' => 'name',
                ])
            ->add('email',  null,
                [
                    'label' => 'email',
                ])
            ->add('dateOfBirth', BirthdayType::class,
                [
                    'label' => 'date_of_birth',
                ])
            ->add('country', CountryType::class,
                [
                    'label' => 'country',
                    'placeholder' => 'choose_a_country',
                    'choices' => array_flip($countries_en),
                    'expanded' => false,
            ])
            ->add('city', null,
                [
                    'label' => 'city',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
