<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class ContactType extends AbstractType
{
    /**
     * Build the form
     * @param FormBuilderInterface $builder The form builder
     * @param array $options The options
     * @return void
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('username', TextType::class, array('label'=>false, 'attr' => array('placeholder' => 'Your username'), 'constraints' => array(new NotBlank(array("message" => "Please fill in your username.")))))
            ->add('email', EmailType::class, array('label'=>false,'attr'=> array('placeholder'=>'Your e-mail')))
            ->add('message',TextareaType::class,array('label'=>false,'attr'=> array('placeholder'=>'Your message')));

        ;
    }

    /**
     * Configure the options
     * @param OptionsResolver $resolver The options resolver
     * @return void
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
