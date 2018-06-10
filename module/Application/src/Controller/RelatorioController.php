<?php
/**
 * Created by IntelliJ IDEA.
 * User: ericribeiro
 * Date: 09/06/18
 * Time: 22:01
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Helper\HelperEntityManager;

class RelatorioController extends AbstractActionController
{
    private $entityManager;

    function __construct()
    {
        $this->entityManager = HelperEntityManager::$entityManager;
    }

    public function indexAction()
    {
        return new ViewModel();
    }
}