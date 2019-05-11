
<?php
require_once'DbConnect.php';

echo "res";
exit;
$response = array(1,2,3);

if($_SERVER['REQUEST_METHOD']=='POST')

{


$size=sizeof($response);

$size1=(int)$size;

$i =0;
while($i <$size) {
  
   $res =mysqli_query($conn,"SELECT sname FROM `symptoms` WHERE cid = '$response[$i]'") ;

//$stmt = $conn->prepare("SELECT  id, dname,dgen,dmob,demail,dcity,dspec,dexp,dreg,status FROM doctors WHERE demail = ?"); 

   $j=sizeof($res);

    $k=0;
    while($k<=$j)
    {
    $data = mysqli_fetch_array($res);
    $k++;
//echo $data;
  echo "sum of expenses".$data['sname'];
  
    }
   
   $i++;
$data1 = mysqli_fetch_array($res);
//echo $data;
echo "sum of expenses".$data1['sname'];
}
?>