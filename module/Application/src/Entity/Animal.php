<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\UniqueConstraint;
use Doctrine\DBAL\Types\DateTimeType;

/**
 * @ORM\Entity
  *@ORM\Table(name="Animal",uniqueConstraints={@UniqueConstraint(name="numero_uniq", columns={"numero"})})

 */
class Animal
{
	/**
	*@ORM\Id
	*@ORM\GeneratedValue(strategy="AUTO")
	*@ORM\Column(type="integer")
	*/
	private $id;

	/**
	*@ORM\Column(type="integer")
	*/
	private $numero;

	/**
	*@ORM\Column(type="date", nullable=true)
	*/
	private $dataUltimoParto;

	/**
	*@ORM\Column(type="string")
	*/
	private $classificacao;

	/**
		@ORM\ManyToMany(targetEntity="Application\Entity\Estacao", mappedBy="animal")
	*/

		private $estacao;




		public function __construct($numero, $dataParto,$classificacao)
		{
			$this->setDataUltimoParto($dataParto);
			$this->numero=$numero;
			$this->classificacao=$classificacao;
		}

		public function getId(){
			return $this->id;
		} 

		public function getNumero(){
			return $this->numero;
		}

		public function setNumero($numero){
			$this->numero=$numero;
		}


		public function dataUltimoPartoToString()
		{
			if(!is_null($this->dataUltimoParto)){
				$data = $this->dataUltimoParto;
				return $data->format('d/m/Y');
			} else {
				return '-';
			}

		}

		public function getDataUltimoParto(){
			return $this->dataUltimoParto;

		}

		public function setDataUltimoParto($data){
			if (isset($data)){
				return $this->dataUltimoParto = new \DateTime($this->formatarData($data));
			} else {
				$this->dataUltimoParto=NULL;
			}

		}	

		public function getClassificacao(){
			return $this->classificacao;

		}

		public function setClassificacao($classificacao){
			$this->classificacao=$classificacao;
		}

		private function formatarData($data)
		{
			$formato = "d/m/Y";
			$dataObj = date_create_from_format($formato, $data);
			return date_format($dataObj, 'Y-m-d');
		}

	}


	


	?>