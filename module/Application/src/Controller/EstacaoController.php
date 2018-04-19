<?php


namespace Application\Controller;

use Application\Entity\Animal;
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
        $repositorio = $this->entityManager->getRepository('Application\Entity\Estacao');
        $estacoes = $repositorio->findAll();

        $this->entityManager->flush();

        $view_params = array(
            'estacoes' => $estacoes,
        );

        return new ViewModel($view_params);
    }

    public function cadastrarAction()
    {

        if ($this->request->isPost()) {
            self::cadastrar();
        }

        $repositorio = $this->entityManager->getRepository('Application\Entity\Animal');
        $animais = $repositorio->findAll();

        $this->entityManager->flush();

        $view_params = array(
            'animais' => $animais,
        );

        return new ViewModel($view_params);

    }

    private function cadastrar()
    {
        $repositorio = $this->entityManager->getRepository('Application\Entity\Animal');

        $dataInicio = $this->request->getPost('dataInicioEstacao');
        $dataFim = $this->request->getPost('dataTerminoEstacao');
        $animais = $this->request->getPost('lsIDsAnimais');
        $animais = explode("-", $animais);

        $lsDeAnimais = new ArrayCollection();

        $estacao = new Estacao($dataInicio, $dataFim);
        $this->entityManager->persist($estacao);

        foreach ($animais as $idAnimal) {
            $animal = $repositorio->find($idAnimal);
            HelperClassificacao::criarClassificacao($this->entityManager, $animal, $animal->getUltimaClassificacao()->getClassificacaoInicial(), $estacao);
            HelperCronologia::criarCronologia($this->entityManager, $animal, $animal->getUltimaClassificacao()->getClassificacaoInicial(), $estacao);
        }

        $this->entityManager->flush();

        return $this->redirect()->toRoute('app/estacao', array(
            'controller' => 'estacao',
            'action' => 'index',
        ));
    }

    public function listarAction()
    {
        $id = $this->params()->fromRoute('id');

        if (is_null($id)) {
            $id = $this->request->getPost('id');
        }

        $repositorio = $this->entityManager->getRepository("Application\Entity\Estacao");
        $estacao = $repositorio->find($id);

        $this->entityManager->flush();

        $view_params = array(
            'animais' => $estacao->getAnimal(),
        );

        return new ViewModel($view_params);
    }

    public function removerAnimalAction()
    {
        $idAnimal = $this->params()->fromRoute('id');
        $idEstacao = $this->params()->fromRoute('eid');

        if (is_null($idAnimal) || is_null($idEstacao)) {
            $idAnimal = $this->request->getPost('id');
            $idEstacao = $this->request->getPost('idEstacao');
        }

        $repositorioAnimal = $this->entityManager->getRepository("Application\Entity\Animal");
        $repositorioEstacao = $this->entityManager->getRepository("Application\Entity\Estacao");

        $animal = $repositorioAnimal->find($idAnimal);
        $estacao = $repositorioEstacao->find($idEstacao);

        $estacao->getAnimal()->removeElement($animal);

        $this->entityManager->persist($estacao);
        $this->entityManager->flush();

        return $this->redirect()->toRoute('app/estacao', array(
            'controller' => 'estacao',
            'action' => 'listar',
            'id' => $idEstacao
        ));
    }
}


