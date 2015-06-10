<?php

namespace AppquariumBundle\Form\Type;

use Symfony\Component\Form\AbstractType,
    Symfony\Component\Form\FormBuilderInterface,
    Symfony\Component\Security\Core\Validator\Constraints\UserPassword;

class ProfileFormType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', 'text', array('label' => 'form.name', 'translation_domain' => 'FOSUserBundle'))
                ->add('surname', 'text', array('label' => 'form.surname', 'translation_domain' => 'FOSUserBundle'))
                ->add('email', 'email', array('label' => 'form.email', 'translation_domain' => 'FOSUserBundle'))
                ->add('username', null, array('label' => 'form.username', 'translation_domain' => 'FOSUserBundle'))
                ->add('image', 'file', array('label' => 'form.avatar', 'translation_domain' => 'FOSUserBundle', 'required' => false))
                ->add('newsletter_subscription', 'checkbox', array(
                    'label' => 'form.newsletter_subscription',
                    'translation_domain' => 'FOSUserBundle',
                    'property_path' => 'newsletterSubscription',
                    'required' => false,

                ))
                ->add('current_password', 'password', array(
                        'label' => 'form.current_password',
                        'translation_domain' => 'FOSUserBundle',
                        'mapped' => false,
                        'constraints' => new UserPassword(),
                ));
    }

    public function getParent()
    {
        return 'fos_user_profile';
    }

    public function getName()
    {
        return 'appquarium_user_profile';
    }
} 