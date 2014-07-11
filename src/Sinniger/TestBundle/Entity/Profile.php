<?php

namespace Sinniger\TestBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Profile
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Sinniger\TestBundle\Entity\ProfileRepository")
 */
class Profile
{
    public function __construct()
    {
        $this->fremdsprachen = new ArrayCollection();
    }

    

    // public function __toString(){
    //      return "test";
    // }

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;



        /**
    *@var benutzersprachen
    *@ORM\ManyToMany(targetEntity="Sprachen", inversedBy="benutzersprachen")
    *
    **/
    private $fremdsprachen;

    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=255)
     */
    private $username;




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
     * Set username
     *
     * @param string $username
     * @return Profile
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string 
     */
    public function getUsername()
    {
        return $this->username;
    }

   

    /**
     * Add fremdsprachen
     *
     * @param \Sinniger\TestBundle\Entity\Sprachen $fremdsprachen
     * @return Profile
     */
    public function addFremdsprachen(\Sinniger\TestBundle\Entity\Sprachen $fremdsprachen)
    {
        $fremdsprachen->addBenutzersprachen($this);//?
        $this->fremdsprachen[] = $fremdsprachen;

        return $this;
    }

    /**
     * Remove fremdsprachen
     *
     * @param \Sinniger\TestBundle\Entity\Sprachen $fremdsprachen
     */
    public function removeFremdsprachen(\Sinniger\TestBundle\Entity\Sprachen $fremdsprachen)
    {
        $this->fremdsprachen->removeElement($fremdsprachen);
    }

    /**
     * Get fremdsprachen
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getFremdsprachen()
    {
        return $this->fremdsprachen;
    }

        public function getTest(){
        return "asdf";
    }

}
