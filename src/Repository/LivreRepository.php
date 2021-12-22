<?php

namespace App\Repository;

use App\Entity\Livre;
use App\Entity\LivreSearch;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;


/**
 * @method Livre|null find($id, $lockMode = null, $lockVersion = null)
 * @method Livre|null findOneBy(array $criteria, array $orderBy = null)
 * @method Livre[]    findAll()
 * @method Livre[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LivreRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Livre::class);
    }

    public function findLivre(LivreSearch $livreSearch){
        $query = $this->createQueryBuilder('l');

        if($livreSearch->getTitre()){
            $query = $query->andWhere('l.titre LIKE :titre')
                ->setParameter('titre', '%'.$livreSearch->getTitre().'%');
        }
        if($livreSearch->getNbpages()){
            $query = $query->andWhere('l.nbpages ='.$livreSearch->getNbpages());
        }
        if($livreSearch->getDateDeParution()){
            $query = $query->andWhere('l.dateDeParution >= :datebegin')
                ->setParameter('datebegin', $livreSearch->getDateDeParution()->format('Y-m-d'));
        }
        if($livreSearch->getDateDeParution1()){
            $query = $query->andWhere('l.dateDeParution <= :dateend')
                ->setParameter('dateend', $livreSearch->getDateDeParution1()->format('Y-m-d'));
        }
        if($livreSearch->getNote()){
            $query = $query->andWhere('l.note >='. $livreSearch->getNote());
        }
        if($livreSearch->getNote1()){
            $query = $query->andWhere('l.note <='. $livreSearch->getNote1());
        }
        return $query->getQuery()->getResult();
    }



    // /**
    //  * @return Livre[] Returns an array of Livre objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Livre
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
