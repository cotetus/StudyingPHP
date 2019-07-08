<?php
/**
 * classe TSqlUpdate
 * Esta classe provee medios para manipulación de una instruccion UPDATE en la base de datos
 */
class TSqlUpdate extends TSqlInstruction {

	/*
	* metodo setRowData()
	* Atribuye valores a determinadas columnas en la base de datos que serán modificadas
	* @param $column = columna de la tabla
	* @param $value = valor a ser almazenado
	*/
	public function setRowData($column, $value) {
		//arma un array indexado por el nombre de la columna
		if (is_string($value)) {
			
			// agrega / en comillas
			$value = addslashes($value);

			// caso sea una string
			$this->columnValues[$column] = "$value";
		} elseif (is_bool($value)) {
			// caso sea un boolean
			$this->columnValues[$column] = $value ? 'TRUE': 'FALSE';
		}elseif (isset($value)) {
			// caso sea otro tipo de dato
			$this->columnValues[$column] = $value;
		}else {
			//caso sea NULL
			$this->columnValues[$column] = "NULL";
		}
	
	}
	/*
	* metodo getInstruction()
	* devuelve la instruccion de UPDATE en forma de string
	*/
	public function getInstruction() {
		//arma el string de UPDATE
		$this->sql = "UPDATE{$this->entity}";
		//arma los pares: columna = valor,...
		if ($this->columnValues) {
			foreach ($this->columnValues as $column => $value) {
				$ste[] = "{$column} = {$value}"; 
			}
		}
		$this->sql .= 'WHERE' .$this->criteria->dump();
	}
	return $this->sql;
}
?>