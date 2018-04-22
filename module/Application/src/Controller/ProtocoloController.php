<?php
/**
 * Created by IntelliJ IDEA.
 * User: ericribeiro
 * Date: 22/04/18
 * Time: 03:08
 */

namespace Application\Controller;

use Doctrine\Common\Collections\ArrayCollection;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Entity\IA;
use Application\Helper\HelperCronologia;

class ProtocoloController extends AbstractActionController
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
        $estacoes = $this->entityManager
            ->getRepository('Application\Entity\IA')
            ->findAll();

        $this->entityManager->flush();

        $view_params = array(
            'estacoes' => $estacoes,
        );

        return new ViewModel($view_params);
    }

    public function cadastrarAction()
    {
        if ($this->request->isPost()) {
            self::cadastrar();
        }

        $estacoes = $this->entityManager
            ->getRepository('Application\Entity\Estacao')
            ->createQueryBuilder('estacao')
            ->orderBy("estacao.id", "DESC")
            ->setMaxResults(3)
            ->getQuery()
            ->getResult();

        $cronologias = $this->entityManager
            ->getRepository('Application\Entity\Cronologia')
            ->findAnimaisAptosOuPosParto();

        $animais = new ArrayCollection();

        foreach ($cronologias as $c) {
            if ($c->getAnimal()->getDiasDesdeUltimoParto() > 35 || $c->getAnimal()->getDiasDesdeUltimoParto() == "-") {
                $animais->add($c->getAnimal());
            }
        }

        $this->entityManager->flush();

        $view_params = array(
            'estacoes' => $estacoes,
            'animais' => $animais
        );

        return new ViewModel($view_params);
    }

    private function cadastrar()
    {
        $numeroDoProtocolo = $this->request->getPost('numeroDoProtocolo');
        $idEstacao = $this->request->getPost('idEstacao');
        $dataDeInseminacao = $this->request->getPost('dataDeInseminacao');
        $dataDeRetornoAoCio = $this->request->getPost('dataDeRetornoAoCio');
        $dataDeDiagnostico1 = $this->request->getPost('dataDeDiagnostico1');
        $dataDeDiagnostico2 = $this->request->getPost('dataDeDiagnostico2');
        $animais = $this->request->getPost('lsIDsAnimais');

        $animais = explode("-", $animais);
        $estacao = $this->entityManager->find('Application\Entity\Estacao', $idEstacao);
        $estado = $this->entityManager->find('Application\Entity\Estado', 2);

        foreach ($animais as $idAnimal) {
            $animal = $this->entityManager->find('Application\Entity\Animal', $idAnimal);
            $classificacao = $animal->getUltimaClassificacao()->getClassificacaoInicial();

            $ia = new IA($animal, $estacao, $numeroDoProtocolo, $dataDeInseminacao, $dataDeRetornoAoCio, $dataDeDiagnostico1, $dataDeDiagnostico2);
            $this->entityManager->persist($ia);

            HelperCronologia::criarCronologia($this->entityManager, $animal, $classificacao, $estacao, $ia, $estado);
        }

        $this->entityManager->flush();

        return $this->redirect()->toRoute('app/protocolo', array(
            'controller' => 'protocolo',
            'action' => 'index',
        ));
    }
}