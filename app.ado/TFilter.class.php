
<?php 
//Creación de la clase Filter, hija de la clase TExpression.
	
Class TFilter extends TExpression {

	private $variable;
	private $operator;
	private $value;

	
	public fuction __contruct ($variable, $operator, $value){

		$this->variable = $variable;
		$this->operator = $operator;
		$this->value = $this->transform($value);
	
	}

	/*El metodo transform() recibe un valor y hace la modificaciones necesarias para ser interpretado por la base de datos, pudiendo ser un integer, string, boolean o array.*/
	private function transform($value){

		//caso sea un array.
		if (is_array($value)) {
			//Recorre los valores
			foreach ($value as $x) {
				//si es entero
				if (is_integer($x)) { 
					$foo[] = $x; 
					//si es string se agregan comillas
				} elseif (is_string($x)) {
					$foo[] = "'$x'";
				} 
			}
			//convierte el array en string separado por ""
				$result = '('.implode(',', $foo).')';
			}
			//caso sea string
				elseif (is_string($value)) {
					$result = "'$value'";
				}
					elseif (is_null($value)) {
						$result = 'NULL';
					}
						elseif(is_bool($value)) {
							$result = $value ? 'TRUE' : 'FALSE';
						}
							else {
								$result = $value;
							}
		return $result;
	}
	//devuelve el filtro en forma de expresión(dump())
	public funtion dump() {
		return "{$this->variable}{$this->operator}{$this->value}";
	}
	
}?>