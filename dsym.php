<?php 

	/*
	* Created by Belal Khan
	* website: www.simplifiedcoding.net 
	* Retrieve Data From MySQL Database in Android
	*/
	
	//database constants
	define('DB_HOST', 'localhost');
	define('DB_USER', 'gowtham');
	define('DB_PASS', 'gowtham');
	define('DB_NAME', 'eDR');
	
	//connecting to database and getting the connection object
	$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	
	//Checking if any error occured while connecting
	if (mysqli_connect_errno()) {
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
		die();
	}


$data = array(1,2,3,4,5);
$x =0;
while($x <= 5) {
  
echo $data[$x];

  $x++;
}
 
	
	//creating a query
	$stmt = $conn->prepare("SELECT sname FROM symptoms INNER JOIN complaints ON symptoms.$data[$x] = complaints.$data[$x];");
	
	//executing the query 
//	$stmt->execute();
	
	//binding results to the query 
	$stmt->bind_result($sname);
	
	$products = array(); 
	
	//traversing through all the result 
	while($stmt->fetch()){
		$temp = array();
		$temp['sname'] = $sname; 

		array_push($products, $temp);
	}
	
	//displaying the result in json format 
	echo json_encode($products);