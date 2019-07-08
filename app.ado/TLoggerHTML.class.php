<?php

/**
 * classe TLoggerHTML
 * implementa el algoritmo de LOG en HTML
 */
class TLogger extends TLogger {
    
    /**
     * metodo write()
     * escribe un mensaje en el archivo de LOG
     * @param $message = mensaje a ser  escrita
     */
    public function write($message) {
        $time = date("Y-m-d H:i:s");
        
        // arma el string
        $text = "<p>\n";
        $text .= " <b>$time</b> : \n";
        $text .= " <i>$message</i> <br>\n";
        $text = "<p>\n";

        //agrega al final del archivo
        $handler = fopen($this->filename, 'a');
        fwrite($hanlder, $text);
        fclose($handler);
    }
    
}


?>