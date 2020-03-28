<?php 
session_start();
if (isset($_SESSION['user'])!="") {
    $_SESSION['entr'] = 'logout';
} else if (isset($_SESSION['user']) == 'admin'){
    header("Location: manager.php");
}
require_once 'dbconnect.php';
require_once 'classes.php';
$list = array(); //array with list of media

$queryList = mysqli_query($conn,"SELECT * FROM animals
        JOIN location ON animals.loca = location.locId
        WHERE animals.type='sen'");

if($queryList->num_rows > 0){
    $rows = $queryList->fetch_all(MYSQLI_ASSOC);
    foreach ($rows as $value){

        array_push($list,new Animal ($value['animId'],$value['name'],$value['img'],$value['descr'],$value['website'],$value['hobbies'],$value['ad_date'],$value['zip'],$value['city'],$value['address'],$value['loc_x'],$value['loc_y'],$value['type']) );
    }
        
    //$_SESSION['queryMsg'] = "database call succed";
} else {
    //$_SESSION['list'] = array();
    $_SESSION['queryMsg'] = "We could not find anything, sorry :(";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel ="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"  integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin ="anonymous">
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
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
                    <span class="mx-2"><?php if(isset($_SESSION['user'])){echo 'user: '.$_SESSION['userName'];} ?></span>
                    
                    <?php if (isset($_SESSION['entr']) == 'logout') {
                    	echo '<a class="btn btn-outline-primary" href="login.php?logout">Log Out</a>';
                    } else{
                    	echo '<a class="btn btn-outline-primary" href="login.php">Log In</a>';
                    }?>
                </li>
    		</ul>
    	</nav>

		<div class="row p-3">
    		<h3 class="w-100 text-center text-info"><?php if (isset($_SESSION['queryMsg'])){echo $_SESSION['queryMsg'];} ?></h3>
    		<?php 
            if (count($list)!=0) {                
                echo '<h3 class="w-100 text-center text-info">You can adopt me</h3>';
                foreach ($list as $value) {
                    $res=$value->printCards();
                    echo $res;
                }
            }
            ?>
    	</div>
		
	</div>
</body>
</html>