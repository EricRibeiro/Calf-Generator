<?php
/**
 * Created by IntelliJ IDEA.
 * User: ericribeiro
 * Date: 17/04/18
 * Time: 14:53
 */

namespace Application\Helper;
use Application\Entity\Animal_Classificacao;


class HelperClassificacao
{
    public static function criarClassificacaoDentroDeEstacao($entityManager, $animal, $classificacaoID, $estacaoID) {

    }

    public static function criarClassificacaoNovoAnimal($entityManager, $animal, $classificacaoID) {
        $classificacao = $entityManager->getRepository('Application\Entity\Classificacao')->find($classificacaoID);
        $animal_classificacao = new Animal_Classificacao($animal, $classificacao, null, null, new \DateTime());
        return $animal_classificacao;
    }

}