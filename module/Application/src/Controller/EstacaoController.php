<?php


namespace Application\Controller;

use Application\Entity\Animal;
use Doctrine\Common\Collections\ArrayCollection;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Entity\Estacao;

class EstacaoController extends AbstractActionController
{


    private $sm;

    public function __construct($sm)
    {
        $this->sm = $sm;
    }

    public function indexAction()
    {
        $entityManager = $this->sm->get('Doctrine\ORM\EntityManager');
        $repositorio = $entityManager->getRepository('Application\Entity\Estacao');
        $estacoes = $repositorio->findAll();

        $entityManager->flush();

        $view_params = array(
            'estacoes' => $estacoes,
        );

        return new ViewModel($view_params);
    }

    public function cadastrarAction()
    {

        if ($this->request->isPost()) {
            $entityManager = $this->sm->get('Doctrine\ORM\EntityManager');
            $repositorio = $entityManager->getRepository('Application\Entity\Animal');

            $dataInicio = $this->request->getPost('dataInicioEstacao');
            $dataFim = $this->request->getPost('dataTerminoEstacao');
            $animais = $this->request->getPost('lsIDsAnimais');
            $animais = explode("-", $animais);

            $lsDeAnimais = new ArrayCollection();

            foreach($animais as $idAnimal) {
                $animal = $repositorio->find($idAnimal);
                $lsDeAnimais[] = $animal;
            }

            $estacao = new Estacao($dataInicio, $dataFim, $lsDeAnimais);

            $entityManager->persist($estacao);
            $entityManager->flush();

            return $this->redirect()->toRoute('app/estacao', array(
                'controller' => 'estacao',
                'action' => 'index',
            ));
        }

        $entityManager = $this->sm->get('Doctrine\ORM\EntityManager');
        $repositorio = $entityManager->getRepository('Application\Entity\Animal');
        $animais = $repositorio->findAll();

        $entityManager->flush();

        $view_params = array(
            'animais' => $animais,
        );

        return new ViewModel($view_params);

    }

    public function listarAction() {
        $id = $this->params()->fromRoute('id');

        if (is_null($id)) {
            $id = $this->request->getPost('id');
        }

        $entityManager = $this->sm->get('Doctrine\ORM\EntityManager');
        $repositorio = $entityManager->getRepository("Application\Entity\Estacao");
        $estacao = $repositorio->find($id);

        $entityManager->flush();

        $view_params = array(
            'animais' => $estacao->getAnimal(),
        );

        return new ViewModel($view_params);
    }

    public function removerAnimalAction() {
        $idAnimal = $this->params()->fromRoute('id');
        $idEstacao = $this->params()->fromRoute('eid');

        if (is_null($idAnimal) || is_null($idEstacao)) {
            $idAnimal = $this->request->getPost('id');
            $idEstacao = $this->request->getPost('idEstacao');
        }

        $entityManager = $this->sm->get('Doctrine\ORM\EntityManager');
        $repositorioAnimal = $entityManager->getRepository("Application\Entity\Animal");
        $repositorioEstacao = $entityManager->getRepository("Application\Entity\Estacao");

        $animal = $repositorioAnimal->find($idAnimal);
        $estacao = $repositorioEstacao->find($idEstacao);

        $estacao->getAnimal()->removeElement($animal);

        $entityManager->persist($estacao);
        $entityManager->flush();

        return $this->redirect()->toRoute('app/estacao', array(
            'controller' => 'estacao',
            'action' => 'listar',
            'id' => $idEstacao
        ));
    }
}


