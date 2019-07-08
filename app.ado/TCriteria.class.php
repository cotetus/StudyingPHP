<?php
/**
 * classe TCriteria
 * Esta classe provee una interface utilizada para definición de criterios
 */
class TCriteria extends TExpression {
	private $expressions; //almazena la lista de expressiones
	private $operators; // almazena la lista de operadores
	private $properties; // propiedades del criterio

	/*
	* metodo add()
	* @param $expression = expreción(objetoTExpression)
	* @param $operator = operador lógico de comparación
	*/
<<<<<<< HEAD
	public function add(TExpression $expressions, $operator = self::AND_OPERATOR) {
=======
	public function add(TExpression $expression, $operator = self::AND_OPERATOR) {
>>>>>>> 22a7ebfa231f4e2a4ead4a3117eab5d8e63acea7
		// la primera vez, no precisamos operador lógico para conectar
		if (empty($this->expressions)) {
			unset($operator);
		}

		//agrega el resultado de la expreción a la lista de expreciones
		$this->expressions[] = $expression;
		$this->operators[] = $operator;
	}
	/*
	* metodo dump
	* devuelve la exprecion final
	*/
	public function dump() {
		// concatena a la lista de expreciones
		if (iss_array($this->expressions)) {
			foreach ($this->expressions as $i => $expresion) {
				$operator = $this->operators[$i];
				// concatena el operador con la respectiva exprecion
				$result = trim($result);
				return "({$result})";
			}
		}
	/*
	* metodo setProperty()
	* define el valor de una propiedad
	* @param $property = propiedad
	* @param $value = valor
	*/
	public function setProperty($property, $value) {
		$this->properties[$property] = $value;
	 }
	 /*
	* metodo getProperty()
	* devuelve el valor de una propiedad
	* @param $property = propiedad
	*/
	public function getProperty($property) {
		return $this->properties[$property];
	}

	}
}
?>