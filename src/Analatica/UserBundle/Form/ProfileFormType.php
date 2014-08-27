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
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use FOS\UserBundle\Form\Type\ProfileFormType as BaseType;
use Symfony\Component\Security\Core\Validator\Constraints\UserPassword as OldUserPassword;
use Symfony\Component\Security\Core\Validator\Constraints\UserPassword;

class ProfileFormType extends BaseType
{
    private $class;

    /**
     * @param string $class The User class name
     */
    public function __construct($class)
    {
        $this->class = $class;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)

    {

        parent::buildForm($builder, $options);
        $builder
            ->remove('username')
            ->remove('usernamecanonical')
            ->remove('email')
            ->remove('emailcanonical')
            ->remove('firstname')
            ->remove('lastname');


        $builder
            ->add('username', null, array('label' => 'Name', 'translation_domain' => 'FOSUserBundle'))
            ->add('usernamecanonical', null, array('label' => 'Name Canonical', 'translation_domain' => 'FOSUserBundle'))
            ->add('email', 'email', array('label' => 'Email', 'translation_domain' => 'FOSUserBundle'))
            ->add('emailcanonical', 'email', array('label' => 'Email Canonical', 'translation_domain' => 'FOSUserBundle'))
            ->add('firstname', null, array('label' => 'First Name', 'translation_domain' => 'FOSUserBundle'))
            ->add('lastname', null, array('label' => 'Last Name', 'translation_domain' => 'FOSUserBundle'));


    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Analatica\UserBundle\Entity\User'
        ));
    }

    public function getName()
    {
        return 'analatica_user_profile';
    }
}