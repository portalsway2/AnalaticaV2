<?php

/*
 * This file is part of the FOSUserBundle package.
 *
 * (c) FriendsOfSymfony <http://friendsofsymfony.github.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Analatica\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BaseType;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class RegistrationFormType extends BaseType
{
    private $class;


    public function buildForm(FormBuilderInterface $builder, array $options)

    {

        parent::buildForm($builder, $options);
        $builder
            ->remove('email')
            ->remove('username')
            ->remove('plainPassword')
            ->remove('last_name')
            ->remove('first_name');
        $builder
            ->add('email', 'email', array('label' => 'Email', 'translation_domain' => 'FOSUserBundle'))
            ->add('username', null, array('label' => 'User name', 'translation_domain' => 'FOSUserBundle'))
            ->add('first_name', null, array('label' => 'First name', 'translation_domain' => 'FOSUserBundle'))
            ->add('last_name', null, array('label' => 'Last name', 'translation_domain' => 'FOSUserBundle'))
            ->add('plainPassword', 'repeated', array(
                'type' => 'password',
                'options' => array('translation_domain' => 'FOSUserBundle'),
                'first_options' => array('label' => 'Password'),
                'second_options' => array('label' => 'Password confirmation'),
                'invalid_message' => 'fos_user.password.mismatch',
            ));

    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Analatica\UserBundle\Entity\User'
        ));
    }

    public function getName()
    {
        return 'analatica_user_registration';
    }
}