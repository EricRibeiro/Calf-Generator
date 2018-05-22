<?php

namespace Application\Controller;

use Application\Helper\HelperEstacao;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\View\View;

class HelperController extends AbstractActionController
{
    private $sm;
    private $entityManager;

    function __construct($sm)
    {
        $this->sm = $sm;
        $this->entityManager = $this->sm->get('Doctrine\ORM\EntityManager');
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
