<?php

namespace App\Repository;

use App\Entity\Genre;
use App\Entity\GenreSearch;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Genre|null find($id, $lockMode = null, $lockVersion = null)
 * @method Genre|null findOneBy(array $criteria, array $orderBy = null)
 * @method Genre[]    findAll()
 * @method Genre[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GenreRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Genre::class);
    }
    public function findGenre(GenreSearch $genreSearch){
        $query = $this->createQueryBuilder('g');
        if($genreSearch->getNom()){
            if($genreSearch->getNom()->count() > 0){
            $flag=0;
            foreach($genreSearch->getNom() as $name){
                $query = $query->orWhere("g.nom = :nom$flag")
                    ->setParameter("nom$flag", $name->getNom());
                $flag++;
            }
        }
        }

        return $query->getQuery()->getResult();
    }

    public function findNbPages(Genre $genre){
        $query = $this->createQueryBuilder('g')
            ->select('SUM (l.nbpages) AS sum')
            ->innerJoin('g.livres', 'l')
            ->where('g.id = :id')
            ->setParameter('id', $genre->getId());

        return $query->getQuery()->getResult();
    }

    public function findMPages(Genre $genre){
        $query = $this->createQueryBuilder('g')
            ->select('AVG (l.nbpages) AS moy')
            ->innerJoin('g.livres', 'l')
            ->where('g.id = :id')
            ->setParameter('id', $genre->getId());

        return $query->getQuery()->getResult();
    }

    public function findGAuteurs(Genre $genre){
        $query = $this->createQueryBuilder('g')
            ->select('DISTINCT a.nomPrenom')
            ->innerJoin('g.livres', 'l')
            ->innerJoin('l.auteurs', 'a')
            ->where('g.id = :id')
            ->setParameter('id', $genre->getId());

        return $query->getQuery()->getResult();
    }
    // /**
    //  * @return Genre[] Returns an array of Genre objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('g.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Genre
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
