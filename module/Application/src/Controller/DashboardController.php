<?php

namespace Application\Controller;

use Application\Helper\HelperEstacao;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class DashboardController extends AbstractActionController
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
        $animais = $this->entityManager
            ->getRepository('Application\Entity\Animal')
            ->findAll();

        $aptos = $this->entityManager
            ->getRepository('Application\Entity\Cronologia')
            ->findAnimaisAptos();

        $diagnostico1 = $this->entityManager
            ->getRepository('Application\Entity\Cronologia')
            ->findAnimaisDiagnostico1();

        $diagnostico2 = $this->entityManager
            ->getRepository('Application\Entity\Cronologia')
            ->findAnimaisDiagnostico2();

        $posparto = $this->entityManager
            ->getRepository('Application\Entity\Cronologia')
            ->findAnimaisPosParto();

        $estacao = $this->entityManager
            ->getRepository('Application\Entity\Estacao')
            ->findUltimaEstacao();



        $view_params = array(
            'animais' => $animais,
            'aptos' => $aptos,
            'diagnostico1' => $diagnostico1,
            'diagnostico2' => $diagnostico2,
            'posparto' => $posparto,
            'estacao' => $estacao
        );

        return new ViewModel($view_params);
    }
}
