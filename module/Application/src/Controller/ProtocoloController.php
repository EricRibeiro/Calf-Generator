<?php
/**
 * Created by IntelliJ IDEA.
 * User: ericribeiro
 * Date: 22/04/18
 * Time: 03:08
 */

namespace Application\Controller;

use Application\Entity\Protocolo;
use Application\Helper\HelperQuery;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Entity\IA;
use Application\Helper\HelperCronologia;
use Application\Helper\HelperEntityManager;




class ProtocoloController extends AbstractActionController
{
    private $entityManager;

    function __construct()
    {
        $this->entityManager = HelperEntityManager::$entityManager;
    }

    public function indexAction()
    {
        $ias = $this->entityManager
            ->getRepository('Application\Entity\IA')
            ->createQueryBuilder('ia')
            ->groupBy('ia.protocolo')
            ->getQuery()
            ->getResult();

        $view_params = array(
            'ias' => $ias,
        );

        return new ViewModel($view_params);
    }

    public function cadastrarAction()
    {
        if ($this->request->isPost()) {
            self::cadastrar();
        }

        $estacao = $this->entityManager
            ->getRepository('Application\Entity\Estacao')
            ->findUltimaEstacaoNoAno();

        $minimoDeDias = 35;
        $animais = $this->entityManager
            ->getRepository('Application\Entity\Animal')
            ->findAllAnimaisParaProtocoloComMinimoDeDiasNaUltimaEstacao($estacao, $minimoDeDias);

        $repositorioProtocolo = $this->entityManager->getRepository('Application\Entity\Protocolo');
        $ultimoProtocolo = HelperQuery::getUltimaInsercao($repositorioProtocolo);
        $numProxProtocolo = (is_null($ultimoProtocolo)) ? 1 : $ultimoProtocolo->getNumero() + 1;
        $view_params = array(
            'estacao' => $estacao,
            'animais' => $animais,
            'numProxProtocolo' => $numProxProtocolo
        );

        return new ViewModel($view_params);
    }

    private function cadastrar()
    {
        $numeroDoProtocolo = $this->request->getPost('numeroDoProtocolo');
        $idEstacao = $this->request->getPost('idEstacao');
        $dataDeInseminacao = $this->request->getPost('dataDeInseminacao');
        $dataDeRetornoAoCio = $this->request->getPost('dataDeRetornoAoCio');
        $dataDeDiagnostico1 = $this->request->getPost('dataDeDiagnostico1');
        $dataDeDiagnostico2 = $this->request->getPost('dataDeDiagnostico2');
        $animais = $this->request->getPost('lsIDsAnimais');

        $animais = explode("-", $animais);
        $estacao = $this->entityManager->find('Application\Entity\Estacao', $idEstacao);
        $estado = $this->entityManager->find('Application\Entity\Estado', 2);
        $protocolo = new Protocolo($numeroDoProtocolo, $estacao, $estado);
        
        $saiuProtocolo = false;
        $this->entityManager->persist($protocolo);

        foreach ($animais as $idAnimal) {
            $animal = $this->entityManager->find('Application\Entity\Animal', $idAnimal);
            $classificacao = $animal->getUltimaClassificacao()->getClassificacaoInicial();
            
            $ia = new IA($animal, $estacao, $protocolo, $dataDeInseminacao, $dataDeRetornoAoCio, $dataDeDiagnostico1, $dataDeDiagnostico2, $estado, $saiuProtocolo);
            $this->entityManager->persist($ia);

            HelperCronologia::criarCronologia($this->entityManager, $animal, $classificacao, $estacao, $ia, $estado);

            $this->entityManager->flush();
        }

        $this->entityManager->flush();

        $this->flashMessenger()->addSuccessMessage("Protocolo cadastrado com sucesso.");
        return $this->redirect()->toRoute('app/protocolo', array(
            'controller' => 'protocolo',
            'action' => 'index',
        ));
    }

    public function listarAction() {

        $numProtocolo = $this->params()->fromRoute('id');
        $protocolo = $this->entityManager
            ->getRepository('Application\Entity\Protocolo')
            ->findOneBy(array('numero' => $numProtocolo));

        if (!is_null($protocolo))
        {
            $proximoEstado = $protocolo->getEstado()->getId() + 1;
            $proximoEstado = $this->entityManager->find('Application\Entity\Estado', $proximoEstado);

            $animais = $this->entityManager
                ->getRepository('Application\Entity\Animal')
                ->findAllAnimaisNoProtocolo($protocolo);

           
            $view_params = array(
                'animais' => $animais,
                'proximoEstado' => $proximoEstado,
                'protocolo' => $protocolo
            );

            return new ViewModel($view_params);
        }
        return $this->redirect()->toRoute('app/protocolo', array(
            'controller' => 'protocolo',
            'action' => 'index'
        ));
    }

    public function alterarEstadoAction() {
        if ($this->request->isPost()) {
            $numProtocolo = $this->params()->fromRoute('id');
            $idEstado = $this->params()->fromRoute('pid');
            $lsIDsAnimaisEstados = $this->request->getPost('lsIDsAnimaisEstados');

            $estado = $this->entityManager->find('Application\Entity\Estado', $idEstado);

            $protocolo = $this->entityManager
                ->getRepository('Application\Entity\Protocolo')
                ->findOneBy(array('numero' => $numProtocolo));
            $protocolo->setEstado($estado);

            $this->entityManager->persist($protocolo);

            $lsIDsAnimaisEstados = explode("-", $lsIDsAnimaisEstados);

            foreach ($lsIDsAnimaisEstados as $ids) {
                $tupla = explode("/", $ids);
                $idAnimal = $tupla[0];
                $idEstado = $tupla[1];

                $animal = $this->entityManager->find('Application\Entity\Animal', $idAnimal);

                $classificacao = $animal->getUltimaClassificacao()->getClassificacaoInicial();
                $ia = $this->entityManager
                    ->getRepository('Application\Entity\IA')
                    ->findOneBy(array('protocolo' => $protocolo, 'animal' => $animal));
                $estacao = $ia->getEstacao();
                $estado = $this->entityManager->find('Application\Entity\Estado', $idEstado);

                if($idEstado==1){

                    $ia->setHasProtocolo(true);

                    $this->entityManager->persist($ia);

                    HelperCronologia::criarCronologia($this->entityManager, $animal, $classificacao, $estacao, $ia, $estado);

                }else if($estado!=null){
                    HelperCronologia::criarCronologia($this->entityManager, $animal, $classificacao, $estacao, $ia, $estado);

                    $this->entityManager->flush();
                }
            }

            $this->entityManager->flush();

            $this->flashMessenger()->addSuccessMessage("Estados alterados com sucesso.");
            return $this->redirect()->toRoute('app/protocolo', array(
                'controller' => 'protocolo',
                'action' => 'index',
            ));
        }

        return $this->redirect()->toRoute('app/protocolo', array(
            'controller' => 'protocolo',
            'action' => 'index'
        ));
    }
}