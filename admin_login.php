<?php
require_once'DbConnect.php';
$response = array();
if($_SERVER['REQUEST_METHOD']=='POST')
{
    if(isset($_POST['username']) and isset($_POST['password']))
    { 
        
        $username = $_POST['username'];
        $password = md5($_POST['password']);
        
					//creating the query 
					$stmt = $conn->prepare("SELECT id, username, email, gender FROM users WHERE username = ? AND password = ?");
					$stmt->bind_param("ss",$username, $password);
					
					$stmt->execute();
					
					$stmt->store_result();
					
					//if the user exist with given credentials 
					if($stmt->num_rows > 0){
						
						$stmt->bind_result($id, $username, $email, $gender);
						$stmt->fetch();
					
						$user = array(
							'id'=>$id, 
							'username'=>$username, 
							'email'=>$email,
							'gender'=>$gender
                        );
                    
                        $response['error'] = false; 
						$response['message'] = 'Login successfull'; 
                        $response['user'] = $user; 
                
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