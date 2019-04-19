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
					$pid = mt_rand(100000,999999); 	
					echo $pid;


	
			
					$stmt = $conn->prepare("SELECT id FROM patients WHERE pid = ? OR pemail = ?");
					$stmt->bind_param("is", $pid, $pemail);
					$stmt->execute();
					$stmt->store_result();
					
					

					if($stmt->num_rows > 0){
						$response['error'] = true;
						$response['message'] = 'User already registered';
						$stmt->close();
					}else{
						
					
	$stmt = $conn->prepare("INSERT INTO patients (pid,pname,pgen,page,pmob,pemail,pcity,did) VALUES (?,?,?,?,?,?,?,?)");
	$stmt->bind_param("issiissi",$pid,$pname,$pgen,$page,$pmob,$pemail,$pcity,$did);
										
										

											if($stmt->execute()){

			$stmt = $conn->prepare("SELECT  pid,pname,pgen,page,pmob,pemail,pcity,did FROM patients WHERE pid = ?"); 
							$stmt->bind_param("i",$pid);
							$stmt->execute();
							$stmt->bind_result( $pid, $pname,$pgen,$page,$pmob,$pemail,$pcity,$did);
							$stmt->fetch();
							$user = array(
								'pid'=>$pid, 
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
