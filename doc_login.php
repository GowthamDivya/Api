<?php
require_once'DbConnect.php';
$response = array();
if($_SERVER['REQUEST_METHOD']=='POST')
{
    if(isset($_POST['demail']) and isset($_POST['dpass']))
    { 
        
        $demail = $_POST['demail'];
        $dpass = $_POST['dpass'];
        
					//creating the query 
					$stmt = $conn->prepare("SELECT  id,dname,dgen,dmob,demail,dcity,dspec,dexp,dreg,status FROM doctors WHERE demail = ? AND dpass = ?");
					$stmt->bind_param("ss",$demail,$dpass);
					
					$stmt->execute();
					
					$stmt->store_result();
					
					//if the user exist with given credentials 
					if($stmt->num_rows > 0){
						
						$stmt->bind_result($id,$dname,$dgen,$dmob,$demail,$dcity,$dspec,$dexp,$dreg,$status);
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
							'status'=>$status,
                        );
                        if($status == 1)
                        {

                        $response['error'] = false; 
						$response['message'] = 'Login successfull'; 
                        $response['user'] = $user; 
                  	    	
                        }
                        else
                        {
                        	$response['message'] = 'user not activated';
                        }
                    
                
                    }else{
						//if the user not found 
						$response['error'] = false; 
						$response['message'] = 'Invalid username or password';
					}
				}
    }
    else{
        $response['error'] = true; 
        $response['message'] = 'required parameters are not available'; 
    }
            echo json_encode($response);

?>