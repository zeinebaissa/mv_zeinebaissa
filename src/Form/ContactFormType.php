<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('subject', TextType::class, [
                'label' => 'Subject',
                'required' => true, // Mark the subject field as required
            ])
            ->add('email', EmailType::class, [
                'label' => 'Your Email',
                'required' => true, // Mark the email field as required
            ])
            ->add('message', TextareaType::class, [
                'label' => 'Message',
                'required' => true, // Mark the message field as required
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Define any default options for your form here
        ]);
    }
}

