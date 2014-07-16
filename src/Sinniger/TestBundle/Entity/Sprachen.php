<?php

namespace Sinniger\TestBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Sprachen
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Sinniger\TestBundle\Entity\SprachenRepository")
 */
class Sprachen
{
    
    public function __construct(){
        $this->benutzersprachen = new ArrayCollection();
    }
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="de_name", type="string", length=255)
     */
    private $deName;

    /**
     * @var string
     *
     * @ORM\Column(name="en_name", type="string", length=255)
     */
    private $enName;

    // public $deNameChoice;

    // public $enNameChoice;



    /** 
    *@ORM\ManyToMany(targetEntity="Profile", mappedBy="fremdsprachen")
        **/
    private $benutzersprachen;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set deName
     *
     * @param string $deName
     * @return Sprachen
     */
    public function setDeName($deName)
    {
        $this->deName = $deName;

        return $this;
    }

    /**
     * Get deName
     *
     * @return string 
     */
    public function getDeName()
    {
        return $this->deName;
    }

    /**
     * Set enName
     *
     * @param string $enName
     * @return Sprachen
     */
    public function setEnName($enName)
    {
        $this->enName = $enName;

        return $this;
    }

    /**
     * Get enName
     *
     * @return string 
     */
    public function getEnName()
    {
        return $this->enName;
    }
    public function __toString()
    {
        //return (string) $this->deName;
    }



    /**
     * Add benutzersprachen
     *
     * @param \Sinniger\TestBundle\Entity\Profile $benutzersprachen
     * @return Sprachen
     */
    // public function addBenutzersprachen(\Sinniger\TestBundle\Entity\Profile $benutzersprachen)
    // {
    //     $this->benutzersprachen[] = $benutzersprachen;

    //     return $this;
    // }

    /**
     * Remove benutzersprachen
     *
     * @param \Sinniger\TestBundle\Entity\Profile $benutzersprachen
     */
    // public function removeBenutzersprachen(\Sinniger\TestBundle\Entity\Profile $benutzersprachen)
    // {
    //     $this->benutzersprachen->removeElement($benutzersprachen);
    // }

    /**
     * Get benutzersprachen
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    // public function getBenutzersprachen()
    // {
    //     return $this->benutzersprachen;
    // }
}
