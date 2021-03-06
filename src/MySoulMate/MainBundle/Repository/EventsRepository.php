<?php

namespace MySoulMate\MainBundle\Repository;

/**
 * EventsRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class EventsRepository extends \Doctrine\ORM\EntityRepository
{
    public function eventRecherche($userr)
    {
        $q = $this->getEntityManager()
            ->createQuery("Select m from MySoulMateMainBundle:Events m where m.typeEvt LIKE :userr")
            ->setParameter('userr','%'.$userr.'%');


        return $q->getResult();
    }

    public function clubRecherche2($userr)
    {
        $q = $this->getEntityManager()
            ->createQuery("Select m from UserBundle:User m where m.category LIKE :userr and m.roles LIKE :roles")
            ->setParameter('userr','%'.$userr.'%')
            ->setParameter('roles', '%ROLE_RESPONSABLE%');


        return $q->getResult();
    }


}
