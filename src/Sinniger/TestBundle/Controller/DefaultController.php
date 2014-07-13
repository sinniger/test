<?php

namespace Sinniger\TestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;



use Sinniger\TestBundle\Entity\Profile;
use Sinniger\TestBundle\Form\ProfileType;


class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('SinnigerTestBundle:Default:index.html.twig', array('name' => $name));
    }

    public function formAction($name="test", Request $request){
    	
$userId=1;
		

		$profile = $this->getDoctrine()
		        ->getRepository('SinnigerTestBundle:Profile')
		        ->find($userId);

       
        $sprache1=$this->getDoctrine()
                ->getRepository('SinnigerTestBundle:Sprachen')
                ->find('1');
        $profile->addFremdsprachen($sprache1);
       // var_dump($profile);
      //  \Doctrine\Common\Util\Debug::dump($profile->getFremdsprachen());
    	$locale="de";

		
	  	//$profile = new Profile();

        $form = $this->createForm(new ProfileType(), $profile, array('attr' => array('locale' => 'de') ));


        if ($request->getMethod() == 'POST') {
			$form->bind($request);
			if ($form->isValid()) {



				$em->persist($profile);
				$em->flush();
			
			}
		}
        return $this->render(
            'SinnigerTestBundle:Default:form.html.twig',
            array('form' => $form->createView(), 'name'=>'bla')
        );





    	
    }
}
