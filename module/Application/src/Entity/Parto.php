<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;
use Application\Helper\Data;

/**
 * @ORM\Entity
 */
class Parto
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Animal", inversedBy="partos")
     * @ORM\JoinColumn(name="id_animal", referencedColumnName="id", nullable=false)
     */
    private $animal;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $parto;

    /**
     * Parto constructor.
     * @param $animal
     * @param $parto
     */
    public function __construct($animal, $parto)
    {
        $this->animal = $animal;
        $this->parto = $this->setParto($parto);
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
    public function getParto()
    {
        return $this->parto;
    }

    /**
     * @param mixed $parto
     */
    public function setParto($parto)
    {
        $this->parto = Data::getDataFormatada($parto);
    }
}
