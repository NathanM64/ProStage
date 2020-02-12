<?php

namespace App\Repository;

use App\Entity\Stage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Stage|null find($id, $lockMode = null, $lockVersion = null)
 * @method Stage|null findOneBy(array $criteria, array $orderBy = null)
 * @method Stage[]    findAll()
 * @method Stage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Stage::class);
    }

    public function getStagesParEntreprise($nom)
    {
        return $this->createQueryBuilder('s')
                    ->join ('s.entreprise', 'e')
                    ->where('e.nom = :nomEntreprise')
                    ->setParameter('nomEntreprise', $nom)
                    ->getQuery()
                    ->getResult()
                ;
    }

    public function getStagesParFormation($nom)
    {   
        //Récupération du gestionnaire d'entité
        $gestionnaireEntite = $this->getEntityManager();

        $requete= $gestionnaireEntite->createQuery(
            'SELECT s
            FROM App\Entity\Stage s
            JOIN s.formations f
            WHERE f.nomComplet = :nomFormation');

            $requete->setParameter('nomFormation',$nom);

            return $requete->execute();
    }
    // /**
    //  * @return Stage[] Returns an array of Stage objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Stage
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
