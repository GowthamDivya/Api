
<?php
require_once'DbConnect.php';
$response = array();
if($_SERVER['REQUEST_METHOD']=='POST')
{
    if(isset($_POST['cid']) )
    { 
        $cid = $_POST['cid'];
        

echo $cid;
$test = [];
var_dump($test);exit; 
$prod = array(1,2,3);
array_push($prod, $cid); 
echo "tnis is print";   
print_r($prod);
           //checking if the user is already exist with this username or email
                    //as the email and username should be unique for every user 

					//$stmt = $conn->prepare(" SELECT id FROM users WHERE username = ? OR email = ?");              
$stmt = $conn->prepare("select S.sname from symptoms S INNER JOIN complaints C on C.cid= S.cid where S.cid in(?)");

print_r($stmt);

echo "hii";
                    $stmt->bind_param("i",$prod);
                    print_r($stmt);

                    $stmt->execute();
                    $stmt->bind_result($sname);
					$stmt->store_result();
print_r($stmt);
$products = array();

while($stmt->fetch()){
        $temp = array();
        $temp['sname'] = $sname;


        array_push($products, $temp);
    }
    
    //displaying the result in json format 
    echo json_encode($products);


                    }
                }
