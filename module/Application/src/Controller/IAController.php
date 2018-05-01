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
        $entityManager = $this->sm->get('Doctrine\ORM\EntityManager');
        $repositorio = $entityManager->getRepository('Application\Entity\IA');
        $ias = $repositorio->findAll();

        $entityManager->flush();

        $view_params = array(
            'ias' => $ias,
        );

        return new ViewModel($view_params);
    }

    public function editarAction()
    {
        $id = $this->params()->fromRoute('id');

        if (is_null($id)) {
            $id = $this->request->getPost('id');
        }

        $entityManager = $this->sm->get('Doctrine\ORM\EntityManager');

        $repositorio = $entityManager->getRepository("Application\Entity\IA");
        $repositorioAnimal = $entityManager->getRepository("Application\Entity\Animal");

        $ia = $repositorio->find($id);

        if ($this->request->isPost()) {

            $numero = $this->request->getPost('numero');

            $query = $repositorioAnimal->createQueryBuilder('o')->where('o.numero = :numero')->setParameter('numero', $numero)->getQuery();
            $animal = $query->getSingleResult();

            $ia->setDataInseminacao($this->request->getPost('dataInseminacao'));
            $ia->setAnimal($animal);

            $entityManager->persist($ia);
            $entityManager->flush();

            return $this->redirect()->toRoute('app/ia', array(
                'controller' => 'index',
                'action' => 'index',
            ));
        }

        return new ViewModel(['ia' => $ia]);
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

            $ia = new IA($animal, $dataInseminacao);

            $entityManager->persist($ia);
            $entityManager->flush();
        }

        return $this->redirect()->toRoute('app/ia', array(
            'controller' => 'index',
            'action' => 'index',
        ));
    }

    public function removerAction()
    {
        $id = $this->params()->fromRoute('id');

        if (!is_null($id)) {
            $entityManager = $this->sm->get('Doctrine\ORM\EntityManager');
            $repositorio = $entityManager->getRepository("Application\Entity\IA");

            $ia = $repositorio->find($id);
            $entityManager->remove($ia);
            $entityManager->flush();
        }

        return $this->redirect()->toRoute('app/ia', array(
            'controller' => 'index',
            'action' => 'index',
        ));
    }
}


