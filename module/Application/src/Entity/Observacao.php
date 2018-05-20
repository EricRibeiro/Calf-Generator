<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;
use Application\Helper\Data;

/**
 * @ORM\Entity
 */
class Observacao
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Animal", inversedBy="observacoes")
     * @ORM\JoinColumn(name="id_animal", referencedColumnName="id", nullable=false)
     */
    private $animal;

    /**
     * @ORM\Column(type="date")
     */
    private $dataDiagnostico;

    /**
     * @ORM\Column(type="string")
     */
    private $observacao;

    /**
     * Parto constructor.
     * @param $animal
     * @param $dataDiagnostico
     * @param $observacao
     */
    public function __construct($animal, $dataDiagnostico, $observacao)
    {
        $this->animal = $animal;
        $this->dataDiagnostico = $this->setDataDiagnostico($dataDiagnostico);
        $this->observacao = $observacao;
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

    /**
     * @return mixed
     */
    public function getObservacao()
    {
        return $this->observacao;
    }

    /**
     * @param mixed $observacao
     */
    public function setObservacao($observacao)
    {
        $this->observacao = $observacao;
    }

}
