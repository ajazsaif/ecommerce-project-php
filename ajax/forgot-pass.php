<?php
require_once('../includes/top.php');

if(isset($_POST['id']) && $_POST['id']!=null){
    $email = $_REQUEST['id'];
    $email_query = "select * from users where email='$email'";
  if($db_handle->numRows($email_query)>0){
	$email_row  =   $db_handle->RunQuery($email_query); 
	  $token=TokenGenerate($email_row[0]["email"]);
	  $fields  = array("token"=>$token);
	  if($db_handle->updateQuery("users",$fields,"email='$email'")){
	  if($db_handle->MailSend($email_row[0]["email"],__WEBROOT__."/reset.php?token=$token")){
	  	echo "We sent password reset link on your email.";
		  }else{
		  	echo "OOPS somthing is wrong.";
		  } 
		}else{
		 echo "OOPS somthing is wrong.";	
		}
    }else{
     echo "You are not registered with us. Please sign up.";
    }  
}else{
 echo "Please enter email id.";
}
?>

