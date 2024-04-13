<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Montage;
use App\Entity\Piece;

class PieceController extends AbstractController
{
   
    #[Route('/addPiece', name: 'add_piece')]
    public function add(Request $request){
        $piece=new Piece();
        
        $form = $this ->createForm("App\Form\PieceType",$piece);
        $form->handleRequest($request);
        if ($form->isSubmitted()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($piece);
            $em ->flush();
            return $this -> redirectToRoute('list');
        }


        return $this->render('piece/ajouter.html.twig',
        ['f'=>$form->createView()]);
    }

    #[Route('/listpiece', name:'list')]
public function list(){
    
        $em = $this->getDoctrine()->getManager();
        $repo=$em->getRepository(Piece::class);
        $lespiece = $repo->findAll();
    
        return $this->render('piece/list.html.twig',
        ['lespiece'=>$lespiece]);
    }

    #[Route('/edit/{id}', name:'edit_piece')]
    public function edit(Request $request, $id)
    {
        $piece = $this->getDoctrine()
            ->getRepository(Piece::class)
            ->find($id);
    
        if (!$piece) {
            throw $this->createNotFoundException(
                'No montage found for id ' . $id
            );
        }
    
        $fb = $this->createFormBuilder($piece)
            ->add('nomPiece', TextType::class)
            ->add('quantite', TextType::class)
            ->add('unite',TextType::class) // Use DateType instead of DateTimeType
            ->add('fournisseur', TextType::class)
            ->add('image', TextType::class)
            ->add('montage', EntityType::class, [
                'class' => Montage::class,
                'choice_label' => 'nomMontage',
            ])
            ;
    
        $form = $fb->getForm();
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();
    
            return $this->redirectToRoute('list');
        }
    
        return $this->render('piece/ajouter.html.twig', ['f' => $form->createView()]);
    }



    #[Route('/del/{id}', name: 'piece_delete')]
    public function delete(Request $request, $id): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $piece = $entityManager->getRepository(Piece::class)->find($id);
    
        if (!$piece) {
            throw $this->createNotFoundException('No piece found for id ' . $id);
        }
    
        $entityManager= $this ->getDoctrine()->getManager();
    
        $entityManager->remove($piece);
        $entityManager->flush();
    
        return $this->redirectToRoute('list');
    }
    


}
