<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Helper\HelperEntityManager;

class HelperController extends AbstractActionController
{
    private $entityManager;

    function __construct()
    {
        $this->entityManager = HelperEntityManager::$entityManager;
    }

    public function indexAction()
    {
        return new ViewModel();
    }

    public function getUltimaIA($animal)
    {
        $this->$entityManager->getRepository("Application\Entity\IA")
            ->createQueryBuilder('ia')
            ->where("ia.animal = :animal")
            ->setParameter("animal", $animal)
            ->orderBy("ia.id", "DESC")
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();
    }
}
