<?php
/*
* clsse TConnection
* gestiona conexiones con la base de datos a traves de archivos de configuración.
*/
final class TConnection
{
	/*
	* metodo __construct()
<<<<<<< HEAD
	* no existurán instancias de TConnection, por eso estamos marcandolo como private
=======
	* no exusturán instancias de TConnection, por eso estamos marcandolo como private
>>>>>>> 22a7ebfa231f4e2a4ead4a3117eab5d8e63acea7
	*/
	private function __construct() {}
	/*
	* metodo open()
	* recibe el nombre de la base de datos e instancia el objeto PDO correspondiente
	*/	
	public static function open($name) {
		//verifica si existe el archivo de configuración para esta base de datos
		if (file_exists("app.config/${name}.ini")) {
			//lee el INI y devuelve un array
			$db = parse_ini_file("app.config/{$name}.ini")
		}
	}
} ?>