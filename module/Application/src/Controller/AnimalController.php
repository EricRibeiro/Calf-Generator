<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Entity\Animal;
use Application\Controller\Factory;

class AnimalController extends AbstractActionController
{
    private $sm;

    function __construct($sm)
    {
        $this->sm = $sm;
    }

    public function indexAction()
    {
        $entityManager = $this->sm->get('Doctrine\ORM\EntityManager');
        $repositorio = $entityManager->getRepository('Application\Entity\Animal');
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
            $Classificacao = $this->request->getPost('classificacao');
            $animal = new Animal($numero, $dataUltimoParto, $Classificacao);

            $documentManager = $this->sm->get('Doctrine\ORM\EntityManager');
            $documentManager->persist($animal);
            $documentManager->flush();
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

        $entityManager = $this->sm->get('Doctrine\ORM\EntityManager');
        $repositorio = $entityManager->getRepository("Application\Entity\Animal");
        $animal = $repositorio->find($id);


        if ($this->request->isPost()) {

            $animal->setNumero($this->request->getPost('numero'));
            $animal->setDataUltimoParto($this->request->getPost('dataUltimoParto'));
            $animal->setClassificacao($this->request->getPost('classificacao'));


            $entityManager->persist($animal);
            $entityManager->flush();
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


