<?php

namespace FE\FavorisBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * FavorisRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class FavorisRepository extends EntityRepository
{
    public function countFavoris()
    {
        return $this->createQueryBuilder('f')->select('f.url, COUNT(f.url) as nb_fav')
                                             ->where('f.statifiable = true')
                                             ->groupBy('f.url')
                                             ->addOrderBy('nb_fav', 'DESC')
                                             ->addOrderBy('f.url', 'ASC')
                                             ->getQuery()
                                             ->getResult();
    }

    public function nbFavoris()
    {
        return $this->createQueryBuilder('f')->select('COUNT(f.url) AS nbFavoris')
                                             ->groupBy('f.url')
                                             ->getQuery()
                                             ->getResult();
    }

    public function userFavoris($id)
    {
        return $this->createQueryBuilder('f')->where('f.idUser = :id')
                                             ->setParameter('id', $id)
                                             ->groupBy('f.url')
                                             ->getQuery()
                                             ->getResult();
    }

    public function urlExist($id, $url)
    {
        return $this->createQueryBuilder('f')->where('f.idUser = :id')
                                             ->andWhere('f.url = :url')
                                             ->setParameter('id', $id)
                                             ->setParameter('url', $url)
                                             ->getQuery()
                                             ->getResult();
    }
}
