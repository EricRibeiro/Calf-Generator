<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;
use Application\Helper\Data;

/**
 * @ORM\Entity
 */
class Inducao
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity="Animal", mappedBy="inducao")
     */
    private $animais;

    /**
     * @ORM\Column(type="date")
     */
    private $dataInicio;

    /**
     * @ORM\Column(type="date")
     */
    private $dataFinal;

    /**
     * @ORM\OneToOne(targetEntity="Estacao", inversedBy="inducao")
     * @ORM\JoinColumn(name="id_estacao", referencedColumnName="id", nullable=false)
     */
    private $estacao;

    /**
     * Inducao constructor.
     * @param $animais
     * @param $dataInicio
     * @param $dataFinal
     * @param $estacao
     */
    public function __construct($animais, $dataInicio, $dataFinal, $estacao)
    {
        $this->animais = $animais;
        $this->dataInicio = $this->setDataInicio($dataInicio);
        $this->dataFinal = $this->setDataFinal($dataFinal);
        $this->estacao = $estacao;
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
    public function getAnimais()
    {
        return $this->animais;
    }

    /**
     * @param mixed $animais
     */
    public function setAnimais($animais)
    {
        $this->animais = $animais;
    }

    /**
     * @return mixed
     */
    public function getDataInicio()
    {
        return $this->dataInicio;
    }

    /**
     * @param mixed $dataInicio
     */
    public function setDataInicio($dataInicio)
    {
        $this->dataInicio = Data::getDataFormatada($dataInicio);
    }

    /**
     * @return mixed
     */
    public function getDataFinal()
    {
        return $this->dataFinal;
    }

    /**
     * @param mixed $dataFinal
     */
    public function setDataFinal($dataFinal)
    {
        $this->dataFinal = Data::getDataFormatada($dataFinal);
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

}