<?php

namespace Application\Controller;

use Application\Helper\HelperEstacao;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\View\View;

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
        $estacao = $this->entityManager
            ->getRepository('Application\Entity\Estacao')
            ->findUltimaEstacao();

        $aptos = $this->entityManager
            ->getRepository('Application\Entity\Cronologia')
            ->findAnimaisPorEstadoNaUltimaEstacao(1, $estacao);

        $diagnostico1 = $this->entityManager
            ->getRepository('Application\Entity\Cronologia')
            ->findAnimaisPorEstadoNaUltimaEstacao(2, $estacao);

        $diagnostico2 = $this->entityManager
            ->getRepository('Application\Entity\Cronologia')
            ->findAnimaisPorEstadoNaUltimaEstacao(3, $estacao);

        $posparto = $this->entityManager
            ->getRepository('Application\Entity\Cronologia')
            ->findAnimaisPorEstadoNaUltimaEstacao(5, $estacao);

        $view_params = array(
            'aptos' => $aptos,
            'diagnostico1' => $diagnostico1,
            'diagnostico2' => $diagnostico2,
            'posparto' => $posparto,
            'estacao' => $estacao
        );

        return new ViewModel($view_params);
    }
}
