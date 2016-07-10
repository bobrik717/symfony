<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Home,
    Doctrine\ORM\EntityRepository;

class HomeRepository extends EntityRepository
{
    /**
     * @return Home[]
     */
    public function findAllPublishedOrderBySize()
    {
        return $this->createQueryBuilder('home')
            ->andWhere('home.isPublished = :isPublished')
            ->setParameter('isPublished',true)
            ->orderBy('home.speciesCount','DESC')
            ->getQuery()
            ->execute();
    }
}