<?php 
session_start();
//check if user is admin or not
if($_SESSION['userType']!='admin'){
	header("Location: index.php");
}
// **
require_once 'dbconnect.php';
require_once 'classes.php';
//require_once 'process.php';

// make a list of Data items to work with
$list = array(); //array with list of media

$queryList = mysqli_query($conn,"SELECT * FROM animals
        JOIN location ON animals.loca = location.locId");

if($queryList->num_rows > 0){
    $rows = $queryList->fetch_all(MYSQLI_ASSOC);
    foreach ($rows as $value){

        array_push($list,new Animal ($value['animId'],$value['name'],$value['img'],$value['descr'],$value['website'],$value['hobbies'],$value['ad_date'],$value['zip'],$value['city'],$value['address'],$value['loc_x'],$value['loc_y'],$value['type']) );
    }
    $_SESSION['actMsgTyp'] = "success";
    $_SESSION['actMsg'] = "The list is ready, push the button";
} else {
    $_SESSION['actMsgTyp'] = "danger";
    $_SESSION['actMsg'] = "There is nothing in Database";
}


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
	<div class="container-fluid">
		<nav class="navbar navbar-expand-sm bg-light navbar-light sticky-top border-bottom">
			<h2 class="text-center navbar-brand">Manage Data</h2>
			<ul class="navbar-nav w-100">
				<li class="nav-item mx-auto">
					<p class="alert alert-<?php if (isset($_SESSION['actMsgTyp'])){echo $_SESSION['actMsgTyp']; } ?>">
						
						<?php if (isset($_SESSION['actMsg'])){echo $_SESSION['actMsg']; } ?>
					</p>
				</li>
				<li class="nav-item active ml-auto mr-3">
					<a href="login.php?logout" class="btn btn-primary btn-lg">Quit</a>
				</li>
			</ul>
		</nav>
		<div class="container">
			<div class="row p-3">
				<div class="col p-3">
					<a class="w-100 btn btn-primary" href="#" data-toggle="collapse" data-target="#anims">All animals</a>
				</div>
				<div class="col p-3">
					<a class="w-100 btn btn-primary" href="#" data-toggle="collapse" data-target="#usrs">Users</a>
				</div>
				<div class="col p-3">
					<a class="w-100 btn btn-success" href="#" data-toggle="collapse" data-target="#add">Add</a>
				</div>
			</div>
			<div class="row p-3">
				<div id="anims" class="w-100 collapse">
					<table class="table">
						<thead>
							<tr>
								<th>Name</th>
								<th>website</th>
								<th>hobbies</th>
								<th>adopt date</th>
								<th>type</th>
								<th>Actions</th>
							</tr>
						</thead>					
						<?php foreach ($list as $obj) {
							$res = $obj->printTable();
							echo $res;
						} ?>
						
					</table>
				</div>
			</div>
			<div class="row p-3">
				<div id="usrs" class="collapse">
					
				</div>
			</div>
			<div class="row p-3">
				<div id="add" class="collapse">
					
				</div>
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