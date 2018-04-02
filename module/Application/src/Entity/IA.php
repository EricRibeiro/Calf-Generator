<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\UniqueConstraint;
use Doctrine\DBAL\Types\DateTimeType;
use Application\helper\Data;


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
     * @ORM\Column(type="date", nullable=true)
     */
    private $dataInseminacao;

     /**
     * @ORM\ManyToOne(targetEntity="Animal", inversedBy="ia")
     * @ORM\JoinColumn(name="animal_id", referencedColumnName="id")
     */
    private $animal;


    public function __construct($animal, $dataInseminacao)
    {
        $this->setDataInseminacao($dataInseminacao);
        $this->setAnimal($animal);
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAnimal()
    {
        return $this->animal;
    }

    public function setAnimal($animal)
    {
        $this->animal = $animal;
    }

    public function getDataInseminacao()
    {
        return $this->dataInseminacao;
    }
    public function setDataInseminacao($dataInseminacao)
    {
        return $this->dataInseminacao=Data::setData($dataInseminacao);

    }

    public function dataUltimoPartoToString()
    {
        return Data::dataToString($this->dataUltimoParto);

    }

}
?>