<?php 

/**
*classe TSession
*gerencia una sesion con un usuario
*/
class TSession {

/**
*método constructor
*inicia una sesion
*/
function __construct() {
	session_start();
}

/**
*método setValue
*almacena una variable en la sesion
*@param $var = nombre de la variable
*@param $value = valor
*/
function setValue($var, $value) {
	$_SESSION[$var] = $value;
}

/**
*método getValue
*devuelve una variable de la sesion
*@param $var = nombre de la variable
*/
function getValue($var) {
	return $_SESSION[$var];
}

/**
*método freeSession()
*destruye los datos de una sesión
*/
function freeSession() {
	$_SESSION = array();
	session_destroy();
}

}
?>