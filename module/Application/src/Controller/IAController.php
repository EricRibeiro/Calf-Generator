<?php


namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Controller\Factory;
use Application\Entity\IA;


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
        $entityManager = $this->sm->get('Doctrine\ORM\EntityManager');
        $repositorio = $entityManager->getRepository('Application\Entity\Animal');
       
        if ($this->request->isPost()) {
            $numeroAnimal = $this->request->getPost('numeroAnimal');
            $dataInseminacao = $this->request->getPost('dataInseminacao');

            $query = $repositorio->createQueryBuilder('o')->where('o.numero = :numeroAnimal')->setParameter('numeroAnimal', $numeroAnimal)->getQuery();
            $animal = $query->getSingleResult();
            //var_dump($animal); exit;

            $ia = new IA($animal, $dataInseminacao);

            $entityManager->persist($ia);
            $entityManager->flush();
        }

        return $this->redirect()->toRoute('app/ia', array(
            'controller' => 'index',
            'action' => 'index',
        ));
    }
}


