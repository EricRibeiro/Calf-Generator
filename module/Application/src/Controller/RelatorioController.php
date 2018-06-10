<?php
/**
 * Created by IntelliJ IDEA.
 * User: ericribeiro
 * Date: 09/06/18
 * Time: 22:01
 */

namespace Application\Controller;

use Doctrine\Common\Collections\ArrayCollection;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Json;
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

    function getProtocolosAction()
    {
        if ($this->request->isPost()) {
            $response = $this->getResponse();

            $idEstacao = $this->request->getPost('idEstacao');

            $estacao = $this->entityManager
                ->getRepository('Application\Entity\Estacao')
                ->find($idEstacao);

            $protocolos = $this->entityManager
                ->getRepository('Application\Entity\Protocolo')
                ->findBy(array('estacao' => $estacao));

            $jsonProtocolos = [];

            foreach ($protocolos as $p) {
                $jsonProtocolos[] = json_encode($p);
            }

            return $response->setContent(json_encode($jsonProtocolos));
        }
    }

    function getDadosAction()
    {
        if ($this->request->isPost()) {
            $response = $this->getResponse();
            $idEstacao = $this->request->getPost('idEstacao');
            $idProtInduzidas = $this->request->getPost('idProtInduzidas');
            $idProtNaoInduzidas = $this->request->getPost('idProtNaoInduzidas');

            $dadosProtInduzidas = $this->getDadosProtInduzidas($idEstacao, $idProtInduzidas);
            $dadosProtNaoInduzidas = $this->getDadosProtNaoInduzidas($idEstacao, $idProtNaoInduzidas);

            return $response->setContent("BATATA");
        }
    }

    function getDadosProtInduzidas($idEstacao, $idProtInduzidas) {
        $protocolo = $this->entityManager
            ->getRepository('Application\Entity\Protocolo')
            ->find($idProtInduzidas);

        $novilhasNoProt = $this->entityManager
            ->getRepository('Application\Entity\Protocolo')
            ->createQueryBuilder('animal');

        // Codigo restante para geração de dados do protocolo
    }

    function getDadosProtNaoInduzidas() {
        return "QUENTE";
    }
}