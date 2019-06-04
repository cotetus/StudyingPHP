<?php
/**
 * classe TSqlInstruction
 * Esta classe provee los metodos en comun entre todas las intrucciones
 * SQL (SELECT, INSERT,DELETE y UPDATE)
 */
abstract class TSqlInstruction {
	protected $sql; //almazena la instruccion SQL
	protected $criteria; //almazena el objeto criterio
	/*
	* metodo setEntity()
	* define el nombre de la entidad (tabla) manipulada por la instruccion SQL
	* @param $entity = tabla
	*/
	final public function setEntity($entity) {
		$this->entity = $entity;
	}

	/*
	* metodo getEntity()
	* devuelve el nombre de la entidad (tabla)
	*/
	final public function getEntity() {
		return $this->entity;
	}

	/*
	* metodo setCriteria()
	* define un criterio de seleccion de los datos atraves de composición de un objeto 
	* del tipo TCriteria, que ofrece una interfaz para definicion de critérios
	* @param $criteria = objeto del tipo $criteria
	*/
	public function setCriteria(TCriteria $criteria) {
		$this->criteria =$criteria;
	}
	/*
	* metodo getInstruction()
	*declarandolo como <abstract> obligamos su declaración en las classes hijas,
	*una vez que su comportamiento será distinto en una de ellas, configurando polimorfismo.
	*/
	abstract function getInstruction();
}
?>