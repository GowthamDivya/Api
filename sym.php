<?php
require_once'DbConnect.php';
$response = array(1);
if($_SERVER['REQUEST_METHOD']=='POST')
{
    	
    
        $cname = $_POST['cname'];


        		// echo "string";
        	//  var_dump($cname);
        	var_dump($response);	
       		print_r($cname);

       			$size=sizeof($response);
				$size1=(int)$size;
				echo $size;

				$i =0;
		while($i <2) {


$q = "SELECT * FROM symptoms where cid= '1'";
$result = mysql_query($q) or die(mysql_error());

if($result){
    $row = mysql_fetch_array($result) or die(mysql_error());
    $name = $row['sid'];   
    }

echo "hello".$name;

  // echo "loop";
  // $res =mysqli_query($conn,"SELECT sname FROM `symptoms` WHERE cid = '$response[$i]'") ;
   //echo "$res(sname)";
   //$j =mysqli_query($conn,"SELECT count(sname) FROM `symptoms` WHERE cid = '1';");
//echo "$j";
    $k=0;
  //  while($k<=$j)
    //{
    //$data = mysqli_fetch_array($res);
    //$k++;
//echo $data;
//echo "".$data['sname'];
   //echo "<br>";
    //}
   
   $i++;
//$data1 = mysqli_fetch_array($res);
//echo $data;
//echo "sum of expenses".$data1['sname'];
$query = mysql_query("SELECT * FROM symptoms");


$number=mysql_num_rows($query);


echo "Total records in Student table= ". $number;

}








}

?>







