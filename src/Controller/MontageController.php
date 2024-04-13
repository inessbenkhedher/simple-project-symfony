<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use App\Form\MontageType;

use App\Entity\Montage;

class MontageController extends AbstractController
{

    #[Route('/addMontage', name: 'add_montage')]
    public function add(Request $request){
        $montage=new Montage();
        
        $form = $this ->createForm("App\Form\MontageType",$montage);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
          
            $em = $this->getDoctrine()->getManager();
            $em->persist($montage);
            $em ->flush();
            return $this -> redirectToRoute('home');
        }


        return $this->render('montage/ajouter.html.twig',
        ['f'=>$form->createView()]);
    }

    #[Route('/', name:'home')]
    public function home(Request $request){
  
       
            $form = $this ->createFormBuilder()
            ->add("chercher",TextType::class)
            ->add("search",SubmitType::class)
            ->getForm();
            $form ->handleRequest($request);
       
            $em = $this->getDoctrine()->getManager();
            $repo=$em->getRepository(Montage::class);
            $montage = $repo->findAll();

            if ($form->isSubmitted()){
                $data = $form ->getData();
                $montage = $repo ->recherche($data['chercher']);
            }
         
            return $this->render('montage/home.html.twig',
            ['montage'=>$montage,'form'=>$form->createView()]);
      
        }


        #[Route('/editmon/{id}', name: 'edit_montage')]
        public function edit(Request $request, $id)
        {
            $montage = $this->getDoctrine()
                ->getRepository(Montage::class)
                ->find($id);
        
            if (!$montage) {
                throw $this->createNotFoundException(
                    'No montage found for id ' . $id
                );
            }
        
            $form = $this->createForm(MontageType::class, $montage);
        
            $form->handleRequest($request);
        
            if ($form->isSubmitted() && $form->isValid()) {
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->flush();
        
                return $this->redirectToRoute('home');
            }
        
            return $this->render('montage/ajouter.html.twig', ['f' => $form->createView()]);
        }


        #[Route('/supp/{id}', name: 'mont_delete')]
        public function delete(Request $request, $id): Response
        {
            $entityManager = $this->getDoctrine()->getManager();
            $montage = $entityManager->getRepository(Montage::class)->find($id);
        
            if (!$montage) {
                throw $this->createNotFoundException('No montage found for id ' . $id);
            }
            $entityManager= $this ->getDoctrine()->getManager();
            $entityManager->remove($montage);
            $entityManager->flush();
        
            return $this->redirectToRoute('home');
        }


}
