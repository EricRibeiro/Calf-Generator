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

        return new ViewModel();
    }

    public function cadastrarAction()
    {
        if ($this->request->isPost()) {
            $numero = $this->request->getPost('numero');
            $dataUltimoParto = $this->request->getPost('dataUltimoParto');
            $Classificacao = $this->request->getPost('classificacao');
            $animal = new Animal($numero, $this->getDataFormatada($dataUltimoParto), $Classificacao);

            $documentManager = $this->sm->get('Doctrine\ORM\EntityManager');
            $documentManager->persist($animal);
            $documentManager->flush();

            return $this->redirect()->toRoute('app/animal', array(
                'controller' => 'index',
                'action' => 'index',
            ));

        }

        return $this->redirect()->toRoute('app/animal', array(
            'controller' => 'index',
            'action' => 'index',
        ));
    }

    public function editarAction()
    {
        if ($this->request->isPost()) {
            $numero = $this->request->getPost('numero');
            $dataUltimoParto = $this->request->getPost('dataUltimoParto');
            $Classificacao = $this->request->getPost('classificacao');
            $animal = new Animal($numero, $this->getDataFormatada($dataUltimoParto), $Classificacao);

            $documentManager = $this->sm->get('Doctrine\ORM\EntityManager');
            $documentManager->persist($animal);
            $documentManager->flush();

            return $this->redirect()->toRoute('app/animal', array(
                'controller' => 'index',
                'action' => 'index',
            ));

        }
        return new ViewModel();

    }

    public function getDataFormatada($data)
    {
        $formato = "d/m/Y";
        $dataObj = date_create_from_format($formato, $data);
        return date_format($dataObj, 'Y-m-d');
    }
}


