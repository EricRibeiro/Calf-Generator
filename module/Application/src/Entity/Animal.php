<?php

namespace Application\Entity;

use Application\Helper\HelperCronologia;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\UniqueConstraint;
use Doctrine\DBAL\Types\DateTimeType;
use Application\Helper\Data;
use Application\Helper\HelperIA;
use Application\Helper\HelperInducao;


/**
 * @ORM\Entity(repositoryClass="Application\Repository\RepoAnimal")
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
     * @ORM\OneToMany(targetEntity="Parto", mappedBy="animal")
     */
    private $partos;

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
     * @ORM\OneToMany(targetEntity="Observacao", mappedBy="animal")
     */
    private $observacoes;

    /**
     * @ORM\ManyToOne(targetEntity="Inducao", inversedBy="animais")
     * @ORM\JoinColumn(name="id_inducao", referencedColumnName="id", nullable=true)
     */
    private $inducao;

    /**
     * Animal constructor.
     * @param $numero
     * @param $dataUltimoParto
     */
    public function __construct($numero)
    {
        $this->numero = $numero;
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
        return $this->partos->last()->getParto();
    }

    /**
     * @return Integer || String
     */
    public function getDiasDesdeUltimoParto()
    {
        $dataUltimoParto = $this->getDataUltimoParto();
        $diferenca = "-";
        $hoje = new \DateTime();

        if (!is_null($dataUltimoParto)) {
            $diferenca = date_diff($hoje, $dataUltimoParto, true)->days;
        }

        return $diferenca;
    }

    public function getDiasAposInducao()
    {
        $dias = HelperInducao::getDiasDaInducao($this);

        if ( $dias >= 0 )
            return $dias;
        else 
            return "-";
    }

    /**
     * @return mixed
     */
    public function getIAs()
    {
        return $this->ias;
    }

    public function getIAProtocolo($protocolo)
    {
        return HelperIA::getUltimaIA($this, $protocolo);
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


    public function getObjEstado()
    {
        return $this->getUltimaCronologia()->getEstadoInicial();
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
            $ultimaEntrada = HelperCronologia::getUltimaCronologia($this->getId());
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
    public function getPartos()
    {
        return $this->partos;
    }

    /**
     * @param mixed $partos
     */
    public function setPartos($partos)
    {
        $this->partos = $partos;
    }

    /**
     * @return mixed
     */
    public function getObservacoes()
    {
        return $this->observacoes;
    }

    /**
     * @param mixed $observacoes
     */
    public function setObservacoes($observacoes)
    {
        $this->observacoes = $observacoes;
    }

    /**
     * @param mixed $inducao
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
