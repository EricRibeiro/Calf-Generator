<?php
/**
 * Created by IntelliJ IDEA.
 * User: ericribeiro
 * Date: 09/06/18
 * Time: 22:01
 */

namespace Application\Controller;

use Application\Helper\HelperRelatorios\HelperRelatorio;
use Application\Helper\HelperRelatorios\HelperTxPrenhezNovilhas;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Helper\HelperEntityManager;

class RelatorioController extends AbstractActionController
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

    public function txPrenhezProtocoloAction()
    {
        $estacao = $this->entityManager
            ->getRepository('Application\Entity\Protocolo')

        $view_params = array(
            'estacao' => $estacao,
        );

        return new ViewModel($view_params);
    }

    public function txPrenhezNovilhasAction()
    {
        $estacao = $this->entityManager
            ->getRepository('Application\Entity\Estacao')
            ->findAll();

        $view_params = array(
            'estacao' => $estacao,
        );

        return new ViewModel($view_params);
    }

    function getJsonProtocolosDaEstacaoAction()
    {
        if ($this->request->isPost()) {
            $response = $this->getResponse();
            $idEstacao = $this->request->getPost('idEstacao');
            $content = HelperRelatorio::getJsonProtocolosDaEstacao($idEstacao);
            return $response->setContent($content);
        }
    }

    function getDadosTxPrenhezNovilhasAction()
    {
        if ($this->request->isPost()) {
            $response = $this->getResponse();
            $idEstacao = $this->request->getPost('idEstacao');
            $idProtInduzidas = $this->request->getPost('idProtInduzidas');
            $idProtNaoInduzidas = $this->request->getPost('idProtNaoInduzidas');

            $content = HelperTxPrenhezNovilhas::getDadosTxPrenhezNovilhasAction($idEstacao, $idProtInduzidas, $idProtNaoInduzidas);
            return $response->setContent($content);
        }
    }

    function getDadosTxPrenhezProtocoloAction()
    {
        if ($this->request->isPost()) {
            $response = $this->getResponse();
            $idEstacao = $this->request->getPost('idEstacao');

            $content = HelperTxPrenhezProtocolo::getDadosTxPrenhezNovilhasAction($idEstacao);
            return $response->setContent($content);
        }
    }


}