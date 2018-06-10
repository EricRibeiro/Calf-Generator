<?php

namespace Application\Controller;

use Application\Entity\Animal_Classificacao;
use Application\Entity\Parto;
use Application\Helper\HelperEntityManager;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Entity\Animal;
use Application\Helper\HelperClassificacao;
use Application\Helper\HelperCronologia;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;

class AnimalController extends AbstractActionController
{
    private $entityManager;

    function __construct()
    {
        $this->entityManager = HelperEntityManager::$entityManager;
    }

    public function indexAction()
    {
        $animais = $this->entityManager
            ->getRepository('Application\Entity\Animal')
            ->findAll();

        $view_params = array(
            'animais' => $animais
        );

        return new ViewModel($view_params);
    }

    public function cadastrarAction()
    {
        if ($this->request->isPost()){
            $numero = $this->request->getPost('numero');
            $dataUltimoParto = $this->request->getPost('dataUltimoParto');
            $classificacaoID = $this->request->getPost('classificacao');
            $classificacao = $this->entityManager->find('Application\Entity\Classificacao', $classificacaoID);

            $animal = new Animal($numero);
            $parto = new Parto($animal, $dataUltimoParto);
            $estado = null;

            try {

                $this->entityManager->persist($animal);
                $this->entityManager->persist($parto);

                if ( $classificacaoID == 1 ){

                    $estado = $this->entityManager->find('Application\Entity\Estado', 6);
                    HelperCronologia::criarCronologia($this->entityManager, $animal, $classificacao, null, null, $estado);

                }else{

                    HelperCronologia::criarCronologia($this->entityManager, $animal, $classificacao, null);

                }

                HelperClassificacao::criarClassificacao($this->entityManager, $animal, $classificacao, null);

                $this->entityManager->flush();
                $this->flashMessenger()->addSuccessMessage("Animal cadastrado com sucesso.");

            } catch (UniqueConstraintViolationException $e) {
                $this->flashMessenger()->addErrorMessage("Animal já cadastrado, escolha outro número.");
            }
        }

        return $this->redirect()->toRoute('app/animal', array(
            'controller' => 'index',
            'action' => 'index',
        ));
    }


    // Vai ser reescrito na implementação da feature de visualizar histórico do animal.
    public function editarAction()
    {
        $id = $this->params()->fromRoute('id');

        if (is_null($id)) {
            $id = $this->request->getPost('id');
        }

        $animal = $this->entityManager->find("Application\Entity\Animal", $id);

        if ($this->request->isPost()) {
            $numero = $this->request->getPost('numero');
            $dataUltimoParto = $this->request->getPost('dataUltimoParto');
            $classificacaoID = $this->request->getPost('classificacao');
            $classificacao = $this->entityManager->find('Application\Entity\Classificacao', $classificacaoID);

            $animal->setNumero($numero);
            $animal->setDataUltimoParto($dataUltimoParto);
            
            $this->entityManager->persist($animal);

            HelperClassificacao::criarClassificacao($this->entityManager, $animal, $classificacao, null);
            HelperCronologia::criarCronologia($this->entityManager, $animal, $classificacao, null);

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
            $animal = $this->entityManager->find("Application\Entity\Animal", $id);
            $this->entityManager->remove($animal);
            $this->entityManager->flush();
        }

        return $this->redirect()->toRoute('app/animal', array(
            'controller' => 'index',
            'action' => 'index',
        ));
    }

}


