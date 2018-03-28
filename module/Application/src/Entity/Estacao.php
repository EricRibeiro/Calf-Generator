<?php

namespace Application\Entity;
use Doctrine\ORM\Mapping as ORM;
use Application\Entity\Animal;


/**
 * @ORM\Entity
 */
class Estacao
{
	/**
	*@ORM\Id
	*@ORM\GeneratedValue(strategy="AUTO")
	*@ORM\Column(type="integer")
	*/
	private $id;

	/**
	*@ORM\Column(type="date")
	*/
	private $dataInicio;

	/**
	*@ORM\Column(type="date")
	*/
	private $dataFinal;

	 /**
    	*@ORM\ManyToMany(targetEntity="Application\Entity\Animal", inversedBy="estacao")
    	*@ORM\JoinTable(name="Estacao_Animal") 
     */
	private $animal;


	public function __construct($dataInicio,$dataFinal)
	{
			$this->setDataInicio($dataInicio);
			$this->setDataFinal($dataFinal);
	}

	public function getId(){
		return $this->id;
	} 

	public function getdataFinal(){
		return $this->dataFinal;
	}

	public function getdataInicial(){
		return $this->dataInicio;
	}

	public function setDataInicio($dataInicio){
		 return $this->dataInicio= new \DateTime($dataInicio);
	}

	public function setDataFinal($dataFinal){
		 return $this->dataFinal=new \DateTime($dataFinal);
	}
	
}


?>