<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\UniqueConstraint;
use Application\Helper\Data;


/**
 * @ORM\Entity(repositoryClass="Application\Repository\RepoIA")
 */
class IA
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

     /**
     * @ORM\ManyToOne(targetEntity="Animal", inversedBy="ias")
     * @ORM\JoinColumn(name="id_animal", referencedColumnName="id", nullable=false)
     */
    private $animal;

    /**
     * @ORM\ManyToOne(targetEntity="Estacao")
     * @ORM\JoinColumn(name="id_estacao", referencedColumnName="id")
     */
    private $estacao;

    /**
     * @ORM\ManyToOne(targetEntity="Protocolo", inversedBy="ias")
     * @ORM\JoinColumn(name="id_protocolo", referencedColumnName="id")
     */
    private $protocolo;

    /**
     * @ORM\Column(type="date")
     */
    private $dataInseminacao;

    /**
     * @ORM\Column(type="date")
     */
    private $dataRetornoAoCio;

    /**
     * @ORM\Column(type="date")
     */
    private $dataDiagnostico1;

    /**
     * @ORM\Column(type="date")
     */
    private $dataDiagnostico2;

        /**
     * @ORM\ManyToOne(targetEntity="Estado")
     * @ORM\JoinColumn(name="id_estado", referencedColumnName="id", nullable=false)
     */
    private $estado;

    /**
     * IA constructor.
     * @param $animal
     * @param $estacao
     * @param $protocolo
     * @param $dataInseminacao
     * @param $dataRetornoAoCio
     * @param $dataDiagnostico1
     * @param $dataDiagnostico2
     */
    public function __construct($animal, $estacao, $protocolo, $dataInseminacao, $dataRetornoAoCio, $dataDiagnostico1, $dataDiagnostico2, $estado)
    {
        $this->animal = $animal;
        $this->estacao = $estacao;
        $this->protocolo = $protocolo;
        $this->setDataInseminacao($dataInseminacao);
        $this->setDataRetornoAoCio($dataRetornoAoCio);
        $this->setDataDiagnostico1($dataDiagnostico1);
        $this->setDataDiagnostico2($dataDiagnostico2);
        $this->estado = $estado;

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
    public function getProtocolo()
    {
        
        return $this->protocolo;
    }

    /**
     * @param mixed $numeroProtocolo
     */
    public function setNumeroProtocolo($protocolo)
    {
        $this->protocolo = $protocolo;
    }

    /**
     * @return mixed
     */
    public function getDataInseminacao()
    {
        return $this->dataInseminacao;
    }

    /**
     * @param mixed $dataInseminacao
     */
    public function setDataInseminacao($dataInseminacao)
    {
        $this->dataInseminacao = Data::getDataFormatada($dataInseminacao);
    }

    /**
     * @return mixed
     */
    public function getDataRetornoAoCio()
    {
        return $this->dataRetornoAoCio;
    }

    /**
     * @param mixed $dataRetornoAoCio
     */
    public function setDataRetornoAoCio($dataRetornoAoCio)
    {
        $this->dataRetornoAoCio = Data::getDataFormatada($dataRetornoAoCio);
    }

    /**
     * @return mixed
     */
    public function getDataDiagnostico1()
    {
        return $this->dataDiagnostico1;
    }

    /**
     * @param mixed $dataDiagnostico1
     */
    public function setDataDiagnostico1($dataDiagnostico1)
    {
        $this->dataDiagnostico1 = Data::getDataFormatada($dataDiagnostico1);
    }

    /**
     * @return mixed
     */
    public function getDataDiagnostico2()
    {
        return $this->dataDiagnostico2;
    }

    /**
     * @param mixed $dataDiagnostico2
     */
    public function setDataDiagnostico2($dataDiagnostico2)
    {
        $this->dataDiagnostico2 = Data::getDataFormatada($dataDiagnostico2);
    }

    public function dataToString($data)
    {
        return Data::dataToString($data);
    }

    /**
     * @return mixed
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * @param mixed $estadoInicial
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;
    }

}