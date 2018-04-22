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
            ->getRepository('Application\Entity\Estacao')
            ->findAll();

        $this->entityManager->flush();

        $view_params = array(
            'estacoes' => $estacoes,
        );

        return new ViewModel($view_params);
    }

    public function cadastrarAction()
    {
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
}