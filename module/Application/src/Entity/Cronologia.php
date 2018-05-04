<?php
/**
 * Created by IntelliJ IDEA.
 * User: ericribeiro
 * Date: 17/04/18
 * Time: 00:50
 */

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 */
class Cronologia
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Animal", inversedBy="cronologias")
     * @ORM\JoinColumn(name="id_animal", referencedColumnName="id", nullable=false)
     */
    private $animal;

    /**
     * @ORM\ManyToOne(targetEntity="IA")
     * @ORM\JoinColumn(name="id_ia", referencedColumnName="id")
     */
    private $ia;

    /**
     * @ORM\ManyToOne(targetEntity="Estacao")
     * @ORM\JoinColumn(name="id_estacao", referencedColumnName="id")
     */
    private $estacao;

    /**
     * @ORM\ManyToOne(targetEntity="Classificacao")
     * @ORM\JoinColumn(name="id_classificacao", referencedColumnName="id", nullable=false)
     */
    private $classificacao;

    /**
     * @ORM\ManyToOne(targetEntity="Estado")
     * @ORM\JoinColumn(name="id_estadoInicial", referencedColumnName="id", nullable=false)
     */
    private $estadoInicial;

    /**
     * @ORM\ManyToOne(targetEntity="Estado")
     * @ORM\JoinColumn(name="id_estadoFinal", referencedColumnName="id")
     */
    private $estadoFinal;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dataDaMudanca;

    /**
     * Cronologia constructor.
     * @param $animal
     * @param $ia
     * @param $estacao
     * @param $classificacao
     * @param $estadoInicial
     * @param $estadoFinal
     */
    public function __construct($animal, $ia, $estacao, $classificacao, $estadoInicial, $estadoFinal)
    {
        $this->animal = $animal;
        $this->ia = $ia;
        $this->estacao = $estacao;
        $this->classificacao = $classificacao;
        $this->estadoInicial = $estadoInicial;
        $this->estadoFinal = $estadoFinal;
        $this->dataDaMudanca = new \DateTime();
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
    public function getIa()
    {
        return $this->ia;
    }

    /**
     * @param mixed $ia
     */
    public function setIa($ia)
    {
        $this->ia = $ia;
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
    public function getEstadoInicial()
    {
        return $this->estadoInicial;
    }

    /**
     * @param mixed $estadoInicial
     */
    public function setEstadoInicial($estadoInicial)
    {
        $this->estadoInicial = $estadoInicial;
    }

    /**
     * @return mixed
     */
    public function getEstadoFinal()
    {
        return $this->estadoFinal;
    }

    /**
     * @param mixed $estadoFinal
     */
    public function setEstadoFinal($estadoFinal)
    {
        $this->estadoFinal = $estadoFinal;
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

}