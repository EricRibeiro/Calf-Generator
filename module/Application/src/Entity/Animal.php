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
     * @ORM\OneToMany(targetEntity="IA", mappedBy="animal")
     */
    private $ias;

    /**
     * @ORM\OneToMany(targetEntity="Cronologia", mappedBy="animal")
     */
    private $cronologias;

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
    public function getIAs()
    {
        return $this->ias;
    }

    /**
     * @return mixed
     */
    public function getCronologias()
    {
        return $this->cronologias;
    }

    /**
     * @return mixed
     */
    public function getClassificacoes()
    {
        return $this->classificacoes;
    }

    /**
     * @return String
     */
    public function getClassificacao()
    {
        return $this->getUltimaClassificacao()->getClassificacaoInicial()->getClassificacao();
    }

    /**
     * @return mixed
     */
    public function getEstado()
    {
        return $this->getUltimaCronologia()->getEstadoInicial()->getEstado();
    }

    /**
     * @return Application\Entity\IA
     */
    public function getUltimaIA()
    {
        return $this->ias->last();
    }

    /**
     * @return Application\Entity\Cronologia
     */
    public function getUltimaCronologia()
    {
        $ultimaEntrada = $this->cronologias->last();

        if (!is_null($ultimaEntrada->getEstadoFinal())) {
            foreach ($this->cronologias as $cronologia) {
                if (is_null($cronologia->getEstadoFinal())) {
                    $ultimaEntrada = $cronologia;
                    break;
                }
            }
        }

        return $ultimaEntrada;
    }

    /**
     * @return Application\Entity\Classificacao
     */
    public function getUltimaClassificacao()
    {
        $ultimaEntrada = $this->classificacoes->last();

        if (!is_null($ultimaEntrada->getClassificacaoFinal())) {
            foreach ($this->classificacoes as $classificacao) {
                if (is_null($classificacao->getClassificacaoFinal())) {
                    $ultimaEntrada = $classificacao;
                    break;
                }
            }
        }

        return $ultimaEntrada;
    }

    /**
     * @return mixed
     */
    public function dataToString($data)
    {
        return Data::dataToString($data);
    }

}
