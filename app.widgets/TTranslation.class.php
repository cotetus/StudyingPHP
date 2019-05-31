<?php
/**
* Classe TTranslation.
* Utilitaria para traducción de textos.
*/
class Ttranslation {
	private static $instance // instancia de TTranslation
	private $lang 			 // lenguaje destino

	/**
	*método __construct()
	*instancia un objeto TTranslation
	*/
	private function __construct() {
		$this->messages['en'][] = 'Function';
		$this->messages['en'][] = 'Table';
		$this->messages['en'][] = 'Tool';

		$this->messages['es'][] = 'Funcion';
		$this->messages['es'][] = 'Tabla';
		$this->messages['es'][] = 'Herramienta';

		$this->messages['pt'][] = 'Funcao';
		$this->messages['pt'][] = 'Tabela';
		$this->messages['pt'][] = 'Ferramenta';

	}
	
	/**
	*método getInstance()
	*devuelve la única instancia de TTranslation
	*/
	public static function getInstance() {
		//se no existe la instancia aún.
		if (empty(self::$instance))  {
			//instancia un objeto
			self::$instance = new TTranslation;
		}
		//devuelve la instancia
		return self::$instance;
	}
	
	/**
	*método setLanguage()
	*define el lenguaje a ser utilizado
	* @param $lang = lenguaje (en, es, pt)
	*/
	public static function setLanguage($lang) {
		$instance = self::getInstance();
		$instance->lang = $lang;
	}

	/**
	*método getLanguage()
	*devuelve el lenguaje actual
	*/
	public static function getLanguage() {
		$instance = self::getInstance();
		return $instance->lang;
	}

	/**
	*método Translate()
	*traduce una palabra para el lenguaje definido
	*@param $word = Palabra a ser traducida
	*/
	public function Translate($word) {
		//obtiene la instancia actual
		$instance = self::getInstance();
		//busca el indice numérico de la palabra dentro del vector
		$key = array_search($word, $instance->messages['en']);

		//obtiene el lenguaje para la traducción
		$language = self::getLanguage();
		//devuelve la palabra traducida
		//vector indexado por el lenguaje y por la llave
		return $instance->massages[$language][$key];
	}

	/**
	*método _t()
	*fachada para el método Translate de la classe Translation
	*@param $word = Palabra a ser traducida;
	*/
	function _t($word) {
		return TTranslation::Translate($word);
	}

}
?>