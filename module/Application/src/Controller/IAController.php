<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Controller\Factory;
use Application\Entity\IA;
use Application\Helper\HelperCronologia;
use Application\Helper\HelperEntityManager;
use Exception;


class IAController extends AbstractActionController
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
            ->findBy(array('saiuProtocolo' => true));
        $view_params = array(
            'ias' => $ias,
        );

        return new ViewModel($view_params);
    }

    public function editarAction()
    {

        $numIa = $this->params()->fromRoute('id');
        $ia = $this->entityManager
            ->getRepository('Application\Entity\IA')
            ->findOneBy(array('id' => $numIa));

        if (!is_null($ia)) {
            $proximoEstado = $ia->getEstado()->getId() + 1;
            $proximoEstado = $this->entityManager->find('Application\Entity\Estado', $proximoEstado);

            $animal = $this->entityManager
                ->getRepository('Application\Entity\Animal')
                ->find($ia->getAnimal()->getId());

            $view_params = array(
                'animal' => $animal,
                'proximoEstado' => $proximoEstado
            );

            return new ViewModel($view_params);
        }

        return $this->redirect()->toRoute('app/ia', array(
            'controller' => 'ia',
            'action' => 'index'
        ));


    }


    public function alterarEstadoAction()
    {

        if ($this->request->isPost()) {

            $idIa = $this->params()->fromRoute('id');
            $numEstado = $this->request->getPost('estado');

            $ia = $this->entityManager
                ->getRepository('Application\Entity\IA')
                ->findOneBy(array('id' => $idIa));

            $estado = $this->entityManager->find('Application\Entity\Estado', $numEstado);

            $ia->setEstado($estado);

            $estacao = $ia->getEstacao();

            $animal = $this->entityManager
                ->getRepository('Application\Entity\Animal')
                ->findOneBy(array('id' => $ia->getAnimal()));

            $classificacao = $animal->getUltimaClassificacao()->getClassificacaoInicial();

            $this->entityManager->persist($ia);

            HelperCronologia::criarCronologia($this->entityManager, $animal, $classificacao, $estacao, $ia, $estado);

            $this->entityManager->flush();

            $this->flashMessenger()->addSuccessMessage("Estado alterado com sucesso.");

            return $this->redirect()->toRoute('app/ia', array(
                'controller' => 'ia',
                'action' => 'index',
            ));

        }

        return $this->redirect()->toRoute('app/ia', array(
            'controller' => 'ia',
            'action' => 'index'
        ));
    }

    public function cadastrarAction()
    {

        if ($this->request->isPost()) {

            try {

                $numeroDoAnimal = $this->request->getPost('numeroDoAnimal');
                $idEstacao = $this->request->getPost('idEstacao');

                if (empty($idEstacao))

                    throw new Exception("Estação não cadastrada, não é possível cadastrar uma IA.");

                $animal = $this->entityManager->getRepository('Application\Entity\Animal')
                    ->findOneBy(array('numero' => $numeroDoAnimal));

                if (is_null($animal))

                    throw new Exception("Número do animal não encontrado.");

                $IaAnterior = $this->entityManager->getRepository('Application\Entity\IA')
                    ->findUltimaIA($animal);

                $protocolo = (is_null($IaAnterior)) ? null : $IaAnterior->getProtocolo();

                $classificacao = $animal->getUltimaClassificacao()->getClassificacaoInicial();

                $estacao = $this->entityManager->find('Application\Entity\Estacao', $idEstacao);
                $estado = $this->entityManager->find('Application\Entity\Estado', 2);

                if (is_null($protocolo))
                    $saiuProtocolo = false;
                else
                    $saiuProtocolo = true;

                $dataDeInseminacao = $this->request->getPost('dataDeInseminacao');
                $dataDeRetornoAoCio = $this->request->getPost('dataDeRetornoAoCio');
                $dataDeDiagnostico1 = $this->request->getPost('dataDeDiagnostico1');
                $dataDeDiagnostico2 = $this->request->getPost('dataDeDiagnostico2');

                $ia = new IA($animal, $estacao, $protocolo, $dataDeInseminacao, $dataDeRetornoAoCio, $dataDeDiagnostico1, $dataDeDiagnostico2, $estado, $saiuProtocolo);

                $this->entityManager->persist($ia);

                HelperCronologia::criarCronologia($this->entityManager, $animal, $classificacao, $estacao, $ia, $estado);

                $this->flashMessenger()->addSuccessMessage("IA cadastrada com sucesso.");

            } catch (Exception $e) {

                $this->flashMessenger()->addErrorMessage($e->getMessage());

            }

            $this->entityManager->flush();

            return $this->redirect()->toRoute('app/ia', array(
                'controller' => 'index',
                'action' => 'cadastrar',
            ));

        } else {

            $estacao = $this->entityManager
                ->getRepository('Application\Entity\Estacao')
                ->findUltimaEstacaoNoAno();

            $view_params = array(
                'estacao' => $estacao
            );

        }

        return new ViewModel($view_params);

    }

    public function removerAction()
    {
        $id = $this->params()->fromRoute('id');

        if (!is_null($id)) {
            $entityManager = $this->sm->get('Doctrine\ORM\EntityManager');
            $repositorio = $entityManager->getRepository("Application\Entity\IA");

            $ia = $repositorio->find($id);
            $entityManager->remove($ia);
            $entityManager->flush();
        }

        return $this->redirect()->toRoute('app/ia', array(
            'controller' => 'index',
            'action' => 'index',
        ));
    }
}


