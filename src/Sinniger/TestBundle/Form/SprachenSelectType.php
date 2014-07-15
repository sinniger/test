<?php

namespace Sinniger\TestBundle\Form;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;

class SprachenSelectType extends AbstractType

{
    /**
     * @var ObjectManager
     */
    private $om;

    private $choices;

    /**
     * @param ObjectManager $om
     */
    public function __construct(ObjectManager $om, $locale)
    {
        $this->om = $om;
        $this->locale = $locale;

        // Build our choices array from the database
        $sprachen = $om->getRepository('SinnigerTestBundle:Sprachen')->findAll();
        foreach ($sprachen as $sprache)
        {
            // choices[key] = label
            if ($this->locale=="de"){
                 $this->choices[$sprache->getId()] = $sprache->getDeName() ;
            }
            elseif ($this->locale=="en"){
                 $this->choices[$sprache->getId()] = $sprache->getEnName() ;
            }

           
// echo '<pre>';
//             var_dump($this->choices);
// echo '</pre>';
        }
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $transformer = new SpracheToNumberTransformer($this->om);
        $builder->addModelTransformer($transformer);
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
                "choices" => $this->choices,
                // "by_reference" => false,
                ));
    }

    public function getParent()
    {
        return 'choice';
    }

    public function getName()
    {
        return 'sprachen_select';
    }
}