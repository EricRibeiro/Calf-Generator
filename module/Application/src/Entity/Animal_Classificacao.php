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
 * @ORM\Entity(repositoryClass="Application\Repository\RepoAnimalClassificacao")
 */
class Animal_Classificacao
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Animal", inversedBy="classificacoes")
     * @ORM\JoinColumn(name="id_animal", referencedColumnName="id", nullable=false)
     */
    private $animal;

    /**
     * @ORM\ManyToOne(targetEntity="Classificacao")
     * @ORM\JoinColumn(name="id_classificacaoInicial", referencedColumnName="id", nullable=false)
     */
    private $classificacaoInicial;

    /**
     * @ORM\ManyToOne(targetEntity="Classificacao")
     * @ORM\JoinColumn(name="id_classificacaoFinal", referencedColumnName="id")
     */
    private $classificacaoFinal;

    /**
     * @ORM\ManyToOne(targetEntity="Estacao")
     * @ORM\JoinColumn(name="id_estacao", referencedColumnName="id")
     */
    private $estacao;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dataDaMudanca;

    /**
     * Animal_Classificacao constructor.
     * @param $animal
     * @param $classificacaoInicial
     * @param $classificacaoFinal
     * @param $estacao
     * @param $dataDaMudanca
     */
    public function __construct($animal, $classificacaoInicial, $classificacaoFinal, $estacao, $dataDaMudanca)
    {
        $this->animal = $animal;
        $this->classificacaoInicial = $classificacaoInicial;
        $this->classificacaoFinal = $classificacaoFinal;
        $this->estacao = $estacao;
        $this->dataDaMudanca = $dataDaMudanca;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
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
    public function getClassificacaoInicial()
    {
        return $this->classificacaoInicial;
    }

    /**
     * @param mixed $classificacaoInicial
     */
    public function setClassificacaoInicial($classificacaoInicial)
    {
        $this->classificacaoInicial = $classificacaoInicial;
    }

    /**
     * @return mixed
     */
    public function getClassificacaoFinal()
    {
        return $this->classificacaoFinal;
    }

    /**
     * @param mixed $classificacaoFinal
     */
    public function setClassificacaoFinal($classificacaoFinal)
    {
        $this->classificacaoFinal = $classificacaoFinal;
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
    public function getDataDaMudanca()
    {
        return $this->dataDaMudanca;
    }

    /**
     * @param mixed $dataDaMudanca
     */
    public function setDataDaMudanca($dataDaMudanca)
    {
        $this->dataDaMudanca = $dataDaMudanca;
    }

    public function __toString()
    {
        return strval($this->getId());
    }


}