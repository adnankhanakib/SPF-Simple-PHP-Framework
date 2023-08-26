<?php

	include './core/functions.php';
	$jsonData = file_get_contents("./app.json");
	$jsonData = stripslashes(html_entity_decode($jsonData));

	$routes = json_decode($jsonData,true)['routes'];
	$error_pages = json_decode($jsonData,true)['error_pages'];
	$general = json_decode($jsonData,true)['general'];

	$reqHandler = @strtolower(reqGet('page'));

	$general['debug'] ? ini_set("display_errors", 1) : ini_set("display_errors", 0);
	
	if(empty($reqHandler)){
		if(empty($routes['index'])){
			echo "<h1>Welcome,</h1><p>There is no index loaded yet</p>";
			prettyPrint(($general));
			exit;
		}
		ob_start("setJsonValue");
		include $routes['index'];
		ob_end_flush();
	}else if(isset($routes[$reqHandler])){
		ob_start("setJsonValue");
		include $routes[$reqHandler];
		ob_end_flush();
	}else{
		include $error_pages['404'];
	}
	
	


?>