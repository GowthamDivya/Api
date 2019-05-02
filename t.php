 <?php
$cars = array("Volvo", "BMW", "Toyota");
$x = 0;

while($x <= 5) {
    echo $cars[$x].PHP_EOL;
     $res =mysqli_query($conn,"SELECT sname FROM `symptoms` WHERE cname = '$response[$i]'") ;
    $x++;
} 



?> 