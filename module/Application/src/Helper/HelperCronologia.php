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
    /**
     * @param EntityManager $args[0]
     * @param Animal $args[1]
     * @param Classificacao $args[2]
     * @param Estacao $args[3] - Opcional
     * @param IA $args[4] - Opcional
     * @param Estado $args[5] - Opcional
     */
    public static function criarCronologia(...$args)
    {
        $qtdArgumentos = count($args);

        $entityManager = $args[0];
        $animal = $args[1];
        $classificacao = $args[2];
        $estacao = $args[3];
        $ia = $args[4];
        $estado = $args[5];
        $cronologia = null;

        if ($qtdArgumentos == 3) {
            $cronologia = self::criarCronologiaAnimal($entityManager, $animal, $classificacao);
        }

        if ($qtdArgumentos == 4) {
            $cronologia = self::criarCronologiaAnimal($entityManager, $animal, $classificacao, $estacao);
        }

        if ($qtdArgumentos == 6) {
            $cronologia = self::criarCronologiaAnimal($entityManager, $animal, $classificacao, $estacao, $ia, $estado);
        }

        if (!is_null($animal->getId())) {
            if($qtdArgumentos == 6) {
                self::atualizarCronologiaAnterior($entityManager, $animal, $classificacao, $estado);
            } else {
                self::atualizarCronologiaAnterior($entityManager, $animal, $classificacao);
            }
        }

        $entityManager->persist($cronologia);
    }

    private static function criarCronologiaAnimal(...$args)
    {
        $qtdArgumentos = count($args);

        $entityManager = $args[0];
        $animal = $args[1];
        $classificacao = $args[2];
        $estacao = $args[3];
        $ia = $args[4];
        $estado = $args[5];
        $cronologia = null;

        if ($qtdArgumentos == 3) {
            $estado = self::getEstadoID($entityManager, $classificacao);
            $cronologia = new Cronologia($animal, $ia, null, $classificacao, $estado, null, new \DateTime());
        }

        if ($qtdArgumentos == 4) {
            if (is_null($estacao)) {
                $estacao =  HelperEstacao::getEstacao($animal);
            }

            $estado = self::getEstadoID($entityManager, $classificacao);
            $cronologia = new Cronologia($animal, $ia, $estacao, $classificacao, $estado, null, new \DateTime());
        }

        if ($qtdArgumentos == 6) {
            if (is_null($estacao)) {
                $estacao =  HelperEstacao::getEstacao($animal);
            }

            $cronologia = new Cronologia($animal, $ia, $estacao, $classificacao, $estado, null, new \DateTime());
        }

        return $cronologia;
    }

    private static function atualizarCronologiaAnterior(...$args)
    {
        $qtdArgumentos = count($args);

        $entityManager = $args[0];
        $animal = $args[1];
        $classificacao = $args[2];
        $estadoFinal = $args[3];

        if($qtdArgumentos == 3) {
            $estadoFinal = self::getEstadoID($entityManager, $classificacao);
        }

        $cronologiaAnterior = $animal->getUltimaCronologia();
        $cronologiaAnterior->setEstadoFinal($estadoFinal);
        $entityManager->persist($cronologiaAnterior);
    }

    private static function getEstadoID($entityManager, $classificacao)
    {
        $estadoID = -1;

        switch ($classificacao->getId()) {
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

        return $entityManager->find('Application\Entity\Estado', $estadoID);
    }

    public static function getUltimaCronologia($animal)
    {
        return HelperEntityManager::$entityManager->getRepository('Application\Entity\Cronologia')
            ->findUltimaCronologia($animal);
    }
}