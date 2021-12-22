<?php

namespace App\Controller;

use App\Entity\Genre;
use App\Entity\GenreSearch;
use App\Form\GenreSearchType;
use App\Form\GenreType;
use App\Repository\GenreRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;

class GenreController extends AbstractController {

    private $repo;
    public function __construct(GenreRepository $repo){
        $this->repo = $repo;
    }

    public function addGenre(Request $request){
        $genre = new Genre;

        $form = $this->createForm(GenreType::class, $genre);
        $form->add('submit', SubmitType::class, array('label' => 'Ajouter'));
        $form->handleRequest($request);

        if($form->isSubmitted()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($genre);
            $em->flush();

            return $this->redirectToRoute('bookland_editGenre', array('genre' => $this->repo->findAll()));
        }

        return $this->render('booklandGenre/addGenre.html.twig', array('monFormulaire' => $form->createView()));
    }

    public function modifierGenre($id, Request $request){
        $genre = $this->repo->find($id);

        if(!$genre)
            throw $this->createNotFoundException('Auteur[id='.$id.'] inexistante');
        $form = $this->createForm(GenreType::class, $genre);
        $form->add('submit', SubmitType::class, array('label' => 'Modifier'));
        $form->handleRequest($request);

        if($form->isSubmitted()){
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            return $this->redirectToRoute('bookland_editGenre', array('genre' => $this->repo->findAll()));
        }
        return $this->render('booklandGenre/modifierGenre.html.twig', array('monFormulaire' => $form->createView()));
    }

    public function removeGenre($id, Request $request){
        $genre = $this->repo->find($id);
        if(!$genre)
            throw $this->createNotFoundException('Auteur[id='.$id.'] inexistante');

        if($this->repo->findNbPages($genre)[0]['sum'] == 0) {
            dump($genre);
            $em = $this->getDoctrine()->getManager();
            $em->remove($genre);
            $em->flush();

        }

        return $this->redirectToRoute('bookland_editGenre', array('genre' => $this->repo->findAll()));

    }

    public function editGenre(Request $request){
        $genreSearch = new GenreSearch();
        $form = $this->createForm(GenreSearchType::class, $genreSearch);
        $form->handleRequest($request);

        $genreSearch = $this->repo->findGenre($genreSearch);
        return $this->render('booklandGenre/editGenre.html.twig', array('monFormulaire'=> $form->createView(),'genre'=> $genreSearch,
                                                                            'auteurs' => $this->repo->findGSAuteurs()));
    }

    public function showGenre($id){
        $genre = $this->repo->find($id);
        if(!$genre)
            throw $this->createNotFoundException('Auteur[id='.$id.'] inexistante');


        return $this->render('booklandGenre/showGenre.html.twig', array('genre' => $genre,
                                                                            'sum' => $this->repo->findNbPages($genre),
                                                                            'moy' => $this->repo->findMPages($genre),
                                                                            'auteur' => $this->repo->findGAuteurs($genre)));
    }

}