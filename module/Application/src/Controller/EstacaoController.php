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
            self::cadastrar();
        }

        $animais = $this->entityManager
            ->getRepository('Application\Entity\Animal')
            ->findAll();

        $this->entityManager->flush();

        $view_params = array(
            'animais' => $animais,
        );

        return new ViewModel($view_params);

    }

    private function cadastrar()
    {
        $dataInicio = $this->request->getPost('dataInicioEstacao');
        $dataFim = $this->request->getPost('dataTerminoEstacao');
        $animais = $this->request->getPost('lsIDsAnimais');
        $animais = explode( "-", $animais);

        $estacao = new Estacao($dataInicio, $dataFim);
        $this->entityManager->persist($estacao);

        foreach ($animais as $idAnimal) {
            $animal = $this->entityManager->find('Application\Entity\Animal', $idAnimal);
            $classificacao = $animal->getUltimaClassificacao()->getClassificacaoInicial();

            HelperClassificacao::criarClassificacao($this->entityManager, $animal, $classificacao, $estacao);
            HelperCronologia::criarCronologia($this->entityManager, $animal, $classificacao, $estacao);
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

        $animal_classificacao = $this->entityManager->getRepository('Application\Entity\Animal_Classificacao')
            ->findAllAnimaisNaEstacao($id);

        $animais = new ArrayCollection();

        foreach ($animal_classificacao as $ac) {
            $animais->add($ac->getAnimal());
        }

        $this->entityManager->flush();

        $view_params = array(
            'animais' => $animais,
        );

        return new ViewModel($view_params);
    }

    public function removerAnimalAction()
    {
        $idAnimal = $this->params()->fromRoute('id');
        $idEstacao = $this->params()->fromRoute('eid');

        $animal = $this->entityManager->find('Application\Entity\Animal', $idAnimal);
        $classificacao = $animal->getUltimaClassificacao()->getClassificacaoInicial();

        HelperClassificacao::criarClassificacao($this->entityManager, $animal, $classificacao);
        HelperCronologia::criarCronologia($this->entityManager, $animal, $classificacao);

        $this->entityManager->flush();

        return $this->redirect()->toRoute('app/estacao', array(
            'controller' => 'estacao',
            'action' => 'listar',
            'id' => $idEstacao
        ));
    }
}


