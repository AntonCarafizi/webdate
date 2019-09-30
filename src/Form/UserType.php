<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Intl\Countries;
use Symfony\Component\Form\Extension\Core\Type\FileType;


class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $countries = Countries::getNames();

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
                    'choices' => array_flip($countries),
                    'expanded' => false,
            ])
            ->add('city', null,
                [
                    'label' => 'city',
            ])
            ->add('photos', FileType::class, [
                'label' => 'Photos (JPG file)',

                // unmapped means that this field is not associated to any entity property
                'mapped' => false,
                'multiple' => true,

                // make it optional so you don't have to re-upload the PDF file
                // everytime you edit the Product details
                'required' => false,
            ]);

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
