<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\UniqueConstraint;
use Application\Helper\Data;


/**
 * @ORM\Entity
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
     * @ORM\ManyToOne(targetEntity="Animal")
     * @ORM\JoinColumn(name="animal_id", referencedColumnName="id", nullable=false)
     */
    private $animal;

    /**
     * @ORM\ManyToOne(targetEntity="Estacao")
     * @ORM\JoinColumn(name="estacao_id", referencedColumnName="id", nullable=false)
     */
    private $estacao;

    /**
     * @ORM\Column(type="integer", nullable=true, options={"unsigned":true})
     */
    private $numeroProtocolo;

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
    private $dataDiagnostico;

    /**
     * IA constructor.
     * @param $animal
     * @param $estacao
     * @param $numeroProtocolo
     * @param $dataInseminacao
     * @param $dataRetornoAoCio
     * @param $dataDiagnostico
     */
    public function __construct($animal, $estacao, $numeroProtocolo, $dataInseminacao, $dataRetornoAoCio, $dataDiagnostico)
    {
        $this->animal = $animal;
        $this->estacao = $estacao;
        $this->numeroProtocolo = $numeroProtocolo;
        $this->dataInseminacao = $dataInseminacao;
        $this->dataRetornoAoCio = $dataRetornoAoCio;
        $this->dataDiagnostico = $dataDiagnostico;
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
    public function getNumeroProtocolo()
    {
        return $this->numeroProtocolo;
    }

    /**
     * @param mixed $numeroProtocolo
     */
    public function setNumeroProtocolo($numeroProtocolo)
    {
        $this->numeroProtocolo = $numeroProtocolo;
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
    public function getDataDiagnostico()
    {
        return $this->dataDiagnostico;
    }

    /**
     * @param mixed $dataDiagnostico
     */
    public function setDataDiagnostico($dataDiagnostico)
    {
        $this->dataDiagnostico = Data::getDataFormatada($dataDiagnostico);
    }

    public function dataToString($data)
    {
        return Data::dataToString($data);
    }

}