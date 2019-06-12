<?php
/**
 * classe TRecord
 * Esta classe provee los metodos necesarios para persistir y
 * recuperar objetos de la base de datos (Active Record)
 */
abstract class TRecord {
	/*
	* metodo __construct()
	* instancia un Active Record. Si se pasó el $id, ya carga el objeto
	* @param [$id] = ID del objeto
	*/
	public function __construct($id = NULL) {
		if ($id) {
			//carga el objeto correspondiente
			$object =$this->load($id);
			if ($object) {
				$this->fromArray($object->toArray());
			}
		}
	}
	/*
	* metodo __clone()
	* ejecutado cuando el objeto es clonado.
	* limpia el ID para que sea generando un nuevo ID para el clonado.
	*/
	public function __clone() {
		unset($this->id);
	}

	/*
	* metodo __set()
	* ejecutado siempre que una propiedad es tribuida.
	*/
	private function __set($prop, $value) {
		//verifica si existe metodo set_<propiedad>
		if (method_exists($this, 'set_'.$prop)) {
			//ejecuta el metodo set_<propiedad>
			call_user_func(array($this, 'set_'.$prop), $value);
		} else {
			//atribuye el valor de la propiedad
			$this->data[$prop] = $value;
		}
	}

	/*
	* metodo __get()
	* ejecutado siempre que un propiedad sea requerida
	*/
	private function __get($prop) {
		//verifica si existe metodo get_<propiedad>
		if (method_exists($this, 'get_'.$prop)) {
			// ejecuta el metodo get_<propiedad>
			return call_user_func(array($this, 'get_'.$prop));
		} else {
			// devuelve el valor de la propiedad
			return $this->data[$prop];
		}
	}

	/*
	* metodo getEntity()
	* devuelve el nombre de la entidad (tabla)
	*/
	private function getEntity() {
		//obtiene el nombre de la classe
		$classe = strtolower(get_class($this));
		// devuelve el nombre de la clase - "Record"
		return substr($classe, 0, -6);
	}
	
}

?>