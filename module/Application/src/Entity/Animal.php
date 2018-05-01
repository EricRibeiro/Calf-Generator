<?php

namespace Application\Entity;

use Doctrine\Common\Collections\ArrayCollection;
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
     * @return DateTime
     */
    public function getDataUltimoParto()
    {
        return $this->dataUltimoParto;
    }

    /**
     * @return Integer || String
     */
    public function getDiasDesdeUltimoParto()
    {
        $hoje = new \DateTime();
        $diferenca = date_diff($hoje, $this->dataUltimoParto, true)->days;

        if (is_null($diferenca))
            return "-";
        else
            return $diferenca;
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

    public function getProtocolos()
    {
        $protocolos = new ArrayCollection();

        foreach ($this->ias as $ia) {
            if (is_null($ia->getNumeroProtocolo())) {
                $protocolos->add($ia);
            }
        }

        return $protocolos;
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
     * @return String
     */
    public function getClassificacaoID()
    {
        return $this->getUltimaClassificacao()->getClassificacaoInicial()->getId();
    }

    /**
     * @return String
     */
    public function getEstado()
    {
        return $this->getUltimaCronologia()->getEstadoInicial()->getEstado();
    }

    /**
     * @return IA
     */
    public function getUltimaIA()
    {
        return $this->ias->last();
    }

    /**
     * @return Cronologia
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
     * @return Classificacao
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
