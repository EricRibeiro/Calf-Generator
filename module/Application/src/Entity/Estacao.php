<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;
use Application\Entity\Animal;
use Application\Helper\Data;

/**
 * @ORM\Entity
 */
class Estacao
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $dataInicio;

    /**
     * @ORM\Column(type="date")
     */
    private $dataFinal;

    /**
     * Estacao constructor.
     * @param $dataInicio
     * @param $dataFinal
     */
    public function __construct($dataInicio, $dataFinal)
    {
        $this->dataInicio = $dataInicio;
        $this->dataFinal = $dataFinal;
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

    public function dataToString($data)
    {
        return Data::dataToString($data);
    }

}
