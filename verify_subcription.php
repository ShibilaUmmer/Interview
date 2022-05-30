<?php 
include_once 'config/Database.php';
include_once 'class/Subscribe.php';

$database = new Database();
$db = $database->getConnection();

$subscriber = new Subscribe($db);
$statusMsg = '';
if(!empty($_GET['email_verify'])){     
	$verifyToken = $_GET['email_verify']; 	
	$subscriber->verify_token = $verifyToken;
    if($subscriber->verifyToken()){ 
       	$subscriber->is_verified = 1;        
        if($subscriber->update()) { 
            $statusMsg = '<p class="success">Your email address has been verified successfully.</p>'; 
        } else { 
            $statusMsg = '<p class="error">Some problem occurred on verifying your email, please try again.</p>'; 
        } 
    } else { 
        $statusMsg = '<p class="error">You have clicked on the wrong link, please check your email and try again.</p>'; 
	}
}
?>