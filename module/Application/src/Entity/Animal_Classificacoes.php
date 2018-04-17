<?php
/**
 * User: ericribeiro
 * Date: 16/04/18
 * Time: 23:58
 */

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;
use Application\Entity\Animal;
use Application\Entity\Classificacao;
use Application\Helper\Data;

/**
 * @ORM\Entity
 */
class Animal_Classificacoes
{

    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Animal")
     * @ORM\JoinColumn(name="animal_id", referencedColumnName="id")
     */
    private $animal;

    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Classificacao")
     * @ORM\JoinColumn(name="classificacao_id", referencedColumnName="id")
     */
    private $classificacao;

    /**
     * @ORM\ManyToOne(targetEntity="Estacao")
     * @ORM\JoinColumn(name="estacao_id", referencedColumnName="id")
     */
    private $estacao;

    /**
     * @ORM\Column(type="date")
     */
    private $dataClassificacaoInicial;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dataClassificacaoFinal;

    /**
     * Animal_Classificacoes constructor.
     * @param $animal
     * @param $classificacao
     * @param $estacao
     * @param $dataClassificacaoInicial
     * @param $dataClassificacaoFinal
     */
    public function __construct($animal, $classificacao, $estacao, $dataClassificacaoInicial, $dataClassificacaoFinal)
    {
        $this->animal = $animal;
        $this->classificacao = $classificacao;
        $this->estacao = $estacao;
        $this->dataClassificacaoInicial = $dataClassificacaoInicial;
        $this->dataClassificacaoFinal = $dataClassificacaoFinal;
    }

    /**
     * @return mixed
     */
    public function getAnimal()
    {
        return $this->animal;
    }

    /**
     * @param mixed $animal
     */
    public function setAnimal($animal)
    {
        $this->animal = $animal;
    }

    /**
     * @return mixed
     */
    public function getClassificacao()
    {
        return $this->classificacao;
    }

    /**
     * @param mixed $classificacao
     */
    public function setClassificacao($classificacao)
    {
        $this->classificacao = $classificacao;
    }

    /**
     * @return mixed
     */
    public function getEstacao()
    {
        return $this->estacao;
    }

    /**
     * @param mixed $estacao
     */
    public function setEstacao($estacao)
    {
        $this->estacao = $estacao;
    }

    /**
     * @return mixed
     */
    public function getDataClassificacaoInicial()
    {
        return $this->dataClassificacaoInicial;
    }

    /**
     * @param mixed $dataClassificacaoInicial
     */
    public function setDataClassificacaoInicial($dataClassificacaoInicial)
    {
        $this->dataClassificacaoInicial = Data::getDataFormatada($dataClassificacaoInicial);
    }

    /**
     * @return mixed
     */
    public function getDataClassificacaoFinal()
    {
        return $this->dataClassificacaoFinal;
    }

    /**
     * @param mixed $dataClassificacaoFinal
     */
    public function setDataClassificacaoFinal($dataClassificacaoFinal)
    {
        $this->dataClassificacaoFinal = Data::getDataFormatada($dataClassificacaoFinal);
    }

    public function dataToString($data)
    {
        return Data::dataToString($data);
    }

}