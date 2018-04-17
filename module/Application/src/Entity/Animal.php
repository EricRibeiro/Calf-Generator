<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\UniqueConstraint;
use Doctrine\DBAL\Types\DateTimeType;
use Application\Helper\Data;

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
     * @ORM\OneToMany(targetEntity="Cronologia", mappedBy="animal")
     */
    private $cronologia;

    /**
     * @ORM\OneToMany(targetEntity="Animal_Classificacao", mappedBy="animal")
     */
    private $classificacoes;

    /**
     * Animal constructor.
     * @param $numero
     * @param $dataUltimoParto
     */
    public function __construct($numero, $dataUltimoParto)
    {
        $this->numero = $numero;
        $this->setDataUltimoParto($dataUltimoParto);
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
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * @param mixed $numero
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;
    }

    /**
     * @return mixed
     */
    public function getDataUltimoParto()
    {
        return $this->dataUltimoParto;
    }

    /**
     * @param mixed $dataUltimoParto
     */
    public function setDataUltimoParto($dataUltimoParto)
    {
        $this->dataUltimoParto = Data::getDataFormatada($dataUltimoParto);
    }

    /**
     * @return mixed
     */
    public function getCronologia()
    {
        return $this->cronologia;
    }

    /**
     * @param mixed $cronologia
     */
    public function setCronologia($cronologia)
    {
        $this->cronologia = $cronologia;
    }

    /**
     * @return mixed
     */
    public function getClassificacao()
    {
        $classificacao = "";

        foreach ($this->classificacoes as $c) {
            if (is_null($c->getClassificacaoFinal())) {
                $classificacao = $c->getClassificacaoInicial()->getClassificacao();
                break;
            }
        }

        return $classificacao;
    }

    /**
     * @return mixed
     */
    public function dataToString($data)
    {
        return Data::dataToString($data);
    }

}
