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
     * @ORM\ManyToMany(targetEntity="Application\Entity\Animal")
     * @ORM\JoinTable(name="Estacao_Animais")
     */
    private $animal;


    public function __construct($dataInicio, $dataFinal, $animal)
    {
        $this->setDataInicio($dataInicio);
        $this->setDataFinal($dataFinal);
        $this->setAnimal($animal);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getdataFinal()
    {
        return $this->dataFinal;
    }

    public function getdataFinalString()
    {
        return Data::dataToString($this->dataFinal);
    }

    public function getdataInicialString()
    {
         return Data::dataToString($this->dataInicio);
    }

    public function setDataInicio($dataInicio)
    {
        return $this->dataInicio = Data::setData($dataInicio);
    }

    public function setDataFinal($dataFinal)
    {
        return $this->dataFinal = Data::setData($dataFinal);
    }

    public function getAnimal()
    {
        return $this->animal;
    }

    public function setAnimal($animal)
    {
        $this->animal = $animal;
    }

}
