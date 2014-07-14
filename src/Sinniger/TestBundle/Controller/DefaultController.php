<?php

namespace Sinniger\TestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;


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
		

		$profile = $this->getDoctrine()
		        ->getRepository('SinnigerTestBundle:Profile')
		        ->find($userId);

       
        $sprache1=$this->getDoctrine()
                ->getRepository('SinnigerTestBundle:Sprachen')
                ->find('1');
       // $profile->addFremdsprachen($sprache1);
       // var_dump($profile);
      //  \Doctrine\Common\Util\Debug::dump($profile->getFremdsprachen());
    	$locale="de";

        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(new ProfileType($em), $profile, array('attr' => array('locale' => 'de') ));


        if ($request->getMethod() == 'POST') {
			$form->bind($request);
			if ($form->isValid()) {
    // $sprache1 = $this->getDoctrine()
    //             ->getRepository('SinnigerTestBundle:Sprachen')
    //             ->find(2);
               // $profile->addFremdsprachen($sprache1);

// echo '<pre>';
// \Doctrine\Common\Util\Debug::dump($profile->getFremdsprachen());
// echo '</pre>';die();

//TODO: Remove duplicate languages
foreach ($profile->getFremdsprachen() as $key=>$sprache){
    echo $sprache->getId();
}

                    // var_dump($form->getData());
				$em->persist($profile);
                //var_dump($profile->getFremdsprachen());
				$em->flush();
                return $this->redirect($this->generateUrl('sinniger_test_form'));
			
			}
		}
        return $this->render(
            'SinnigerTestBundle:Default:form.html.twig',
            array('form' => $form->createView(), 'name'=>'bla')
        );





    	
    }
}
