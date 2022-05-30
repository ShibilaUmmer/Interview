<?php
public function adminLogin(){		
	$errorMessage = '';
	if(!empty($_POST["login"]) && $_POST["email"]!=''&& $_POST["password"]!='') {	
		$email = $_POST['email'];
		$password = $_POST['password'];
		$sqlQuery = "SELECT * FROM ".$this->userTable." 
			WHERE email='".$email."' AND password='".md5($password)."' AND status = 'active' AND type = 'administrator'";
		$resultSet = mysqli_query($this->dbConnect, $sqlQuery);
		$isValidLogin = mysqli_num_rows($resultSet);	
		if($isValidLogin){
			$userDetails = mysqli_fetch_assoc($resultSet);
			$_SESSION["adminUserid"] = $userDetails['id'];
			$_SESSION["admin"] = $userDetails['first_name']." ".$userDetails['last_name'];
			header("location: dashboard.php"); 		
		} else {		
			$errorMessage = "Invalid login!";		 
		}
	} else if(!empty($_POST["login"])){
		$errorMessage = "Enter Both user and password!";	
	}
	return $errorMessage; 		
}
public function getUserList(){		
	$sqlQuery = "SELECT * FROM ".$this->userTable." WHERE id !='".$_SESSION['adminUserid']."' ";
	if(!empty($_POST["search"]["value"])){
		$sqlQuery .= '(id LIKE "%'.$_POST["search"]["value"].'%" ';
		$sqlQuery .= ' OR first_name LIKE "%'.$_POST["search"]["value"].'%" ';
		$sqlQuery .= ' OR last_name LIKE "%'.$_POST["search"]["value"].'%" ';	
	}
	if(!empty($_POST["order"])){
		$sqlQuery .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
	} else {
		$sqlQuery .= 'ORDER BY id DESC ';
	}
	if($_POST["length"] != -1){
		$sqlQuery .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
	}	
	$result = mysqli_query($this->dbConnect, $sqlQuery);

	$sqlQuery1 = "SELECT * FROM ".$this->userTable." WHERE id !='".$_SESSION['adminUserid']."' ";
	$result1 = mysqli_query($this->dbConnect, $sqlQuery1);
	$numRows = mysqli_num_rows($result1);

	$userData = array();	
	while( $users = mysqli_fetch_assoc($result) ) {		
		$userRows = array();
		$status = ''; 
		$userRows[] = $users['id'];
		$userRows[] = ucfirst($users['first_name']." ".$users['last_name']);	
		$userRows[] = $users['email'];	
		$userRows[] = $status;						
		$userData[] = $userRows;
	}
	$output = array(
		"draw"				=>	intval($_POST["draw"]),
		"recordsTotal"  	=>  $numRows,
		"recordsFiltered" 	=> 	$numRows,
		"data"    			=> 	$userData
	);
	echo json_encode($output);
}
?>