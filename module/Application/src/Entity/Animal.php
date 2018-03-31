<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\UniqueConstraint;
use Doctrine\DBAL\Types\DateTimeType;
use Application\helper\Data;


/**
 * @ORM\Entity
 * @ORM\Table(uniqueConstraints={@UniqueConstraint(name="numero_uniq", columns={"numero"})})
 */
class Animal
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $numero;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dataUltimoParto;

    /**
     * @ORM\Column(type="string")
     */
    private $classificacao;

    /**
     * @ORM\ManyToMany(targetEntity="Application\Entity\Estacao", mappedBy="animal")
     */

    private $estacao;

    public function __construct($numero, $dataParto, $classificacao)
    {
        $this->setDataUltimoParto($dataParto);
        $this->numero = $numero;
        $this->classificacao = $classificacao;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getNumero()
    {
        return $this->numero;
    }

    public function setNumero($numero)
    {
        $this->numero = $numero;
    }

    public function getDataUltimoParto()
    {
        return $this->dataUltimoParto;
    }
    public function setDataUltimoParto($data)
    {
        return $this->dataUltimoParto=Data::setData($data);

    }

    public function getClassificacao()
    {
        return $this->classificacao;

    }

    public function setClassificacao($classificacao)
    {
        $this->classificacao = $classificacao;
    }

    public function getEstacao()
    {
        return $this->estacao;
    }

    public function setEstacao($estacao)
    {
        $this->estacao = $estacao;
    }

    public function dataUltimoPartoToString()
    {
        return Data::dataToString($this->dataUltimoParto);

    }

}
?>