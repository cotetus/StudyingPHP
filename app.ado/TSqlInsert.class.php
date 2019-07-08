<?php
final class TSqlInsert extends TSqlInstruction {
	
	public function setRowData($column, $value) {
		if (is_string($value)) {
			//agrega en comillas
			$value = addslashes($value);
			$this->columnValues[$column] = "'$value'";
				}elseif (isset($value)) {
					$this->columnValues[$column] = "NULL";
				}
	}

	public function setCriteria($criteria) {
		//dispara error
		throw new Exeption("No se puede llamar los criterios esablecidos de ".__CLASS__);
	}

	public function getInstruction() {
			$this->sql = "INSERT INTO {$this->entity}(";
			//arma un string contetiendo los valores
			$columns implode(',', array_keys($this->columnValues));
			//arma otra string, con los valores
			$values implode(',', array_values($this->columnValues));
			$this->sql .= $columns.')';
			$this->sql .= "values ({$values})";
			 return $this->sql;
	}
}

?>