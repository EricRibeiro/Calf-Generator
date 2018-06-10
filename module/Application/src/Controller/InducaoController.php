<?php
/**
 * Created by IntelliJ IDEA.
 * User: ericribeiro
 * Date: 22/04/18
 * Time: 03:08
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Helper\HelperCronologia;
use Application\Helper\HelperEntityManager;
use Application\Entity\Inducao;
use Application\Helper\HelperQuery;
use Application\Helper\HelperInducao;


class InducaoController extends AbstractActionController
{
    private $entityManager;

    function __construct()
    {
        $this->entityManager = HelperEntityManager::$entityManager;
    }

    public function indexAction()
    {
        $inducoes = $this->entityManager
            ->getRepository('Application\Entity\Inducao')
            ->createQueryBuilder('inducao')
            ->groupBy('inducao')
            ->getQuery()
            ->getResult();

        $view_params = array(
            'inducoes' => $inducoes,
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

        $animais = $this->entityManager
            ->getRepository('Application\Entity\Animal')
            ->findAllNovilhasParaInducaoNaEstacao($estacao);

        $repositorioInducao = $this->entityManager->getRepository('Application\Entity\Inducao');
        $ultimaInducao = HelperQuery::getUltimaInsercao($repositorioInducao);
        $numProxProtocolo = (is_null($ultimaInducao)) ? 1 : $ultimaInducao->getId() + 1;
        $view_params = array(
            'estacao' => $estacao,
            'animais' => $animais,
            'numProxProtocolo' => $numProxProtocolo
        );

        return new ViewModel($view_params);
    }

    private function cadastrar()
    {       
        $numeroDaInducao = $this->request->getPost('numeroDaInducao');
        $idEstacao = $this->request->getPost('idEstacao');
        $dataDeInicio = $this->request->getPost('dataDeInicio');
        $dataDeFim = $this->request->getPost('dataDeFim');
        $animais = $this->request->getPost('lsIDsAnimais');

        $animais = explode("-", $animais);
        $estacao = $this->entityManager->find('Application\Entity\Estacao', $idEstacao);
        $estado = $this->entityManager->find('Application\Entity\Estado', 7);
        
        $inducao = new Inducao($dataDeInicio,$dataDeFim, $estacao);

        $this->entityManager->persist($inducao);

        $ia = null;

        foreach ($animais as $idAnimal) {

            $animal = $this->entityManager->find('Application\Entity\Animal', $idAnimal);
            $classificacao = $animal->getUltimaClassificacao()->getClassificacaoInicial();
            
            $animal->setInducao($inducao);

            //$ia = new IA($animal, $estacao, $protocolo, $dataDeInseminacao, $dataDeRetornoAoCio, $dataDeDiagnostico1, $dataDeDiagnostico2, $estado, $saiuProtocolo);
            $this->entityManager->persist($inducao);

            HelperCronologia::criarCronologia($this->entityManager, $animal, $classificacao, $estacao, (is_null($ia) ? null : $ia ), $estado);

            $this->entityManager->flush();
        }

        $this->entityManager->flush();

        $this->flashMessenger()->addSuccessMessage("Indução cadastrada com sucesso.");
        return $this->redirect()->toRoute('app/inducao', array(
            'controller' => 'inducao',
            'action' => 'index',
        ));
    }

    public function listarAction() {
        

        $numeroDaInducao = $this->params()->fromRoute('id');
        $inducao = $this->entityManager
            ->getRepository('Application\Entity\Inducao')
            ->findOneBy(array('id' => $numeroDaInducao));

        if (!is_null($inducao))
        {
            $animais = $this->entityManager
                ->getRepository('Application\Entity\Animal')
                ->findAllAnimaisNaInducao($inducao);

            $view_params = array(
                'animais' => $animais,
                'inducao' => $inducao
            );

            return new ViewModel($view_params);
        }
        return $this->redirect()->toRoute('app/inducao', array(
            'controller' => 'inducao',
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

                if($idEstado==1)
                    HelperCronologia::criarCronologia($this->entityManager, $animal, $classificacao, $estacao, null, $estado);
                
                else
                    HelperCronologia::criarCronologia($this->entityManager, $animal, $classificacao, $estacao, $ia, $estado);

                $this->entityManager->flush();
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