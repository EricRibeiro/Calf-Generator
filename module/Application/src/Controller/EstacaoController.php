<?php


namespace Application\Controller;

use Application\Entity\Animal;
use Application\Helper\Data;
use Application\Helper\HelperEstacao;
use Doctrine\Common\Collections\ArrayCollection;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Entity\Estacao;
use Application\Helper\HelperClassificacao;
use Application\Helper\HelperCronologia;

class EstacaoController extends AbstractActionController
{


    private $sm;
    private $entityManager;

    public function __construct($sm)
    {
        $this->sm = $sm;
        $this->entityManager = $this->sm->get('Doctrine\ORM\EntityManager');
    }

    public function indexAction()
    {
        $estacoes = $this->entityManager
            ->getRepository('Application\Entity\Estacao')
            ->findAll();

        $this->entityManager->flush();

        $view_params = array(
            'estacoes' => $estacoes,
        );

        return new ViewModel($view_params);
    }

    public function cadastrarAction()
    {
        if ($this->request->isPost()) {
            $dataInicio = $this->request->getPost('dataInicioEstacao');
            $dataFim = $this->request->getPost('dataTerminoEstacao');
            $animais = $this->request->getPost('lsIDsAnimais');
            $animais = explode("-", $animais);

            $estacao = new Estacao($dataInicio, $dataFim);
            $this->entityManager->persist($estacao);

            foreach ($animais as $idAnimal) {
                $this->cadastrarAnimalNaEstacao($idAnimal, $estacao);
            }

            $this->entityManager->flush();

            $this->flashMessenger()->addSuccessMessage("Estação cadastrada com sucesso.");

            return $this->redirect()->toRoute('app/estacao', array(
                'controller' => 'estacao',
                'action' => 'index',
            ));
        }

        $view_params = array(
            'animais' => $this->getAnimaisSemEstacao(),
            'estacao' => $this->getEstacaoDoAnoAtual()
        );

        return new ViewModel($view_params);

    }

    public function listarAction()
    {
        $id = $this->params()->fromRoute('id');

        if (is_null($id)) {
            $id = $this->request->getPost('id');
        }

        $estacao = $this->entityManager->find('Application\Entity\Estacao', $id);

        $view_params = array(
            'animaisNaEstacao' => $this->getAnimaisNaEstacao($estacao),
            'animaisSemEstacao' => $this->getAnimaisSemEstacao(),
            'estacao' => $estacao
        );

        return new ViewModel($view_params);
    }

    public function editarAction() {
        $idEstacao = $this->params()->fromRoute('id');
        $dataInicio = $this->request->getPost('dataInicioEstacao');
        $dataFinal = $this->request->getPost('dataTerminoEstacao');
        $lsIDsAnimaisAdicionados = $this->request->getPost('lsIDsAnimaisAdicionados');
        $lsIDsAnimaisRemovidos = $this->request->getPost('lsIDsAnimaisRemovidos');

        $estacao = $this->entityManager->find('Application\Entity\Estacao', $idEstacao);
        $estacao->setDataInicio($dataInicio);
        $estacao->setDataFinal($dataFinal);
        $this->entityManager->persist($estacao);

        if($lsIDsAnimaisAdicionados != '') {
            $lsIDs = explode("-", $lsIDsAnimaisAdicionados);

            foreach ($lsIDs as $idAnimal) {
                $this->cadastrarAnimalNaEstacao($idAnimal, $estacao);
            }

        }

        if($lsIDsAnimaisRemovidos != '') {
            $lsIDs = explode("-", $lsIDsAnimaisRemovidos);

            foreach ($lsIDs as $idAnimal) {
                $this->removerAnimalDaEstacao($idAnimal, $estacao);
            }

        }

        $this->entityManager->flush();

        $this->flashMessenger()->addSuccessMessage("Estação alterada com sucesso.");

        return $this->redirect()->toRoute('app/estacao', array(
            'controller' => 'estacao',
            'action' => 'index',
        ));
    }

    private function cadastrarAnimalNaEstacao($idAnimal, $estacao) {
        $animal = $this->entityManager->find('Application\Entity\Animal', $idAnimal);
        $classificacao = $animal->getUltimaClassificacao()->getClassificacaoInicial();

        HelperClassificacao::criarClassificacao($this->entityManager, $animal, $classificacao, $estacao);
        HelperCronologia::criarCronologia($this->entityManager, $animal, $classificacao, $estacao);
    }

    private function removerAnimalDaEstacao($idAnimal)
    {
        $animal = $this->entityManager->find('Application\Entity\Animal', $idAnimal);
        $classificacao = $animal->getUltimaClassificacao()->getClassificacaoInicial();

        HelperClassificacao::criarClassificacao($this->entityManager, $animal, $classificacao);
        HelperCronologia::criarCronologia($this->entityManager, $animal, $classificacao);

        $this->entityManager->flush();
    }

    private function getAnimaisNaEstacao($estacao) {
        $animal_classificacao = $this->entityManager->getRepository('Application\Entity\Animal_Classificacao')
            ->findAllAnimaisNaEstacao($estacao);

        $animaisNaEstacao = new ArrayCollection();

        foreach ($animal_classificacao as $ac) {
            $animaisNaEstacao->add($ac->getAnimal());
        }

        $this->entityManager->flush();

        return $animaisNaEstacao;
    }

    private function getAnimaisSemEstacao() {
        $cronologia = $this->entityManager
            ->getRepository('Application\Entity\Cronologia')
            ->findAnimaisAptosOuPosParto();

        $animais = new ArrayCollection();

        foreach ($cronologia as $c) {
            $estacao = HelperEstacao::getEstacao($c->getAnimal());

            if(is_null($estacao)) {
                $animais->add($c->getAnimal());
            }
        }

        $this->entityManager->flush();

        return $animais;
    }

    private function getEstacaoDoAnoAtual() {
        $estacao = null;

        $ultimaEstacao = $this->entityManager
            ->getRepository('Application\Entity\Estacao')
            ->findUltimaEstacao();

        if(!is_null($ultimaEstacao)) {
            $dataFinal = Data::dataToString($ultimaEstacao->getDataFinal());
            $anoDataFinal = substr($dataFinal, strrpos($dataFinal, '/') + 1);
            $estacao = (date("Y") == $anoDataFinal) ? $ultimaEstacao : null;
        }

        return $estacao;
    }
}


