<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Helper\HelperEntityManager;

class DashboardController extends AbstractActionController
{
    private $entityManager;

    function __construct()
    {
        $this->entityManager = HelperEntityManager::$entityManager;
    }

    public function indexAction()
    {
        $estacao = $this->entityManager
            ->getRepository('Application\Entity\Estacao')
            ->findUltimaEstacaoNoAno();

        $animaisAptos = $this->entityManager
            ->getRepository('Application\Entity\Animal')
            ->findAnimaisPorEstadoNaUltimaEstacao(1, $estacao);

        $animaisD1 = $this->entityManager
            ->getRepository('Application\Entity\Animal')
            ->findAnimaisPorEstadoNaUltimaEstacao(2, $estacao);

        $animaisD2 = $this->entityManager
            ->getRepository('Application\Entity\Animal')
            ->findAnimaisPorEstadoNaUltimaEstacao(3, $estacao);

        $animaisPosParto = $this->entityManager
            ->getRepository('Application\Entity\Animal')
            ->findAnimaisPorEstadoNaUltimaEstacao(5, $estacao);

        $view_params = array(
            'animaisAptos' => $animaisAptos,
            'animaisD1' => $animaisD1,
            'animaisD2' => $animaisD2,
            'animaisPosParto' => $animaisPosParto,
            'estacao' => $estacao
        );

        return new ViewModel($view_params);
    }
}
