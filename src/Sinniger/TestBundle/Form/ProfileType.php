<?php

namespace Sinniger\TestBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ProfileType extends AbstractType
{
    private $entityManager;

    public function __construct($entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $transformer = new SpracheToNumberTransformer($this->entityManager);

//          $builder
//          ->add('deName')
// ;
        $builder
            ->add(
                $builder->create('fremdsprachen', 'collection', array(
                    'type' => 'sprachen_select',
                    'allow_add' => true,
                    'allow_delete' => true,
                    'by_reference' => false,

                    'options' => array(
                            'multiple' => false,
                            'expanded' => false,
                              'empty_value' => 'Fremdsprache wählen',
                            'attr' => array('class' => 'sprachen')
                                // 'by_reference' =>false,
                            )
                    ))
        )
            ->add('speichern', 'submit')
            ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Sinniger\TestBundle\Entity\Profile'
        ));
    }

    public function getName()
    {
        return 'sinniger_testbundle_profile';
    }
}