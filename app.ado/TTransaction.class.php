<<<<<<< HEAD
<?php 
/*
 * classe TTransaction
 * esta clase provee los metodos necesarios para manipular transacciones 
 */

 final class TTransaction {
     private static $conn; // conexion activa
     private static $logger; // objeto de LOG

     /*
     * metodo __construct()
     * Esta declarao como private para impedir que se cree instancias de TTransaction
      */
      private function __construct() {}
          /*
          * METODO OPEN()
          * abre una transaccion y una conexion a la base de datos
          * @param $database = nombre de la base de datos
          */

          public static function open($database) {
              
            // abre una conexion y almazena una propiedad estatica $conn
              if (empty(self::$conn)) {
                 
                 self::$conn = TConection::open($database);
                 
                  // inicia la transaccion
                  self::$conn->beginTransaction();

                  // apaga el log de SQL
                  self::$logger = NULL;
              }
          }

          /**
           * metodo get()
           * devuelve la conexion activa de la transaccion
           */
          public static function get() {
              // devuelve la conexion activa 
              return self::$conn;
          }

          /**
           * metodo rollback()
           * desace todas las operaciones realizadas en la transaccion
           */
          public static function rollback() {
              if (self::$conn) {
                  // desace las operaciones realizadas durantte la transaccion
                  self::$conn->rollback();
                  self::$conn = NULL;
              }
          }

          /**
           * METODO CLOSE()
           * aplica todas las operaciones realizadas y fecha de transacion
           */
          public static function close() {
              if (self::$conn) {
                  // aplica las operaciones realizadas
                  // durante la transaccion
                  self::$conn->commit();
                  self::$conn = NULL;
              }
          }

          /**
           * metodo getLogger()
           * define cual estrategia (algoritmo de LOG será usado)
           */
          public static function setLogger(TLogger $logger) {
              self::$logger = $logger;
          }

          /**
           * metododo log()
           * almazena un mensaje en el archivo de LOG
           * baseado en la estrategia ($logger) actual
           */
          public static function log($message) {
              // verifica si existe un LOgger
              if (self::$logger) {
                  self::$logger->write($message);
              }
          }
    }
 

?>
=======
TTransaction
>>>>>>> 22a7ebfa231f4e2a4ead4a3117eab5d8e63acea7
