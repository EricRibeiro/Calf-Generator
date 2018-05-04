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
