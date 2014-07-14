<?php
namespace Sinniger\TestBundle\Form;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;

class SpracheToNumberTransformer implements DataTransformerInterface
{
    /**
     * @var ObjectManager
     */
    private $om;

    /**
     * @param ObjectManager $om
     */
    public function __construct(ObjectManager $om)
    {
        $this->om = $om;
    }

    /**
     * Transforms an object (sprache) to a string (number).
     *
     * @param  sprache|null $sprache
     * @return string
     */
    public function transform($sprache)
    {
        if (null === $sprache) {
            return "";
        }

        return $sprache->getId();
    }

    /**
     * Transforms a string (number) to an object (sprache).
     *
     * @param  string $number
     * @return sprache|null
     * @throws TransformationFailedException if object (sprache) is not found.
     */
    public function reverseTransform($number)
    {
        
        if (!$number) {
            return null;
        }

        $sprache = $this->om
        ->getRepository('SinnigerTestBundle:Sprachen')
        ->findOneBy(array('id' => $number))
        ;

        if (null === $sprache) {
            throw new TransformationFailedException(sprintf(
                    'sprache with ID "%s" does not exist!',
                    $number
            ));
        }
// echo '<pre>';
// \Doctrine\Common\Util\Debug::dump($sprache);
// echo '</pre>';die();
        return $sprache;
    }
}

