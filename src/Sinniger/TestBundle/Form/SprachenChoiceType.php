<?php

namespace Sinniger\TestBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;

class SprachenChoiceType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            //->add('enName')
            //->add('enName')

             ->add('benutzersprachen','choice', 
                    array('class'=>'Sinniger\TestBundle\Entity\Sprachen',
                        'property' => "deName",
                        'expanded'=> true,
                        'by_reference'=>false,
                        'allow_add' => true,
                        'prototype' => true,
                        'multiple' => false))  

            // ->add('submit', 'submit')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Sinniger\TestBundle\Entity\Sprachen',
            //'data_class' => null
            
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'sprachen';
    }
}
