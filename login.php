<?php 
session_start();
require_once 'dbconnect.php';


if (isset($_SESSION['user'])){
	header("Location: index.php");
}

if  (isset($_GET['logout'])) {
	unset($_SESSION['user']);
	session_unset();
	session_destroy();
	header("Location: index.php");
	exit;
}

	
// LOG IN and REGISTRATION here
$error = false;

//***************************************************** LOG IN
if( isset($_POST['btn-login']) ) {
		    // email validation
		    $email = trim($_POST['email']);
		    $email = strip_tags($email);
		    $email = htmlspecialchars($email);

		    if(empty($email)){
		        $error = true;
		        $emailError = "Please enter your email address.";
		    } else if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
		        $error = true;
		        $emailError = "Please enter valid email address.";
		    }

		    // password validation
		    $pass = trim($_POST[ 'pass']);
		    $pass = strip_tags($pass);
		    $pass = htmlspecialchars($pass);

		    if (empty($pass)){
		        $error = true;
		        $passError = "Please enter your password." ;
		    }

		    // error check
		    if (!$error) {
		          
		        $password = hash( 'sha256', $pass); // password hashing

		        $res=mysqli_query($conn, "SELECT * FROM users WHERE emailUsr='$email'" );
		        $row=mysqli_fetch_array($res, MYSQLI_ASSOC);
		        $count = mysqli_num_rows($res); 

		        // check PASSWORD
		        if( $count == 1 && $row['passUsr' ]==$password ) {
		            $_SESSION['user'] = $row['userID'];
		            $_SESSION['userType'] = $row['user_type'];
		            $_SESSION['userName'] = $row['nameUsr'];
		            
		            if ($_SESSION['userType'] == 'admin') {
		            	header( "Location: manager.php"); //admin login - redirect to manager.php
		            } else {
		            	header( "Location: index.php"); // user login - redirect to index
		            }
		            
		            
		        } else {
		            $errMSG = "Email or password does not match, try again..." ;
		            $errTyp = 'danger';
		            //header( "Location: login.php?login"); // stay at the same page
		        }

		    }
}
//*************************************************** REGISTRATION
//$error = false;
if (isset($_POST['btn-signup'])) {
		 
		    // sanitize user input to prevent sql injection
		    $name = trim($_POST['nameReg']);

		    //trim - strips whitespace (or other characters) from the beginning and end of a string
		    $name = strip_tags($name);

		    // strip_tags — strips HTML and PHP tags from a string

		    $name = htmlspecialchars($name);
		    // htmlspecialchars converts special characters to HTML entities
		    $email = trim($_POST[ 'emailReg']);
		    $email = strip_tags($email);
		    $email = htmlspecialchars($email);

		    $pass = trim($_POST['passReg']);
		    $pass = strip_tags($pass);
		    $pass = htmlspecialchars($pass);

		    // basic name validation
		    if (empty($name)) {
		        $error = true ;
		        $nameError = "Please enter your full name.";
		    } else if (strlen($name) < 3) {
		        $error = true;
		        $nameError = "Name must have at least 3 characters.";
		    } else if (!preg_match("/^[a-zA-Z ]+$/",$name)) {
		        $error = true ;
		        $nameError = "Name must contain alphabets and space.";
		    }

		    //basic email validation
		    if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
		        $error = true;
		        $emailError = "Please enter valid email address." ;
		    } else {
		        // checks whether the email exists or not
		        $query = "SELECT emailUsr FROM users WHERE emailUsr='$email'";
		        $result = mysqli_query($conn, $query);
		        $count = mysqli_num_rows($result);
		        if($count!=0){
		            $error = true;
		            $emailError = "Provided Email is already in use.";
		        }
		    }

		    // password validation
		    if (empty($pass)){
		        $error = true;
		        $passError = "Please enter password.";
		    } else if(strlen($pass) < 6) {
		        $error = true;
		        $passError = "Password must have atleast 6 characters." ;
		    }

		    // password hashing for security
		    $password = hash('sha256' , $pass);


		    // if there's no error, continue to signup
		    if( !$error ) {
		         
		        $query = "INSERT INTO users(nameUsr,emailUsr,passUsr) VALUES('$name','$email','$password')";
		        $res = mysqli_query($conn, $query);
		         
		        if ($res) {
		            $errTyp = "success";
		            $errMSG = "Successfully registered, you may login now";
		            unset($name);
		            unset($email);
		            unset($pass);
		        } else  {
		            $errTyp = "danger";
		            $errMSG = "Something went wrong, try again later..." ;
		        }
		    }
}
//end of login/registr

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- BOOTSTRAP LINK-->
	<link rel ="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"  integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin ="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<!-- -->
	<title>Happy Animals | Log in or register</title>
	<!-- -->
</head>
<body class="bg-light">
	<div class="container my-5 bg-info p-3">
		<div class="">
			<a href="index.php"><i class="fa fa-times" style="font-size:48px;color: white"></i></a>
		</div>
		<h3 class="text-white text-center">Log In or <span>
			<a href="#" data-toggle="collapse" data-target="#reg">register</a>
		</span>
		</h3>

    		<!-- LOG IN FORM -->
    		<div class="w-50 mx-auto p-3">
    			<?php if (isset($errMSG)) {
                        echo '<div  class="alert alert-'.$errTyp.'">'.$errMSG.'</div>';
                    }	?>
    			<form class="text-white" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
    				<div class="form-group">
						<label for="usr">E-mail:</label>
						<input type="email" class="form-control" id="usr" placeholder="Enter the e-mail" name="email" value="<?php echo $email; ?>">
                        <span class="text-danger"><?php  echo $emailError; ?></span >
					</div>
					<div class="form-group">
						<label for="pwd">Password:</label>
						<input type="password" class="form-control" id="pwd" name="pass">
                        <span  class="text-danger"><?php  echo $passError; ?></span>
					</div>    				
    				<button id="login" class="w-25 mx-auto btn btn-light" type="submit" name="btn-login">Log in</button>
    			</form>
    		</div>
    		
    		<!-- REGISTR FORM -->
    		<div class="w-50 mx-auto p-3">                
                
                <div id="reg" class="collapse">
                    
                    <form class="text-white" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                        <div class="form-group">
                            <label for="usr-name">Your Name:</label>
                            <input type="text" class="form-control" id="usr-name" placeholder="Enter your name..." name="nameReg" value = "<?php echo $name ?>">
                            <span   class = "text-warning"> <?php   echo  $nameError; ?> </span>
                        </div>
                        <div class="form-group">
                            <label for="usr-email">Your E-mail:</label>
                            <input type="email" class="form-control" id="usr-email" placeholder="Enter E-mail..." name="emailReg" value = "<?php echo $email ?>">
                            <span   class = "text-warning"> <?php   echo  $emailError; ?> </span>
                        </div>
                        <div class="form-group">
                            <label for="usr-pass">Your Password:</label>
                            <input type="password" class="form-control" id="usr-pass" placeholder="Enter your password" name="passReg">
                            <span   class = "text-warning" > <?php   echo  $passError; ?> </span>
                        </div>
                        <button id="register" class="w-25 mx-auto btn btn-light" type="submit" name="btn-signup">Register</button>
                    </form>
                </div>
    		</div>
		
	</div>

<!-- SCRIPTS ZONE -->
<script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<script src="" type="text/javascript"></script>
</body>
</html>