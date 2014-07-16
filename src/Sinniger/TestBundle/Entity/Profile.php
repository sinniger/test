<?php

namespace Sinniger\TestBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;

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
    *@var fremdsprachen
    *@ORM\ManyToMany(targetEntity="Sprachen", cascade={"persist"}, inversedBy="benutzersprachen")
    *@ORM\JoinTable(name="profile_sprachen",
       *      joinColumns={@ORM\JoinColumn(name="sprachen_id", referencedColumnName="id")},
       *      inverseJoinColumns={@ORM\JoinColumn(name="profile_id", referencedColumnName="id")}
       * )
    **/
    private $fremdsprachen;

    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=255)
     */
    private $username;



    /**
     * @Assert\File(maxSize="6000000")
     */
    private $photo; //this is virtual, not saved to db

    /**
     * @var string
     *
     * @ORM\Column(name="photoname", type="string", length=255)
     */
    private $photoname;

        /**
     * @var string
     *
     * @ORM\Column(name="photopath", type="string", length=255)
     */
    private $photopath;


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

   
/**
     * Sets photo.
     *
     * @param UploadedpFile  $photo
     */
    public function setPhoto(UploadedFile $photo = null)
    {
        $this->photo = $photo;
    }

    /**
     * Get photo.
     *
     * @return Uploadedphoto
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * Set photoname
     *
     * @param string $photoname
     * @return Profile
     */
    public function setPhotoname($photoname)
    {
        $this->photoname = $photoname;

        return $this;
    }

    /**
     * Get photoname
     *
     * @return string 
     */
    public function getPhotoname()
    {
        return $this->photoname;
    }

    /**
     * Set photopath
     *
     * @param string $photopath
     * @return Profile
     */
    public function setPhotopath($photopath)
    {
        $this->photopath = $photopath;

        return $this;
    }

    /**
     * Get photopath
     *
     * @return string 
     */
    public function getPhotopath()
    {
        return $this->photopath;
    }








// function generate_image_thumbnail($source_image_path, $thumbnail_image_path)
// {
 
// define('THUMBNAIL_IMAGE_MAX_WIDTH', 150);
// define('THUMBNAIL_IMAGE_MAX_HEIGHT', 150);

//     list($source_image_width, $source_image_height, $source_image_type) = getimagesize($source_image_path);
//     switch ($source_image_type) {
//         case IMAGETYPE_GIF:
//             $source_gd_image = imagecreatefromgif($source_image_path);
//             break;
//         case IMAGETYPE_JPEG:
//             $source_gd_image = imagecreatefromjpeg($source_image_path);
//             break;
//         case IMAGETYPE_PNG:
//             $source_gd_image = imagecreatefrompng($source_image_path);
//             break;
//     }
//     if ($source_gd_image === false) {
//         return false;
//     }
//     $source_aspect_ratio = $source_image_width / $source_image_height;
//     $thumbnail_aspect_ratio = THUMBNAIL_IMAGE_MAX_WIDTH / THUMBNAIL_IMAGE_MAX_HEIGHT;
//     if ($source_image_width <= THUMBNAIL_IMAGE_MAX_WIDTH && $source_image_height <= THUMBNAIL_IMAGE_MAX_HEIGHT) {
//         $thumbnail_image_width = $source_image_width;
//         $thumbnail_image_height = $source_image_height;
//     } elseif ($thumbnail_aspect_ratio > $source_aspect_ratio) {
//         $thumbnail_image_width = (int) (THUMBNAIL_IMAGE_MAX_HEIGHT * $source_aspect_ratio);
//         $thumbnail_image_height = THUMBNAIL_IMAGE_MAX_HEIGHT;
//     } else {
//         $thumbnail_image_width = THUMBNAIL_IMAGE_MAX_WIDTH;
//         $thumbnail_image_height = (int) (THUMBNAIL_IMAGE_MAX_WIDTH / $source_aspect_ratio);
//     }
//     $thumbnail_gd_image = imagecreatetruecolor($thumbnail_image_width, $thumbnail_image_height);
//     imagecopyresampled($thumbnail_gd_image, $source_gd_image, 0, 0, 0, 0, $thumbnail_image_width, $thumbnail_image_height, $source_image_width, $source_image_height);
//     imagejpeg($thumbnail_gd_image, $thumbnail_image_path, 90);
//     imagedestroy($source_gd_image);
//     imagedestroy($thumbnail_gd_image);
//     return true;
// }







    public function upload()
{
    // the file property can be empty if the field is not required
    if (null === $this->getPhoto()) {
        return;
    }

    // use the original file name here but you should
    // sanitize it at least to avoid any security issues

    // move takes the target directory and then the
    // target filename to move to

    $this->getPhoto()->move(
        $this->getUploadRootDir(),
        $this->getPhoto()->getClientOriginalName()
    );

    // set the path property to the filename where you've saved the file
    //NEU:
    $this->photoname = $this->getPhoto()->getClientOriginalName();


    // clean up the file property as you won't need it anymore
    $this->photo = null;
}




    public function getAbsolutePhotoPath()
    {
        return null === $this->photopath
            ? null
            : $this->getUploadRootDir().'/'.$this->photopath;
    }

    public function getWebPhotoPath()
    {
        return null === $this->photopath
            ? null
            : $this->getUploadDir().'/'.$this->photopath;
    }

    protected function getUploadRootDir()
    {
        // the absolute directory path where uploaded
        // documents should be saved
        return __DIR__.'/../../../../web/'.$this->getUploadDir();
    }

    protected function getUploadDir()
    {
        // get rid of the __DIR__ so it doesn't screw up
        // when displaying uploaded doc/image in the view.
        return 'uploads/photos';
    }

}
