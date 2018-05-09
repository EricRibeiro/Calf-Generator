<?php


namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Controller\Factory;
use Application\Entity\IA;
use Application\Helper\HelperCronologia;
use Application\Helper\HelperQuery;



class IAController extends AbstractActionController
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
        $ias = $this->entityManager
            ->getRepository('Application\Entity\IA')
            ->findAllIAs();

        $view_params = array(
            'ias' => $ias,
        );

        return new ViewModel($view_params);
    }

    public function editarAction()
    {
        $id = $this->params()->fromRoute('id');

        if (is_null($id)) {
            $id = $this->request->getPost('id');
        }

        $entityManager = $this->sm->get('Doctrine\ORM\EntityManager');

        $repositorio = $entityManager->getRepository("Application\Entity\IA");
        $repositorioAnimal = $entityManager->getRepository("Application\Entity\Animal");

        $ia = $repositorio->find($id);

        if ($this->request->isPost()) {

            $numero = $this->request->getPost('numero');

            $query = $repositorioAnimal->createQueryBuilder('o')->where('o.numero = :numero')->setParameter('numero', $numero)->getQuery();
            $animal = $query->getSingleResult();

            $ia->setDataInseminacao($this->request->getPost('dataInseminacao'));
            $ia->setAnimal($animal);

            $entityManager->persist($ia);
            $entityManager->flush();

            return $this->redirect()->toRoute('app/ia', array(
                'controller' => 'index',
                'action' => 'index',
            ));
        }



        return new ViewModel(['ia' => $ia]);
    }

    public function cadastrarAction()
    {   

         if ($this->request->isPost()) {
            self::cadastrar();
        }

        $estacao = $this->entityManager
            ->getRepository('Application\Entity\Estacao')
            ->findUltimaEstacaoNoAno();

        $minimoDeDias = 35  ;
        $animais = $this->entityManager
            ->getRepository('Application\Entity\Animal')
            ->findAllAnimaisAptosOuPosPartoComMinimoDeDiasNaUltimaEstacao($estacao, $minimoDeDias);

        $repositorioProtocolo = $this->entityManager->getRepository('Application\Entity\Protocolo');
        $ultimoProtocolo = HelperQuery::getUltimaInsercao($repositorioProtocolo);
        $numProxProtocolo = (is_null($ultimoProtocolo)) ? 1 : $ultimoProtocolo->getNumero() + 1;
        $view_params = array(
            'estacao' => $estacao
        
            
        );

        return new ViewModel($view_params);

        /*ANTIGO cadastrarAction
        $entityManager = $this->sm->get('Doctrine\ORM\EntityManager');
        $repositorio = $entityManager->getRepository('Application\Entity\Animal');
       
        if ($this->request->isPost()) {
            $numeroAnimal = $this->request->getPost('numeroAnimal');
            $dataInseminacao = $this->request->getPost('dataInseminacao');

            $query = $repositorio->createQueryBuilder('o')->where('o.numero = :numeroAnimal')->setParameter('numeroAnimal', $numeroAnimal)->getQuery();
            $animal = $query->getSingleResult();

            $ia = new IA($animal, $dataInseminacao);

            $entityManager->persist($ia);
            $entityManager->flush();
        }

        return $this->redirect()->toRoute('app/ia', array(
            'controller' => 'index',
            'action' => 'index',
        ));

        */

        return new ViewModel();
    }

    private function cadastrar()
    {
        $numeroDoAnimal = $this->request->getPost('numeroDoAnimal');
        $idEstacao = $this->request->getPost('idEstacao');
        $dataDeInseminacao = $this->request->getPost('dataDeInseminacao');
        $dataDeRetornoAoCio = $this->request->getPost('dataDeRetornoAoCio');
        $dataDeDiagnostico1 = $this->request->getPost('dataDeDiagnostico1');
        $dataDeDiagnostico2 = $this->request->getPost('dataDeDiagnostico2');

        $animais = explode("-", $animais);
        $estacao = $this->entityManager->find('Application\Entity\Estacao', $idEstacao);
        $estado = $this->entityManager->find('Application\Entity\Estado', 2);
        $protocolo = new Protocolo($numeroDoProtocolo, $estado);
        $this->entityManager->persist($protocolo);

        foreach ($animais as $idAnimal) {
            $animal = $this->entityManager->find('Application\Entity\Animal', $idAnimal);
            $classificacao = $animal->getUltimaClassificacao()->getClassificacaoInicial();

            $ia = new IA($animal, $estacao, $protocolo, $dataDeInseminacao, $dataDeRetornoAoCio, $dataDeDiagnostico1, $dataDeDiagnostico2);
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


