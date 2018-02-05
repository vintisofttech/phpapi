 <?php
 if($_SERVER['REQUEST_METHOD']=='POST'){ 
 include_once("config.php");
        $email= $_POST['email'];
 	$password = $_POST['password'];
 if( $email== '' || $password == '' ){
	        echo json_encode(array( "status" => "false","message" => "Email Password Is missing!") );
	 }else{
    $sql= "SELECT * FROM `users` WHERE `email`='$email' AND `password`='$password'";
    $result = mysqli_query($con, $sql) or die("Error in Selecting " . mysqli_error($connection));

    //create an array
    $emparray = array();
    while($row =mysqli_fetch_assoc($result))
    {
        $emparray[] = $row;
    }if(mysqli_num_rows($result) > 0){
    echo json_encode(array( "status" => "true","message" => "Login successfully!", "data" => $emparray) );
}else{ 
	        	echo json_encode(array( "status" => "false","message" => "Invalid Email or password!") );
	        }
	        }
    //close the db connection
    mysqli_close($con);
    }
?>
