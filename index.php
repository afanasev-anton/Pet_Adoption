<?php 
ob_start();
session_start();
if (isset($_SESSION['user'])) {
	$_SESSION['entr'] = 'logout';
}
if (isset($_SESSION['userType']) == 'admin'){
	//header("Location: manager.php");
	$link = 'manager.php';
}
require_once 'dbconnect.php';
require_once 'classes.php';
$list = array(); //array with list of animals

$queryList = mysqli_query($conn,"SELECT * FROM animals
		JOIN location ON animals.loca = location.locId");
/* animId name img descr website hobbies ad_date (loca locId) zip city address loc_x loc_y type 
  $animId,$name,$img,$descr,$website,$hobbies,$adDate,$zip,$city,$address,$loc_x,$loc_y,$type */

	if($queryList->num_rows > 0){
	    $rows = $queryList->fetch_all(MYSQLI_ASSOC);
	    foreach ($rows as $value){

	        array_push($list,new Animal ($value['animId'],$value['name'],$value['img'],$value['descr'],$value['website'],$value['hobbies'],$value['ad_date'],$value['zip'],$value['city'],$value['address'],$value['loc_x'],$value['loc_y'],$value['type']) );
	    }	    
	    //$_SESSION['queryMsg'] = "database call succed";
	} else {
	    $_SESSION['queryMsg'] = "We could not find anything, sorry :(";
	}



?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel ="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"  integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin ="anonymous">
	<title>Happy Animals</title>
</head>
<body class="bg-light">
	<div class="container-fluid">
		<div class="row p-3">
			<h1 class="display-1 w-100 text-left text-dark"><span class="text-danger">Happy</span>Animals</h1>
		</div>
		<nav class="navbar navbar-expand-sm bg-light navbar-light sticky-top border-bottom">
			<ul class="navbar-nav w-100">
				<li class="nav-item active">
    				<a  class="nav-link" href="index.php">Home</a>
    			</li>
    			<li class="nav-item">
    				<a class="nav-link" href="general.php">Misc animals</a>
    			</li>
    			<li class="nav-item">
    				<a class="nav-link" href="senior.php">Adopt animal</a>
    			</li>
                <li class="nav-item ml-auto mr-3">
                    <span class="mx-2"><?php if(isset($_SESSION['user'])){echo 'Welcome back, '.$_SESSION['userName'];} ?></span>
                    
                    <?php if (isset($_SESSION['entr']) == 'logout') {
                    	echo '<a class="btn btn-outline-primary" href="login.php?logout">Log Out</a>';
                    } else{
                    	echo '<a class="btn btn-outline-primary" href="login.php">Log In</a>';
                    }?>
                </li>
    		</ul>
    	</nav>

		<div class="row p-3">
    		<h3 class="w-100 text-center text-info"><?php echo $_SESSION['queryMsg']; ?></h3>
    		<?php 
    		if (!isset($_GET['itm'])) {
	    		echo '<h3 class="w-100 text-center text-info">All Cuties</h3>';
	    		foreach ($list as $val) {
	    			$res=$val->printCards();
	    			echo $res;
	            }
            } else {
            	echo '<h3 class="w-100 text-center text-info">Details</h3>';
            	foreach ($list as $val) {	    			
	    			if ($val->getId() == $_GET['itm']) {
	    				
	    				$res=$val->printDetails();
	    				echo $res;
	    			}	    			
	            }
            }
            ?>
    	</div>
		
	</div>
</body>
</html>
<?php ob_end_flush(); ?>