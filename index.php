<?php

function __autoload($classe) {
	
	$folders = array('app.widgets', 'app.ado', 'app.model', 'app.control');
	
	foreach ($folders as $folder) {
		if (file_exists("{$folder}/{$classe}.class.php")) {
			include_once "{$folder}/{$classe}.class.php";
		}
	}
}

 /**
  * 
  */
 class TApplication {
 	
 	static public function run()
 	{
 		$template = file_get_contents('template.html');
 		if ($_GET) {
 			$class = $_GET['class'];
 			if (class_exists($class)) {
 				$pagina = new $class;
 				ob_start();
 				$pagina->show();
 				$content = ob_get_contents();
 				ob_end_clean();
 			}
 			elseif (function_exists($method)) {
 				call_user_func($method, $_GET);
 			}
 		}
 		echo str_replace('#CONTENT#', $content, $template);
 	}
 }
 TApplication::run();

?>