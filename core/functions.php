<?php
$jsonData = file_get_contents("./app.json");
$jsonData = stripslashes(html_entity_decode($jsonData));
$app = json_decode($jsonData);

// echo $app->general->site_name;



	function esc($str){
		return htmlspecialchars($str);
	}

	function reqPost($field){
		return esc($_POST[$field]);
	}
	function reqGet($field){
		return esc($_GET[$field]);
	}
	function sendCurl($data,$esc=0){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt_array($ch, $data);

		$resp = curl_exec($ch);
		curl_close($ch);
		// $esc ? return esc($resp) : return $resp;
		if ($esc) {
			return esc($resp);
		}else{
			return ($resp);
		}
	}
	
	function sendReq($url,$esc=0){
		if($esc){
			return esc(file_get_contents($url));
		}else{
			return file_get_contents($url);
		}
	}

	function write($filename,$data,$openas="a"){
		$f = fopen($filename,$openas);
		fwrite($f,$data);
		if(fclose($f)){
			return 1;
		}else{
			return 0;
		}
	}

	function prettyPrint($data){
		echo "<pre>";
		print_r($data);
		echo "</pre>";
		return 1;
	}

	function setJsonValue($buffer) {
		global $app;
	    $regex = '/{{(.*?)}}/';
	    preg_match_all($regex, $buffer,$matches);
	    $items_thread = array_unique($matches[1], SORT_REGULAR);
	    foreach ($items_thread as $key => $value) {
	    	$s = $items_thread[$key];
	    	$test = $s;
			$val = $app;
			foreach(explode('->', $test) as $item) {
			  $val = $val->$item;
			}
			// die($val);

			$buffer = str_replace('{{'.$s.'}}', "$val", $buffer);
	    }
	    return $buffer;
	}

?>