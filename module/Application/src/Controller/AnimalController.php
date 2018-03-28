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
    
    public function cadastroAction(){
    	if ($this->request->isPost()) {
            $numero = $this->request->getPost('numero');
            $dataUltimoParto = $this->request->getPost('dataUltimoParto');      
            $Classificacao = $this->request->getPost('classificacao');
            var_dump($Classificacao);
            $animal = new Animal($numero, $dataUltimoParto, $Classificacao);


            $documentManager = $this->sm->get('Doctrine\ORM\EntityManager');
            $documentManager->persist($animal);
            $documentManager->flush();

            return $this->redirect()->toUrl('/');

        }
            return new ViewModel();

    }

   


    
}


