<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Home,
    Doctrine\ORM\EntityRepository,
    AppBundle\Entity\HomeNotes;

class HomeNotesRepository extends EntityRepository
{
    /**
     * @param Home $model
     *
     * @return HomeNotes[]
     */
    public function findAllRecentNotesForHome(Home $model)
    {
        return $this->createQueryBuilder('home_notes')
            ->andWhere('home_notes.home = :home')
            ->setParameter('home',$model)
            ->andWhere('home_notes.createdAt > :date')
            ->setParameter('date', new \DateTime('-3 months'))
            ->getQuery()
            ->execute();
    }
}