<?php

// includes
//ini_set("include_path",".:/home/david/develop/77/3Dapp");
require_once 'views/load.php';
require_once 'models/model.php';
require_once 'controllers/Controller.php';
$pageURI =$_SERVER['REQUEST_URI'];
$pageURI =substr($pageURI,strrpos($pageURI,'index.php')+10);
//$modelID= $_POST["modelID"];
if (strpos($pageURI,'?') == false) {
	if (!$pageURI)
		new Controller('home');
	else
		new Controller($pageURI);
}
//parase the url like showModel?modelID=1
else if (strpos($pageURI, '=') !== false) {
	// echo '11';
	
	$value = substr($pageURI,strrpos($pageURI,'=')+1);
	$param= substr($pageURI,strrpos($pageURI,'?')+1,strrpos($pageURI,'=')-strrpos($pageURI,'?')-1);
	// echo $param;
	$pageURI =substr($pageURI,0,strrpos($pageURI,'?'));
	new Controller($pageURI,array($param=>$value));
}
else
	new Controller($pageURI);
?>