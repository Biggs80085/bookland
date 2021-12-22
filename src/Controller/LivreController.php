<?php

namespace App\Controller;

use App\Entity\Livre;
use App\Form\LivreSearchType;
use App\Form\LivreType;
use App\Repository\LivreRepository;

use App\Entity\LivreSearch;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;

class LivreController extends AbstractController{

    private $repo;
    public function __construct(LivreRepository $repo){
        $this->repo = $repo;
    }

    public function addLivre(Request $request){
        $livre = new Livre;

        $form = $this->createForm(LivreType::class, $livre);
        $form->add('submit', SubmitType::class, array('label' => 'Ajouter'));
        $form->handleRequest($request);

        if($form->isSubmitted()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($livre);
            $em->flush();

            return $this->redirectToRoute('bookland_editLivre', array('livre' => $this->repo->findAll()));
        }

        return $this->render('booklandLivre/addLivre.html.twig', array('monFormulaire' => $form->createView()));

    }

    public function modifierLivre($id, Request $request){
        $livre = $this->repo->find($id);
        if(!$livre)
            throw $this->createNotFoundException('Livre[id='.$id.'] inexistante');
        $form = $this->createForm(LivreType::class, $livre);

        $form->add('submit', SubmitType::class, array('label' => 'Modifer'));

        $form->handleRequest($request);
        if($form->isSubmitted()){
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            return $this->redirectToRoute('bookland_editLivre', array('livre' => $this->repo->findAll()));
        }
        return $this->render('booklandLivre/modifierLivre.html.twig', array('monFormulaire' => $form->createView()));
    }

    public function removeLivre($id){
        $livre = $this->repo->find($id);
        if(!$livre)
            throw $this->createNotFoundException('Livre[id='.$id.'] inexistante');

        $em = $this->getDoctrine()->getManager();
        $em->remove($livre);
        $em->flush();

        return $this->redirectToRoute('bookland_editLivre', array('livre' => $this->repo->findAll()));

    }

    public function editLivre(Request $request){
        $livreSearch = new LivreSearch();

        $form = $this->createForm(LivreSearchType::class, $livreSearch);
        $form->handleRequest($request);

        $livreSearch = $this->repo->findLivre($livreSearch);

        return $this->render('booklandLivre/editLivre.html.twig', array('monFormulaire'=> $form->createView(),'livre'=> $livreSearch));
    }

    public function showLivre($id){

        return $this->render('booklandLivre/showLivre.html.twig', array('livre' => $this->repo->find($id)));
    }
}