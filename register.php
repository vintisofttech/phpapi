<?php
 
   if($_SERVER['REQUEST_METHOD']=='POST'){
  // echo $_SERVER["DOCUMENT_ROOT"];  // /home1/demonuts/public_html
//including the database connection file
       include_once("config.php");
       
        $username= $_POST['username'];
 	$email= $_POST['email'];
 	$password = $_POST['password'];
 	$gender= $_POST['gender'];
        $address= $_POST['address'];
        $city= $_POST['city'];
        $areacode= $_POST['areacode'];
        $contact= $_POST['contact'];
  
	 if($username == '' || $email== '' || $password == '' || $gender== '' || $address== '' || $city=='' || $areacode== '' || $contact== ''){
	        echo json_encode(array( "status" => "false","message" => "All Fields Are Required!") );
	 }else{
			 
	        $query= "SELECT * FROM `users` WHERE `email`='$email'";
	        $result= mysqli_query($con, $query);
		 
	        if(mysqli_num_rows($result) > 0){  
	           echo json_encode(array( "status" => "false","message" => "email already exist!") );
	        }else{ 
		 	 $query = "INSERT INTO users(`username`, `email`, `password`, `gender`, `address`, `city`, `areacode`, `contact`) VALUES ('$username','$email','$password','$gender','$address','$city','$areacode','$contact')";
			 if(mysqli_query($con,$query)){
			    
			     $query= "SELECT * FROM users WHERE email='$email'";
	                     $result= mysqli_query($con, $query);
		             $emparray = array();
	                     if(mysqli_num_rows($result) > 0){  
	                     while ($row = mysqli_fetch_assoc($result)) {
                                     $emparray[] = $row;
                                   }
	                     }
			    echo json_encode(array( "status" => "true","message" => "Successfully registered!" , "data" => $emparray) );
		 	 }else{
		 		 echo json_encode(array( "status" => "false","message" => "Error occured, please try again!") );
		 	}
	    }
	            mysqli_close($con);
	 }
     } else{
			echo json_encode(array( "status" => "false","message" => "Error occured, please try again!") );
	}
 
 ?>
