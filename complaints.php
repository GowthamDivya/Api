<?php
require_once'DbConnect.php';
$response = array();
if($_SERVER['REQUEST_METHOD']=='POST')
{
    if(isset($_POST['cname']))
    { 
        $cname = $_POST['cname'];
       
    
           //checking if the user is already exist with this username or email
                    //as the email and username should be unique for every user 
                    echo "hi";
					$stmt = $conn->prepare("SELECT cid FROM complaints WHERE cname = ? ");              

                    $stmt->bind_param("s",$cname);
                    $stmt->execute();
					$stmt->store_result();
                    

                  //if the user already exist in the database           
					if($stmt->num_rows > 0){
						$response['error'] = true;
						$response['message'] = 'Complaint already Exist';
						$stmt->close();
                    }
                    else{
						$stmt = $conn->prepare("INSERT INTO complaints(cname) VALUES (?)");
						$stmt->bind_param("s", $cname);

						if($stmt->execute()){
							$stmt = $conn->prepare("SELECT cid,cname FROM complaints WHERE cname = ?"); 
							$stmt->bind_param("s",$cname);
							$stmt->execute();
							$stmt->bind_result($cid,$cname);
							$stmt->fetch();
							
							$user = array(
								'id'=>$cid, 
								'cname'=>$cname 
							);
							
							$stmt->close();
							$response['error'] = false; 
							$response['message'] = 'Complaint registered successfully'; 
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