<?php

namespace Sinniger\TestBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;

class SprachenType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
$lang_query="deName";
        $builder
            ->add('deName')
            //->add('enName')

                    //          ->add('deName','entity', 
                    // array('class'=>'SinnigerTestBundle:Sprachen', 
                    //     'property' => $lang_query,
                    //     'query_builder' => function(EntityRepository $er) use ($lang_query) {
                    //         return $er->createQueryBuilder('s')->orderBy('s.'.$lang_query, 'asc');
                    //     },
 
                    //     //'constraints' => array(new Assert\NotBlank() )
                    // ))     

        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Sinniger\TestBundle\Entity\Sprachen'
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
