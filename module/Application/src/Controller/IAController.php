<?php


namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IAController extends AbstractActionController
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
            //CODIGO
        }

        return $this->redirect()->toRoute('app/estacao', array(
            'controller' => 'index',
            'action' => 'index',
        ));
    }
}


