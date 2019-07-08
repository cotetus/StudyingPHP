<?php

/**
 * classe TSyle
 * classe para abstraccion de estilos CSS
 */
class TStyle {
    private $name; //nombre del estilo
    private $properties; //atributos
    static private $loaded; // array de estilos cargados

    /**
     * metodo contructor
     * instancia una tag html
     * @param $name = nombre de la tag
     */
    public function __construct($name) {
        // atribuye el nombre del estilo
        $this->name = $name;
    }

    /**
     * metodo __set()
     * intercepta las atribuciones a propiedades del objeto
     * @param $name + nombre de la propiedad
     * @param $value = valor
     */
    public function __set($name, $value) {
        // sustituye el "_" por "-" en el nombre de la propiedad
        $name = str_replace('_', '-', $name);

        // almazena los valores atribuidos al array properties
        $this->properties[$name] = $value;
    }

    /**
     * metodo show()
     * muestra la tag en la pantalla
     */
    public function show() {
        // verifica si este estilo ja fue cargado
        if (!self::$loaded[$this->name]) {
            echo "<style type = 'text/css' media = 'screen >\n";

            //muestra la apertura del estilo
            echo ".{$this->name}\n";
            echo "{\n";
                if ($this-properties) {
                    // recorre las propiedades
                    foreach ($$this->properties as $name => $value) {
                        echo "\t {$name}: {$value};\n";
                    }
                }
                echo "}\n";
                echo "</style>\n";
                // marca el estilo como ya cargado
                self::$loaded[$this->name] = TRUE;
        }
    }
}

?>