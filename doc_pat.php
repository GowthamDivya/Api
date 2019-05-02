<?php 


require_once 'DbConnect.php';


	if($_SERVER['REQUEST_METHOD']=='POST')
	{
		if(isset($_POST['did']))
		{
					$did =$_POST['did'];


					$stmt = $conn->prepare("SELECT id,pname,page,pgen,pmob FROM patients WHERE did = ?");
				$stmt->bind_param("i", $did);		


					$stmt->execute();

					$stmt->bind_result($id,$pname,$page,$pgen,$pmob);
					$products = array();

					while($stmt->fetch()){

		$temp = array();
		$temp['id'] = $id; 
		$temp['pname'] = $pname; 
		$temp['page'] = $page; 
		$temp['pgen'] = $pgen;
		$temp['pmob'] = $pmob;


		array_push($products, $temp);
	}

echo json_encode($products);

		}

	}
