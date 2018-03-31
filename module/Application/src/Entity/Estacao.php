<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;
use Application\Entity\Animal;

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
     * @ORM\ManyToMany(targetEntity="Application\Entity\Animal", inversedBy="estacao")
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
        return $this->dataToString($this->dataFinal);
    }

    public function getdataInicial()
    {
        return $this->dataInicio;
    }

    public function getdataInicialString()
    {
        return $this->dataToString($this->dataInicio);
    }

    public function setDataInicio($dataInicio)
    {
        return $this->dataInicio = new \DateTime($this->formatarData($dataInicio));
    }

    public function setDataFinal($dataFinal)
    {
        return $this->dataFinal = new \DateTime($this->formatarData($dataFinal));
    }

    public function getAnimal()
    {
        return $this->animal;
    }

    public function setAnimal($animal)
    {
        $this->animal = $animal;
    }

    public function formatarData($data)
    {
        $formato = "d/m/Y";
        $dataObj = date_create_from_format($formato, $data);
        return date_format($dataObj, 'Y-m-d');
    }

    public function dataToString($data)
    {
        if (!is_null($data)) {
            return $data->format('d/m/Y');
        }
    }

}

?>