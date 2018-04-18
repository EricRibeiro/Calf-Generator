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

    public static function criarClassificacao($entityManager, $animal, $classificacaoID)
    {
        $animal_classificacao = self::criarClassificacaoAnimal($entityManager, $animal, $classificacaoID);

        if (!is_null($animal->getId())) self::atualizarClassificacaoAnterior($entityManager, $animal, $classificacaoID);

        $entityManager->persist($animal_classificacao);
    }

    private static function criarClassificacaoAnimal($entityManager, $animal, $classificacaoID)
    {
        $classificacao = $entityManager->find('Application\Entity\Classificacao', $classificacaoID);
        $estacao = null;

        if (sizeof($animal->getClassificacoes()) > 0) {
            $ultimaClassificacao = $animal->getUltimaClassificacao();
            $estacao = $ultimaClassificacao->getEstacao();

            if (!is_null($estacao)) {
                $dataFinalEstacao = $estacao->getDataFinal();
                $hoje = new \DateTime();
                $estacao = ($hoje > $dataFinalEstacao) ? null : $estacao;
            }
        }

        $animal_classificacao = new Animal_Classificacao($animal, $classificacao, null, $estacao, new \DateTime());

        return $animal_classificacao;
    }

    private static function atualizarClassificacaoAnterior($entityManager, $animal, $classificacaoID)
    {
        $classificacaoFinal = $entityManager->find('Application\Entity\Classificacao', $classificacaoID);
        $classificaoAnterior = $animal->getUltimaClassificacao();
        $classificaoAnterior->setClassificacaoFinal($classificacaoFinal);
        $entityManager->persist($classificaoAnterior);
    }
}