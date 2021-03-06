<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;
use Application\Helper\Data;

/**
 * @ORM\Entity(repositoryClass="Application\Repository\RepoEstacao")
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
     * @ORM\OneToOne(targetEntity="Inducao", mappedBy="estacao")
     */
    private $inducao;

    /**
     * Estacao constructor.
     * @param $dataInicio
     * @param $dataFinal
     */
    public function __construct($dataInicio, $dataFinal)
    {
        $this->setDataInicio($dataInicio);
        $this->setDataFinal($dataFinal);
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

    /**
     * @return mixed
     */
    public function getInducao()
    {
        return $this->inducao;
    }

    /**
     * @param mixed $inducao
     */
    public function setInducao($inducao)
    {
        $this->inducao = $inducao;
    }

}
