<?php
session_start();

require '../../class/db-connection.php';
connection();
$aResponse['error'] = false;

$aResponse['message'] = '';

// ONLY FOR THE DEMO, YOU CAN REMOVE THIS VAR
	$aResponse['server'] = ''; 
// END ONLY FOR DEMO
	
	
if(isset($_POST['action']))
{
	if(htmlentities($_POST['action'], ENT_QUOTES, 'UTF-8') == 'rating')
	{
		/*
		* vars
		*/
		$rest_id = intval($_POST['idBox']);
		$rate = floatval($_POST['rate']);
		
               
               
		
		// if request successful
		$success = true;
		
                if(isset($_SESSION['user_id']))
                {
                 $foodie_id= $_SESSION['user_id'];
                    $query="insert into rating(rate,foodie_id,rest_id)values('{$rate}','{$foodie_id}','{$rest_id}')";
                    mysql_query($query) or die(mysql_error());
                }
                else
                {
                    header("location:../../user-login.php");
                }
               
            
                
		
	}
	else
	{
		$aResponse['error'] = true;
		$aResponse['message'] = '"action" post data not equal to \'rating\'';
		
		// ONLY FOR THE DEMO, YOU CAN REMOVE THE CODE UNDER
			$aResponse['server'] = '<strong>ERROR :</strong> "action" post data not equal to \'rating\'';
		// END ONLY FOR DEMO
			
		
		echo json_encode($aResponse);
	}
}
else
{
	$aResponse['error'] = true;
	$aResponse['message'] = '$_POST[\'action\'] not found';
	
	// ONLY FOR THE DEMO, YOU CAN REMOVE THE CODE UNDER
		$aResponse['server'] = '<strong>ERROR :</strong> $_POST[\'action\'] not found';
	// END ONLY FOR DEMO
	
	
	echo json_encode($aResponse);
}