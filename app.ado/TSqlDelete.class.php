<?php  
/*
 * classe TSqlDelete
 * Esta classe provee medios para la manipulación de una instruccion de DELETE en la base de datos
 */
final class TSqlDelete extends TSqlInstrucction {
	
/**
 * metodo getInstrucction
 * devuelve la instruccion de DELETE en forma de string.
 */	

	public function getInstrucction() {
		// arma uel string de DELETE
		$this->sql = "DELETE FROM {$this->entity}";

		// devuelve la clausula WHERE del objeto $this->criteria
		if ($this->criteria) {
			$expression = $this->criteria->dump();
			if ($expression) {
				$this->sql .= ' WHERE ' . $expression;
			}
		}
		return $this->sql;
	}
}
?>