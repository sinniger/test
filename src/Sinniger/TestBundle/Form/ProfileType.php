<?php

namespace Sinniger\TestBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ProfileType extends AbstractType   
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
           //->add('fremdsprachen')
           //->add('deName', new SprachenType())

            ->add('fremdsprachen', 'collection',array('type'=>new SprachenType()))
         
         //->add('fremdsprachen', 'choice', array('multiple'=>true))

            //->add(new SprachenChoiceType())
 

            ->add('submit', 'submit');
        
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
          //  'data_class' => 'Sinniger\TestBundle\Entity\Profile'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'profile';
    }
}
