<?php 
    
	require_once 'DbConnect.php';
	
		$response = array();

	
		if($_SERVER['REQUEST_METHOD']=='POST')
	{

		 if(
		 		isset($_POST['pname'])
		  	and isset($_POST['pgen'])
		  	and isset($_POST['page'])
		   	and isset($_POST['pmob'])
		    and isset($_POST['pemail'])
		    and isset($_POST['pcity'])
		    and isset($_POST['did'])

		)
		 {

		 	
					$pname = $_POST['pname'];
					$pgen = $_POST['pgen'];									 
					$page = $_POST['page'];
					$pmob = $_POST['pmob'];
					$pemail = $_POST['pemail'];
					$pcity = $_POST['pcity'];
					$did = $_POST['did'];
				 	
			
					$stmt = $conn->prepare("SELECT id FROM patients WHERE id = ? OR pemail = ?");
					$stmt->bind_param("is", $id, $pemail);
					$stmt->execute();
					$stmt->store_result();
					
					
					if($stmt->num_rows > 0){
						$response['error'] = true;
						$response['message'] = 'User already registered';
						$stmt->close();
					}else{
						
					
	$stmt = $conn->prepare("INSERT INTO patients (id,pname,pgen,page,pmob,pemail,pcity,did) VALUES (?,?,?,?,?,?,?,?)");
	$stmt->bind_param("issiissi",$id,$pname,$pgen,$page,$pmob,$pemail,$pcity,$did);
										
										

			if($stmt->execute()){

			$stmt = $conn->prepare("SELECT  id,pname,pgen,page,pmob,pemail,pcity,did FROM patients WHERE pemail = ?"); 
							$stmt->bind_param("s",$pemail);
							$stmt->execute();
							$stmt->bind_result( $id,$pname,$pgen,$page,$pmob,$pemail,$pcity,$did);
							$stmt->fetch();

							$user = array(

								'id'=>$id,
								'pname'=>$pname, 
								'pgen'=>$pgen,
								'page'=>$page,	
								'pmob'=>$pmob,
								'pemail'=>$pemail,
								'pcity'=>$pcity,
								'did'=>$did
							);						
							$stmt->close();

							$response['error'] = false; 
							$response['message'] = 'User registered successfully'; 
							$response['user'] = $user; 
						}
					}
					
				}else{
					$response['error'] = true; 
					$response['message'] = 'required parameters are not available'; 
				}
			
	}
else
	{

		$response['error'] = true; 
		$response['message'] = 'Invalid API Call';
	}

			echo json_encode($response);
