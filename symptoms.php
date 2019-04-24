<?php
require_once'DbConnect.php';
$response = array();
if($_SERVER['REQUEST_METHOD']=='POST')
{
    if(isset($_POST['sname']) and isset($_POST['cid']))
    { 
        $sname = $_POST['sname'];
        $cid = $_POST['cid'];
       
    
           //checking if the user is already exist with this username or email
                    //as the email and username should be unique for every user 

					$stmt = $conn->prepare("SELECT sid FROM symptoms WHERE sname = ? ");              

                    $stmt->bind_param("s",$sname);
                    $stmt->execute();
					$stmt->store_result();
                    

                  //if the user already exist in the database           
					if($stmt->num_rows > 0){
						$response['error'] = true;
						$response['message'] = 'sympto already Exist';
						$stmt->close();
                    }
                    else{
						$stmt = $conn->prepare("INSERT INTO symptoms(sname,cid) VALUES (?,?)");
						$stmt->bind_param("ss",$sname,$cid);

						if($stmt->execute()){
							$stmt = $conn->prepare("SELECT sid,sname,cid FROM symptoms WHERE sname = ?"); 
							$stmt->bind_param("s",$sname);
							$stmt->execute();
							$stmt->bind_result($sid,$sname,$cid);
							$stmt->fetch();
							
							$user = array(
								'id'=>$sid, 
								'sname'=>$sname,
								 'cid'=>$cid
							);
							
							$stmt->close();
							$response['error'] = false; 
							$response['message'] = 'symptoms registered successfully'; 
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



?>