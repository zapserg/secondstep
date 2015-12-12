<?php

namespace Acme\SecondBazBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TovarType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null,array('label' => 'Название продукта'))
            ->add('idkategor',null, array('label' => 'Категория'))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Acme\SecondBazBundle\Entity\Tovar'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'acme_secondbazbundle_tovar';
    }
}
