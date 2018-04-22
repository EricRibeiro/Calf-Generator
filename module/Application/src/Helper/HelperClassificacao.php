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

    /**
     * @param EntityManager $args[0]
     * @param Animal $args[1]
     * @param Classificacao $args[2]
     * @param Estacao $args[3] - Opcional
     */
    public static function criarClassificacao(...$args)
    {
        $qtdArgumentos = count($args);

        $entityManager = $args[0];
        $animal = $args[1];
        $classificacao = $args[2];
        $estacao = $args[3];
        $animal_classificacao = null;

        if ($qtdArgumentos == 3) {
            $animal_classificacao = self::criarClassificacaoAnimal($animal, $classificacao);
        }

        if ($qtdArgumentos == 4) {
            $animal_classificacao = self::criarClassificacaoAnimal($animal, $classificacao, $estacao);
        }

        if (!is_null($animal->getId())) {
            self::atualizarClassificacaoAnterior($entityManager, $animal, $classificacao);
        }

        $entityManager->persist($animal_classificacao);
    }

    private static function criarClassificacaoAnimal(...$args)
    {
        $qtdArgumentos = count($args);

        $animal = $args[0];
        $classificacao = $args[1];
        $estacao = $args[2];
        $animal_classificacao = null;

        if ($qtdArgumentos == 2) {
            $animal_classificacao = new Animal_Classificacao($animal, $classificacao, null, null, new \DateTime());
        }

        if ($qtdArgumentos == 3) {
            if (is_null($estacao)) {
                $estacao = HelperEstacao::getEstacao($animal);
            }

            $animal_classificacao = new Animal_Classificacao($animal, $classificacao, null, $estacao, new \DateTime());
        }

        return $animal_classificacao;
    }

    private static function atualizarClassificacaoAnterior($entityManager, $animal, $classificacaoAtual)
    {
        $classificaoAnterior = $animal->getUltimaClassificacao();
        $classificaoAnterior->setClassificacaoFinal($classificacaoAtual);
        $entityManager->persist($classificaoAnterior);
    }
}