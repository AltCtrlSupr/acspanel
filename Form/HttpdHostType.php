<?php

namespace ACS\ACSPanelBundle\Form;

use ACS\ACSPanelBundle\Form\Base\ContainerAwareType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class HttpdHostType extends ContainerAwareType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('configuration')
            ->add('cgi')
            ->add('ssi')
            ->add('php')
            ->add('enabled')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('user')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ACS\ACSPanelBundle\Entity\HttpdHost'
        ));
    }

    public function getName()
    {
        return 'acs_acspanelbundle_httpdhosttype';
    }
}
