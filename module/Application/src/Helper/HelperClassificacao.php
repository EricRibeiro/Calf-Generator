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

    public static function criarClassificacao($entityManager, $animal, $classificacao)
    {
        $animal_classificacao = self::criarClassificacaoAnimal($animal, $classificacao);

        if (!is_null($animal->getId())) self::atualizarClassificacaoAnterior($entityManager, $animal, $classificacao);

        $entityManager->persist($animal_classificacao);
    }

    private static function criarClassificacaoAnimal($animal, $classificacao)
    {
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

    private static function atualizarClassificacaoAnterior($entityManager, $animal, $classificacaoAtual)
    {
        $classificaoAnterior = $animal->getUltimaClassificacao();
        $classificaoAnterior->setClassificacaoFinal($classificacaoAtual);
        $entityManager->persist($classificaoAnterior);
    }
}