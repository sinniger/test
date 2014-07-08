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

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
   * Many-To-Many, Unidirectional
   *
   * @var ArrayCollection $permissions
   *
   * @ORM\ManyToMany(targetEntity="Sprachen")
   * @ORM\JoinTable(name="userprofile_has_foreign_language",
   *      joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
   *      inverseJoinColumns={@ORM\JoinColumn(name="sprachen_id", referencedColumnName="id")}
   * )
   */

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
     * Set fremdsprachen
     *
     * @param string $fremdsprachen
     * @return Profile
     */
    public function setFremdsprachen($fremdsprachen)
    {
        $this->fremdsprachen = $fremdsprachen;

        return $this;
    }

    /**
     * Get fremdsprachen
     *
     * @return string 
     */
    public function getFremdsprachen()
    {
        return $this->fremdsprachen;
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
}
