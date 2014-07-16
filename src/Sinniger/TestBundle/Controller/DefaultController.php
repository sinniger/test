<?php

namespace Sinniger\TestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Persistence\ObjectManager;
use Sinniger\TestBundle\Entity\Profile;
use Sinniger\TestBundle\Form\ProfileType;


class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('SinnigerTestBundle:Default:index.html.twig', array('name' => $name));
    }

    public function formAction( Request $request){
    	
        $userId=1;
		
        $locale="en";

		$profile = $this->getDoctrine()
		        ->getRepository('SinnigerTestBundle:Profile')
		        ->find($userId);




        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(new ProfileType($em), $profile, array('attr' => array('locale' => $locale) ));


        if ($request->getMethod() == 'POST') {
			$form->bind($request);
			if ($form->isValid()) {


//Stuff for the userphoto

if ($form->get('delete')->isClicked()) {
    $profile->setPhotoname(null);
 //die("stest");
 
}


              

                $profile->upload();

// echo '<pre>';
// \Doctrine\Common\Util\Debug::dump($profile->getFremdsprachen());
// echo '</pre>';die();

                //Remove duplicate languages
                //ToDo: könnte eleganter sein: $profile->getFremdsprachen->contains($key)
                $allLanguages=array();
                foreach ($profile->getFremdsprachen() as $key=>$sprache){
                    $allLanguages[]=$sprache->getId();
                }
                $counter=array_count_values($allLanguages);
                foreach ($counter as $key => $value) {
                    if ($value>1){
                        $remove= $this->getDoctrine()
                            ->getRepository('SinnigerTestBundle:Sprachen')
                            ->find($key);
                        $profile->removeFremdsprachen($remove);
                    }
                }

				$em->persist($profile);

				$em->flush();
                return $this->redirect($this->generateUrl('sinniger_test_form'));
			}
		}

        $photoname= $profile->getPhotoname();
        return $this->render(
            'SinnigerTestBundle:Default:form.html.twig',
            array('form' => $form->createView(), 'photoname'=>$photoname)
        );





    	
    }
}
