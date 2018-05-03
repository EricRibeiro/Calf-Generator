<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Protocolo
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
     * @ORM\ManyToOne(targetEntity="Estado")
     * @ORM\JoinColumn(name="id_estado", referencedColumnName="id", nullable=false)
     */
    private $estado;

    /**
     * @ORM\OneToMany(targetEntity="IA", mappedBy="protocolo")
     */
    private $ias;

    /**
     * Protocolo constructor.
     * @param $numero
     * @param $estadoInicial
     * @param $estadoFinal
     */
    public function __construct($numero, $estado)
    {
        $this->numero = $numero;
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
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * @param mixed $estadoInicial
     */
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
}