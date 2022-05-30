<?php
public function insert(){
		
	if($this->name && $this->email && $this->verify_token) {

		$stmt = $this->conn->prepare("
		INSERT INTO ".$this->subscribersTable."(`name`, `email`, `verify_token`)
		VALUES(?,?,?)");
	
		$this->name = htmlspecialchars(strip_tags($this->name));
		$this->email = htmlspecialchars(strip_tags($this->email));
		$this->verify_token = htmlspecialchars(strip_tags($this->verify_token));					
		
		$stmt->bind_param("sss", $this->name, $this->email, $this->verify_token);
		
		if($stmt->execute()){
			return true;
		}		
	}
}
public function update(){
		
	if($this->verify_token) {			
		
		$stmt = $this->conn->prepare("
		UPDATE ".$this->subscribersTable." 
		SET is_verified= ? WHERE verify_token = ?");
 
		$this->verify_token = htmlspecialchars(strip_tags($this->verify_token));
				
		$stmt->bind_param("is", $this->is_verified, $this->verify_token);
		
		if($stmt->execute()){
			return true;
		}
		
	}	
}
?>