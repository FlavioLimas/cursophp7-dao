<?php 
/**
 * Função de autoload para classes
 */
spl_autoload_register(function($class_name){

	$fileName = "class".DIRECTORY_SEPARATOR.$class_name.".php";

	if(file_exists($fileName)){
		require_once($fileName);
	}
});



 ?>