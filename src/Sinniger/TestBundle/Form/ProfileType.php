<?php

namespace Sinniger\TestBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
//use Doctrine\Common\Persistence\ObjectManager;


use Symfony\Component\HttpFoundation\File\UploadedFile;

class ProfileType extends AbstractType
{
    private $entityManager;

    public function __construct($entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
       // \Doctrine\Common\Util\Debug::dump($options);
        $locale = $options['attr']['locale'];
        $transformer = new SpracheToNumberTransformer($this->entityManager);

        $builder
            ->add(
               'fremdsprachen', 'collection', array(
                    // 'type' => 'sprachen_select', //Dont use it as service because of locale....
                    'type' => new SprachenSelectType($this->entityManager, $locale),
                    'allow_add' => true,
                    'allow_delete' => true,
                    'by_reference' => false,
                    'options' => array(
                            'multiple' => false,
                            'expanded' => false,
                            'empty_value' => 'Fremdsprache wählen',
                            'label' => 'Fremdsprache',
                            'attr' => array('class' => 'sprachen')
                            )
                    )

                
        )
            ->add('username')
            ->add('photo', 'file', array('label'=>'hochladen', 'virtual' => true,
                                    'attr' => 
                                    array('label'=>'file upload', 
                                         'empty_value'=>'bitte wählen')))
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