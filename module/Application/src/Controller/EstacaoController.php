<?php


namespace Application\Controller;

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
        return new ViewModel();
    }

    public function cadastrarAction()
    {

        if ($this->request->isPost()) {
            $dataInicio = $this->request->getPost('dataInicio');
            $dataFim = $this->request->getPost('dataFinal');

            $estacao = new Estacao($dataInicio, $dataFim);

            $documentManager = $this->sm->get('Doctrine\ORM\EntityManager');
            $documentManager->persist($estacao);
            $documentManager->flush();
        }

        return $this->redirect()->toRoute('app/estacao', array(
            'controller' => 'index',
            'action' => 'index',
        ));
    }
}


