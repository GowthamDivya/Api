<?php 
    
	require_once 'DbConnect.php';
	
		$response = array();
	
	
	
		if($_SERVER['REQUEST_METHOD']=='POST')
	{

 
		 if(
		 		isset($_POST['dname'])
		  	and isset($_POST['dgen'])
		   	and isset($_POST['dmob'])
		    and isset($_POST['demail'])
		    and isset($_POST['dpass'])
		    and isset($_POST['dcity'])
		    and isset($_POST['dspec'])
		    and isset($_POST['dexp'])
		    and isset($_POST['dreg'])

		)
		 {
		 	
					$dname = $_POST['dname'];
					$dgen = $_POST['dgen'];									 
					$dmob = $_POST['dmob'];
					$demail = $_POST['demail'];
					$dpass = md5($_POST['dpass']);
					$dcity = $_POST['dcity'];
					$dspec = $_POST['dspec'];
					$dexp = $_POST['dexp'];
					$dreg = $_POST['dreg'];
					$status = 0;	
			
					$stmt = $conn->prepare("SELECT id FROM doctors WHERE dmob = ? OR demail = ?");
					$stmt->bind_param("is", $dmob, $demail);
					$stmt->execute();
					$stmt->store_result();
					
					
					if($stmt->num_rows > 0){
						$response['error'] = true;
						$response['message'] = 'User already registered';
						$stmt->close();
					}else{
						
					
		$stmt = $conn->prepare("INSERT INTO doctors (dname,dgen,dmob,demail,dpass,dcity,dspec,dexp,dreg,status) VALUES (?, ?, ?, ?,?,?,?,?,?,?)");
						$stmt->bind_param("ssissssiii", $dname, $dgen,$dmob,$demail,$dpass,$dcity,$dspec,$dexp,$dreg,$status);
					
					


						if($stmt->execute()){
			$stmt = $conn->prepare("SELECT  id, dname,dgen,dmob,demail,dcity,dspec,dexp,dreg,status FROM doctors WHERE demail = ?"); 
							$stmt->bind_param("s",$demail);
							$stmt->execute();
							$stmt->bind_result( $id, $dname,$dgen,$dmob,$demail,$dcity,$dspec,$dexp,$dreg,$status);
							$stmt->fetch();
							$user = array(
								'id'=>$id, 
								'dname'=>$dname, 
								'dgen'=>$dgen,
								'dmob'=>$dmob,	
								'demail'=>$demail,
								'dcity'=>$dcity,
								'dspec'=>$dspec,
								'dexp'=>$dexp,
								'dreg'=>$dreg,
								'status'=>$status
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
