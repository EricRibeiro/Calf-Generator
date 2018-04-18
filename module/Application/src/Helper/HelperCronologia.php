<?php
/**
 * Created by IntelliJ IDEA.
 * User: ericribeiro
 * Date: 17/04/18
 * Time: 15:26
 */

namespace Application\Helper;


use Application\Entity\Cronologia;

class HelperCronologia
{

    public static function criarCronologiaAnimalNovo($entityManager, $animal, $classificacaoID)
    {
        $estadoID = -1;

        switch ($classificacaoID) {
            case '1':
                $estadoID = 1;
                break;
            case '2':
            case '4':
                $estadoID = 5;
                break;
            case '3':
            case '5':
                $estadoID = 4;
                break;
        }

        $estado = $entityManager->getRepository('Application\Entity\Estado')->find($estadoID);
        $classificacao = $entityManager->getRepository('Application\Entity\Classificacao')->find($classificacaoID);
        $cronologia = new Cronologia($animal, null, null, $classificacao, $estado, null, new \DateTime());

        return $cronologia;
    }
}