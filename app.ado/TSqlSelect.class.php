<?php
/*
* classe TSqlSelect
* Esta classe provee medios para manipulación de una instrucción de SELECT en la base de datos
*/
final class TSqlSelect extends TSqlInstruction {
	private $colums; //array de columnas a ser retornadas
	/*
	* metodo addColumn
	* agrega una columna a ser retornada por el SELECT
	* @param $colum = columna de la tabla
	*/
	public function addColumn($column) {
		//agrega una columna en el array
		$this->columns[] = $column;
	}
	/*
	* metodo getInstruction()
	* devuelve la instruction de SELECT en forma de string.
	*/
	public functin getInstruction() {
		//arma la instruccion del SELECT
		$this->sql = 'SELECT';
		//arma string con los nombres de las columnas
		$this->sql .=implode(',', $this->columns);
		//agrega en la clausula FROM el nombre de la tabla
		$this->sql .= 'FROM' .$this->entity;
		//obtiene la clausula WHERE del objeto criteria.
		if ($this->criteria) {
			$expression = $this->criteria->dump();
			if ($expression) {
				$this->sql .= 'WHERE' .$expression;
			}
			// obtiene las propiedades del criterio
			$order = $this->criteria->getProperty('order');
			$limit = $this->criteria->getProperty('limit');
			$offset = $this->criteria->getProperty('offset');

			//obtiene la ordenación del SELECT
			if ($order) {
				$this->sql .= 'ORDER BY' . $order;
			}
			if ($limit) {
				$this->sql .= 'LIMIT' . $limit;
			}
			if ($offset) {
				$this->sql .= 'OFFSET' . $offset;
			}
		}
		return $this->sql;
	}
}

?>