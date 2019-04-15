<?php
require_once'DbConnect.php';
$response = array();
if($_SERVER['REQUEST_METHOD']=='POST')
{
    if(isset($_POST['username']) and isset($_POST['email']) and isset($_POST['password']) and isset($_POST['gender']))
    { 
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $gender = $_POST['gender'];

    
           //checking if the user is already exist with this username or email
                    //as the email and username should be unique for every user 
                    echo "hi";
					$stmt = $conn->prepare("SELECT id FROM users WHERE username = ? OR email = ?");              
                    echo "hi";
                    $stmt->bind_param("ss", $username, $email);
                    $stmt->execute();
					$stmt->store_result();
                    

                  //if the user already exist in the database           
					if($stmt->num_rows > 0){
						$response['error'] = true;
						$response['message'] = 'User already registered';
						$stmt->close();
                    }
                    else{
						$stmt = $conn->prepare("INSERT INTO users (username, email, password, gender) VALUES (?, ?, ?, ?)");
						$stmt->bind_param("ssss", $username, $email, $password, $gender);

						if($stmt->execute()){
							$stmt = $conn->prepare("SELECT id, id, username, email, gender FROM users WHERE username = ?"); 
							$stmt->bind_param("s",$username);
							$stmt->execute();
							$stmt->bind_result($userid, $id, $username, $email, $gender);
							$stmt->fetch();
							
							$user = array(
								'id'=>$id, 
								'username'=>$username, 
								'email'=>$email,
								'gender'=>$gender
							);
							
							$stmt->close();
							$response['error'] = false; 
							$response['message'] = 'User registered successfully'; 
							$response['user'] = $user; 
						}
					}   
    }
    else{
        $response['error'] = true; 
        $response['message'] = 'required parameters are not available'; 
    }
            echo json_encode($response);


}



?>