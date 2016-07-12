<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Home,
    Doctrine\ORM\EntityRepository;

class HomeRepository extends EntityRepository
{
    /**
     * @return Home[]
     */
    public function findAllPublishedOrderRecentlyActive()
    {
        return $this->createQueryBuilder('home')
            ->andWhere('home.isPublished = :isPublished')
            ->setParameter('isPublished',true)
            ->leftJoin('home.notes', 'home_notes')
            ->orderBy('home_notes.createdAt', 'DESC')
            ->getQuery()
            ->execute();
    }
}