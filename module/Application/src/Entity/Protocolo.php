<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;
use JsonSerializable;

/**
 * @ORM\Entity
 */
class Protocolo implements JsonSerializable
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true, options={"unsigned":true})
     */
    private $numero;

    /**
     * @ORM\ManyToOne(targetEntity="Estacao")
     * @ORM\JoinColumn(name="id_estacao", referencedColumnName="id")
     */
    private $estacao;

    /**
     * @ORM\ManyToOne(targetEntity="Estado")
     * @ORM\JoinColumn(name="id_estado", referencedColumnName="id", nullable=false)
     */
    private $estado;

    /**
     * @ORM\OneToMany(targetEntity="IA", mappedBy="protocolo")
     */
    private $ias;


    public function __construct($numero, $estacao, $estado)
    {
        $this->numero = $numero;
        $this->estacao = $estacao;
        $this->estado = $estado;
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
    public function getEstacao()
    {
        return $this->estacao;
    }

    /**
     * @param mixed $estacao
     */
    public function setEstacao($estacao)
    {
        $this->estacao = $estacao;
    }

    /**
     * @return mixed
     */
    public function getEstado()
    {
        return $this->estado;
    }

    public function setEstado($estado)
    {
        $this->estado = $estado;
    }

    /**
     * @return mixed
     */
    public function getIas()
    {
        return $this->ias;
    }

    /**
     * @param mixed $ias
     */
    public function setIas($ias)
    {
        $this->ias = $ias;
    }


    public function jsonSerialize()
    {
        return array(
            'id_protocolo' => $this->id,
            'id_estacao'=> $this->estacao->getId(),
            'id_estado' => $this->estado->getId(),
            'numero'=> $this->numero
        );
    }
}