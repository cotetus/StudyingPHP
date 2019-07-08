<?php 

/**
 * class TLogger
 * esta classe provee una interface abstracta para definicion de algoritmos de LOG
 */
abstract class TLogger {
    protected $filename; //local del archivo de LOG
    
    /**
     * metodo __construct()
     * instancia un logger
     * @param $filename = local del archivo de LOG
     */
    public function __construct($filename) {
        $this->filename = $filename;
        // reseta el contenido del archivo
        file_put_contents($filename, '');
    }
    //define el metodo write como obligatorio
    abstract function write($message);
}

?>