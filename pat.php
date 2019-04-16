<?php

require_once 'DbConnect.php';
if($_SERVER['REQUEST_METHOD']=='POST')
	{

 
		 if(
		 		isset($_POST['pname'])
		  	and isset($_POST['pgen'])
		   	and isset($_POST['pmob'])
		    and isset($_POST['pemail'])
		    and isset($_POST['pcity'])
		    and isset($_POST['pdoc'])

		)
	}
	else
	{

		$response['error'] = true; 
		$response['message'] = 'Invalid API Call';
	}

			echo json_encode($response);

			
	

?>