<?php
require_once'DbConnect.php';
//echo "hi-1";
if(isset($_POST['id']) and isset($_POST['status']))
{

$id = $_POST['id'];
$status = $_POST['status'];
if( $status == 1)
{
$sql = "UPDATE doctors SET status = 0 WHERE id = '$id' ";

if ($conn->query($sql) === TRUE) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . $conn->error;
}

 }

}


?>