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
    
    /**
     * netodo fromArray()
     * coloca los datos del objeto con un array 
     */
    public function fromArray($data) {
        $this->data = $data;
    }

    /**
     * metodo toArray()
     * devuelve los datos del objeto como array
     */
    public function toArray() {
        return $this->data;
    }
    
    /**
     * metodo store()
     * almazena el objeto en la base de datos y devuelve
     * el número de linhas afectadas por la instrucción SQL (cero o uno)
     */
    public function store() {
        // verifica si tiene ID o si existe en la base de datos
        if (empty($this->data['id']) or (!$this->load($this->id))) {
            // incrementa el ID
            $this->id = $this->getLast() +1;
            // crea una instruccion de insert
            $sql = new TSqlInsert;
            $sql->setEntity($this->getEntity());
            //recorre los datos del objeto
            foreach ($$this->data as $key => $value) {
                // pasa los datos del objeto para el SQL
                $sql->setRowData($key, $this->$key);
            }            
        } else {
            // instancia instruccion de UPDATE
            $sql = new TSqlUpdate;
            $sql->setEntity($this->getEntity());
            // crea un criterio de seleccion basado en el ID
            $criteria = new TCriteria;
            $criteria->add(new TFliter('id','=', $this->id));
			$sql->setCriteria($criteria);
			// recorre los datos del objeto
			foreach ($$this->data as $key => $value) {
				//el ID no precisa ir en el UPDATE
				if ($key !== 'id') {
					// pasa los datos del objeto para el SQL
					$sql->setRowData($key, $this->$key);
				}
			}
		}
		// obtiene transaccion activa
		if ($conn = TTransaction::get()) {
			// hace el log y ejecuta el SQL
			TTransaction::log($sql->getInstruction());
			result = $conn->exec($sql->getInstruction());
			//devuelve el resultado
			return $result;
		} else {
			// si no tiene transaccio, devuelve una exeption
			throw new Exception("No hay transaccion activa");
			
		}

	}
	
	/**
	 * metodo getLast()
	 * devuelve el ultimo ID
	 */
	private function getLast() {
		// inicia transaccion
		if ($conn = TTransaction::get()) {
			$sql = new TSqlSelect;
			$sql->addColumn('max(ID) as ID');
			$sql->setEntity($this->getEntity());
			// crea log y ejecuta instruccion SQL
			TTransaction::log($sql->getInstructiom());
			$resutl = $conn->Query($sql->getInstruction());
			// devuelve los datos de la base de datos
			$row = $result->fetch();
			return $row[0];
		} else {
			// si no tiene transaccio, devuelve una exeption
			throw new Exception("No hay transaccion activa");
			
		}
		
	}

}

?>