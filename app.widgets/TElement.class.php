<?php

/**
 * classe TElement
 * classe para abstraccion de tags HTML
 */

 class TElement {
     private $name; // nombre de la TAG
     private $properties; // propiedades de la TAG

     /**
      * metodo contructor
      * instancia una tag html
      * @param $name = nombre de la tag
      */
      public function __construct($name) {
          // define el nombre del elemento
          $this->name = $name;
      }

      /**
       * metodo __set()
       * intercepta las atribuciones a propiedades del objeto
       * @param $name = nombre de la propiedad
       * @param $value = valor
       */
      public function __set($name, $value) {
          // almacenamos los valores atribuidos
          // el array properties
          $this->properties[$name] = $value;
      }

      /**
       * metodo add()
       * agrega un elemento fijo
       * @param $child = objeto hijo
       */
      public function add($child) {
          $this->children[] = $child;
      }

      /**
       * metodo open()
       * exibe la tag de apertura
       */
       public function open() {      
            echo "<{$this->name}";
        if ($this->properties) {
          // recorre las propiedades
          foreach ($this->properties as $name => $value) {
              echo "{$name}=\"{$value}\"";
          }
         
      }
      echo '>';
    }

    /**
     * metodo show()
     * muestra la tag en pantalla, juntamente con su contenido
     */
    public function show() {
        // abre tag
        $this->open();
        echo "\n";
        // si tiene contenido
        if ($this->children) {
            
 
        // recorre todos los objetos hijos
        foreach ($this->children as $child) {
            // si es objeto
            if (is_object($child)) {
                $child->show();
            }
            elseif ((is_string($child)) or (is_numeric($child))) {
                // si es texto
                echo $child;
            }
        }
        // cierra la tag
        $this->close();
        }
    }

    /**
     * metodo close()
     * cierra una tag HTML
     */
    private function close() {
        echo "</{$this->name}>\n";
    }
 }

?>