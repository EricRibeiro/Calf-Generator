<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Helper\HelperEntityManager;
use Doctrine\DBAL\Exception\ConnectionException;


class DashboardController extends AbstractActionController
{
    private $entityManager;

    function __construct()
    {
        $this->entityManager = HelperEntityManager::$entityManager;
    }

    public function indexAction()
    {   
        try{

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
            $sgbd = true;
            $view_params = array(
                'animaisAptos' => $animaisAptos,
                'animaisD1' => $animaisD1,
                'animaisD2' => $animaisD2,
                'animaisPosParto' => $animaisPosParto,
                'sgbd' => $sgbd,    
                'estacao' => $estacao
            );

            }catch( ConnectionException $e){

                $this->flashMessenger()->addErrorMessage("Conexão com o banco de dados perdida, reiniciar o servidor.");
                $sgbd = false;
                $view_params = array(
                    'sgbd' => $sgbd
                    );

                return new ViewModel($view_params);


            }

            return new ViewModel($view_params);

    }
}
