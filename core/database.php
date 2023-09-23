<?php


	$jsonData = file_get_contents("./app.json");
	$jsonData = stripslashes(html_entity_decode($jsonData));
	$app = json_decode($jsonData);

	$databaseInfo = $app['database'];

	if(empty($databaseInfo['host'])) return;

	$conn = mysqli_connect($databaseInfo['host'],$databaseInfo['username'],$databaseInfo['password'],$databaseInfo['name']);

	function FetchData($select,$table,$extra='',$id=0){
        global $conn;
        if ($extra) {
            $qu = "SELECT {$select} FROM $table WHERE {$extra}";
        }else{
            $qu = "SELECT {$select} FROM $table";
        }
        // echo $qu;
        return mysqli_fetch_array(mysqli_query($conn,$qu))[$id];
        // return die($qu);
    }


	function GetCount($table,$select='',$id='',$extra=''){
	    global $conn;
	    if($select==""){
	        $sql = "SELECT COUNT(*) FROM {$table}";
	    }else{
	        $sql = "SELECT COUNT(*) FROM {$table} WHERE {$select}='{$id}'";
	    }

	    if($extra!=""){
	        $sql.=" $extra";
	    }
	    // return mysqli_fetch_array(mysqli_query($conn,$sql))[0];
	    return mysqli_fetch_array(mysqli_query($conn,$sql))[0];
	    // return $sql;
	}

	function InsertTable($table,$array){
	    global $conn;
	    $count = 0;
	    $emptyArray = array();
	    for ($i=0; $i < sizeof($array); $i++) { 
	        array_push($emptyArray, array_keys($array)[$i]."='".array_values($array)[$i]."'");
	    }
	    $sql = "INSERT INTO `".$table."` SET " . join(',', $emptyArray) . "";
	    if (mysqli_query($conn,$sql)) {
	        //echo $sql;
	        return 1;
	      }else{
	        // echo $sql;
	        // print_r($array);
	        return 0;
	      } 
	}
?>