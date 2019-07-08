<?php
/*
 *  classe TExpression
 * classe abstracta para gerenciar expreciones
 */
abstract class TExpression
{
	// operadores lógicos
	const AND_OPERATOR = 'AND';
	const OR_OPERATOR = 'OR';

	//marca metodo dump como obligatorio
	abstract public function dump();
}
?>