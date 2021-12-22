<?php

namespace App\Repository;

use App\Entity\Auteur;
use App\Entity\AuteurSearch;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Auteur|null find($id, $lockMode = null, $lockVersion = null)
 * @method Auteur|null findOneBy(array $criteria, array $orderBy = null)
 * @method Auteur[]    findAll()
 * @method Auteur[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AuteurRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Auteur::class);
    }

    public function findAuteur(AuteurSearch $auteurSearch){
        $query = $this->createQueryBuilder('a');

        if($auteurSearch->getNomPrenom()){
            $query = $query->andWhere('a.nomPrenom LIKE :name')
                ->setParameter('name', '%'.$auteurSearch->getNomPrenom().'%');
        }
        if($auteurSearch->getSexe()){
            $query = $query->andWhere('a.sexe = :s')
                ->setParameter('s', $auteurSearch->getSexe());
        }
        if($auteurSearch->getDateDeNaissance()){
            $query = $query->andWhere('a.dateDeNaissance = :date')
                ->setParameter('date', $auteurSearch->getDateDeNaissance()->format('Y-m-d'));
        }
        if($auteurSearch->getNationalite()){
            $query = $query->andWhere('a.nationalite LIKE :natio')
                ->setParameter('natio', $auteurSearch->getNationalite());
        }
        if($auteurSearch->getNbLivre()){
            $query = $query->innerJoin('a.livres', 'l')
                ->groupBy('a.id')
                ->andHaving($query->expr()->gte($query->expr()->count('l.id'),
                    $auteurSearch->getNbLivre()));
        }
        return $query->getQuery()->getResult();
    }
    public function findAGenre(Auteur $auteur){
        $query = $this->createQueryBuilder('a')
            ->select('g.nom')
            ->innerJoin('a.livres', 'l')
            ->innerJoin('l.genres', 'g')
            ->where('a.id = :id')
            ->orderBy('l.dateDeParution', 'ASC')
            ->setParameter('id', $auteur->getId());

        return array_unique($query->getQuery()->getResult(), SORT_REGULAR);
    }



    // /**
    //  * @return Auteur[] Returns an array of Auteur objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Auteur
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
