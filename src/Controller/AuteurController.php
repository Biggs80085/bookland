<?php

namespace App\Controller;
use App\Entity\Auteur;
use App\Entity\AuteurSearch;
use App\Form\AuteurSearchType;
use App\Form\AuteurType;
use App\Repository\AuteurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;

class AuteurController extends AbstractController{

    private $repo;
    public function __construct(AuteurRepository $repo){
        $this->repo = $repo;
    }

    public function addAuteur(Request $request){
        $auteur = new Auteur;

        $form = $this->createForm(AuteurType::class, $auteur);
        $form->add('submit', SubmitType::class, array('label' => 'Ajouter'));
        $form->handleRequest($request);

        if($form->isSubmitted()){
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($auteur);
            $entityManager->flush();
            return $this->redirectToRoute('bookland_edit', array('auteur' => $this->repo->findAll()));
        }

        return $this->render('booklandAuteur/addAuteur.html.twig', array('monFormulaire' => $form->createView()));

    }

    public function modifierAuteur($id, Request $request){
        $auteur = $this->repo->find($id);
        if(!$auteur)
            throw $this->createNotFoundException('Auteur[id='.$id.'] inexistante');
        $form = $this->createForm(AuteurType::class, $auteur);
        $form->add('submit', SubmitType::class, array('label' => 'Modifer'));

        $form->handleRequest($request);
        if($form->isSubmitted()){
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            return $this->redirectToRoute('bookland_edit', array('auteur' => $this->repo->findAll()));
        }

        return $this->render('booklandAuteur/modifierAuteur.html.twig', array('monFormulaire' => $form->createView()));
    }

    public function removeAuteur($id){
        $auteur = $this->repo->find($id);

        $em = $this->getDoctrine()->getManager();
        $em->remove($auteur);
        $em->flush();

        return $this->redirectToRoute('bookland_edit', array('auteur' => $this->repo->findAll()));
    }

    public function edit(Request $request){
        $auteurSearch = new AuteurSearch();
        $form = $this->createForm(AuteurSearchType::class, $auteurSearch);
        $form->handleRequest($request);

        $auteurSearch = $this->repo->findAuteur($auteurSearch);
        return $this->render('booklandAuteur/edit.html.twig', array('monFormulaire'=> $form->createView(),'auteur'=> $auteurSearch));
    }

    public function showAuteur($id){
        $auteur = $this->repo->find($id);
        return $this->render('booklandAuteur/showAuteur.html.twig', array('auteur' => $auteur, 'genre' => $this->repo->findAGenre($auteur)));
    }

}