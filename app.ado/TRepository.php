<?php

/**
 * classe Trepository
 * esta classe provee los metodos necesarios para manipular colecciondes de objetos.
 */
final class TRepository {
    private $class; // nombre de la classe manipulada por el repositorio

    /**
     * metodo __contruct()
     * instancia un repositorio de objetos
     * @param $class = classe de objetos
     */
    function __construct($class) {
        $this->class;
    }

    /**
     * metodo load()
     * recupera un conjunto de objetos (collection) de la base de datos
     * atraves de un criterio de seleccion, y los instancia en memoria
     * @param $criteria = objeto de tipo TCriteria
     */
    function load(TCriteria $criteria) {
        
        // instancia la instruccion de SELECT
        $sql = new TSqlSelect;
        $sql->addColumn('*');
        $sql->setEntity($this->class);

        // atribuye el criterio padado como parametro
        $sql->setCriteria($criteria);

        // obtiene transacion activa
        if ($conn = TTransaction::get()) {
            
            // registra mensaje de log
            TTransaction::log($sql->getInstruction());

            // ejecuta la consulta en la base de datos
            $rsult = $conn->Query($sql->getInstruction());

            if ($result) {
                // recorr los resultados de la consulta, retornando un objeto
                while ($row = $result->fetchObject($thid->class . 'Record')) {
                    // almacena en el arry $results;
                    $results[] = $row;
                }
            }

            return $results;
        }
         else {
              
            // si n tiene transaccion, devuleve una exception
            throw new Exception("No hay transaccion activa!!");
            
         }
    }

    /**
     * metodo delete()
     * excluir un conjunto de objetos (collection) de la base de datos
     * atraves de un criterio de seleccion
     * @param $criteria = objeto del tipo TCriteria
     */
    function delete(TCriteria $criteria) {
        
        // instancia instruccion de DELETE
        $sql = new TSqlDelete;
        $sql->setEntity($this->class);
        
        // atribuye el criterio pasado como parametro
        $sql->setCriteria($criteria);

        // obtiene transaccion activa
        if ($conn = TTransaction::get()) {
            
            // registra mensaje de log
            TTransaction::log($sql->getInstruction());
            return $result;
        }
        else {
            // si no hay transaccion, devuleve una exception
            throw new Exception("No hay transaccion activa!!");
            
        }
    }

    /**
     * metodo count()
     * devuelve la cantidad de objetos de base de datos
     * que satisfacen un determinado criterio de seleccion
     * @param $criteria = objeto del tipo TCriteria
     */
    function count(TCriteria $criteria) {
        // instancia instruccin de SELECT
        $sql = new TSqlSelect;
        $sql->addColumn('count(*)');

        // atribuye el criterio pasado como parametro
        $sql->setCriteria($criteria);

        // obtiene transaccion activa
        if ($conn = TTransaction::get()) {
            
            //registra mensage de log
            TTransaction::::log($sql->getInstruction());

            //ejecuta instruccion e SELECT
            $rsult = $conn->Query($sql->getInstruction());
            if ($result) {
                $row = $result->fetch();
            } return $row[0];
        }
        else {
            // si no tiene transaccion, devuelve una exception
            throw new Exception("No hay transaccion activa!!");
            
        }
    }
}

?>