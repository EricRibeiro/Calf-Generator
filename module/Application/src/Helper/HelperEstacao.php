<?php
/**
 * Created by IntelliJ IDEA.
 * User: ericribeiro
 * Date: 22/04/18
 * Time: 18:18
 */

namespace Application\Helper;


class HelperEstacao
{
    public static function getEstacao($animal)
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

        return $estacao;
    }
}