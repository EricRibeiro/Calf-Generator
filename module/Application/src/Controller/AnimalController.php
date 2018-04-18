<?php

namespace Application\Controller;

use Application\Entity\Animal_Classificacao;
use Application\Helper\HelperCronologia;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Entity\Animal;
use Application\Helper\HelperClassificacao;

class AnimalController extends AbstractActionController
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
        $repositorio = $this->entityManager->getRepository('Application\Entity\Animal');
        $animais = $repositorio->findAll();
        $view_params = array(
            'animais' => $animais,
        );

        return new ViewModel($view_params);
    }

    public function cadastrarAction()
    {
        if ($this->request->isPost()) {
            $numero = $this->request->getPost('numero');
            $dataUltimoParto = $this->request->getPost('dataUltimoParto');
            $classificacaoID = $this->request->getPost('classificacao');

            $animal = new Animal($numero, $dataUltimoParto);
            $classificacao = HelperClassificacao::criarClassificacaoAnimalNovo($this->entityManager, $animal, $classificacaoID);
            $cronologia = HelperCronologia::criarCronologiaAnimalNovo($this->entityManager, $animal, $classificacaoID);

            $this->entityManager->persist($animal);
            $this->entityManager->persist($classificacao);
            $this->entityManager->persist($cronologia);
            $this->entityManager->flush();
        }

        return $this->redirect()->toRoute('app/animal', array(
            'controller' => 'index',
            'action' => 'index',
        ));
    }

    public function editarAction()
    {
        $id = $this->params()->fromRoute('id');

        if (is_null($id)) {
            $id = $this->request->getPost('id');
        }

        $animal = $this->entityManager->getRepository("Application\Entity\Animal")->find($id);

        if ($this->request->isPost()) {
            $numero = $this->request->getPost('numero');
            $dataUltimoParto = $this->request->getPost('dataUltimoParto');
            $classificacaoID = $this->request->getPost('classificacao');

            $classificacao = HelperClassificacao::criarClassificacaoNovoAnimal($this->entityManager, $animal, $classificacaoID);
            $cronologia = HelperCronologia::criarCronologiaNovoAnimal($this->entityManager, $animal, $classificacaoID);

            $this->entityManager->persist($animal);
            $this->entityManager->flush();

            return $this->redirect()->toRoute('app/animal', array(
                'controller' => 'index',
                'action' => 'index',
            ));
        }

        return new ViewModel(['animal' => $animal]);
    }

    public function removerAction()
    {
        $id = $this->params()->fromRoute('id');

        if (!is_null($id)) {
            $entityManager = $this->sm->get('Doctrine\ORM\EntityManager');
            $repositorio = $entityManager->getRepository("Application\Entity\Animal");

            $animal = $repositorio->find($id);
            $entityManager->remove($animal);
            $entityManager->flush();
        }

        return $this->redirect()->toRoute('app/animal', array(
            'controller' => 'index',
            'action' => 'index',
        ));
    }

}


