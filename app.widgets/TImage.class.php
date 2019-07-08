<<<<<<< HEAD
<?php 

/**
 * classe YImage
 * classe para mostrar imagenes
 */
class TImage extends TElement{
    private $source; //localizacion de la imagen
    //private $tag; // objeto TElement

    /**
     * metodo __construct
     * instancia objeto TImage
     * @param $source = localizacioon de la imagen
     */
    public function __construct($source) {
        parent::__construct('img');
        //atribuye la localizacion de la imagen
        $this->src = $source;
        $this->border = 0;

        //instancia el objeto TElement
        //$this->tag = new TElement('img');
    }

    ###############################################################
    /**
     * metodo show()
     * muestra imagen en pantalla
     */

    /* public function show() {
         // define algunas propiedades de la tag
         $this->tag->src = $this->source;
         $this->tag->border = 0;

         // muestra tag en pantalla
         $this->tag->show();
     }*/
}


?>
=======
TImage.class.php
>>>>>>> 22a7ebfa231f4e2a4ead4a3117eab5d8e63acea7
