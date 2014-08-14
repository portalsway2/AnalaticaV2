<?php

namespace Analatica\NavigateurBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class NavigateurType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('navigateur')
            ->add('version')
            ->add('idUserAgent')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Analatica\NavigateurBundle\Entity\Navigateur'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'analatica_navigateurbundle_navigateur';
    }
}
