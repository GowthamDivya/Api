<?php
require_once'DbConnect.php';


$response = array("fever");

//if($_SERVER['REQUEST_METHOD']=='POST')
//{

$size=sizeof($response);
$size1=(int)$size;
//echo $size;
$i =0;
while($i <$size) {
  // echo "loop";
   $res =mysqli_query($conn,"SELECT sname FROM `symptoms` WHERE cname = '$response[$i]'") ;
   $j=sizeof($res);

    $k=0;
    while($k<=$j)
    {
    $data = mysqli_fetch_array($res);
    $k++;
//echo $data;
echo "symptoms".$data['sname'];
    }
   
   $i++;
$data1 = mysqli_fetch_array($res);
//echo $data;
echo "symptoms".$data1['sname'];
}
?>