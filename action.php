<?php 
session_start();

// **
require_once 'dbconnect.php';
require_once 'classes.php';

// ADD to DataBase
$error = false;

if (isset($_POST['btn-add'])) {
	$name = trim($_POST['name']);
	$wsite = trim($_POST['wsite']);
    $hob = trim($_POST['hob']);
    $aDate = trim($_POST['aDate']);
    $descr = trim($_POST['descr']);
    $type = trim($_POST['type']);

	// basic validation
	if (empty($name)||empty($descr)||empty($type)) {
		$error = true ;
		$_SESSION['actMsgTyp'] = "warning";
		$_SESSION['actMsg'] = "Please fill the form";
	}

	if( !$error ) {
		$sql = "INSERT INTO animals(`name`, `img`, `descr`, `type`, `website`, `hobbies`, `ad_date`) 
		VALUES ('$name','img/default.png','$descr','$type','$wsite','$hob','$aDate')";
		$res = mysqli_query($conn, $sql);
		
		if ($res) {
			$_SESSION['actMsgTyp'] = "success";
			$_SESSION['actMsg'] = "Animal has been added into database";				
			
		} else {
			$_SESSION['actMsgTyp'] = "danger";
			$_SESSION['actMsg'] = "Something went wrong, try again later...";
		}
	}
	header("Location: manager.php");
}

// DELETE item
if (isset($_GET['delete'])) {
	$animId = $_GET['delete'];
	
	$sql = "DELETE FROM animals WHERE animId=".$animId;
	$del = mysqli_query($conn,$sql);
	if ($del) {
		$_SESSION['actMsg'] = "Animal ".$animId." has been deleted";
		$_SESSION['actMsgTyp'] = "success";;
	} else {
		$_SESSION['actMsgTyp'] = "warning";
		$_SESSION['actMsg'] = "Something gone wrong: not deleted";
	}
	header("Location: manager.php");
}
// EDIT item

if (isset($_GET['edit'])) {
	$animId = $_GET['edit'];

	/*$name = trim($_POST['name']);
	$wsite = trim($_POST['wsite']);
    $hob = trim($_POST['hob']);
    $aDate = trim($_POST['aDate']);
    $descr = trim($_POST['descr']);
    $type = trim($_POST['type']);*/

	$editSql = "SELECT * FROM animals
		JOIN location ON animals.loca = location.locId
		WHERE animals.animId=".$animId;
	$editRes = mysqli_query($conn, $editSql);
	if ($editRes) {
		$editRow = $editRes-> fetch_assoc();
		$ID = $animId;
		$name = $editRow['name'];
		$wsite = $editRow['website'];
		$hob = $editRow['hobbies'];
		$aDate = $editRow['ad_date'];
		$descr = $editRow['descr'];
		$type = $editRow['type'];
	}
}
// UPDATE
$error = false ;
if (isset($_POST['btn-upd'])) {
	$ID = trim($_POST['ID']);
	$name = trim($_POST['name']);
	$wsite = trim($_POST['wsite']);
    $hob = trim($_POST['hob']);
    $aDate = trim($_POST['aDate']);
    $descr = trim($_POST['descr']);
    $type = trim($_POST['type']);

	// basic validation
	if (empty($name)||empty($descr)||empty($type)) {
		$error = true ;
		$_SESSION['actMsgTyp'] = "warning";
		$_SESSION['actMsg'] = "Please fill the form";
	}

	if( !$error ) {

		$sql = "UPDATE animals SET name='$name', website='$wsite', hobbies='$hob',ad_date='$aDate',descr='$descr',type='$type' WHERE animId='$ID'";
		$res = mysqli_query($conn, $sql);
		
		if ($res) {
			$_SESSION['actMsgTyp'] = "success";
			$_SESSION['actMsg'] = "Animal has been updated";				
			
		} else {
			$_SESSION['actMsgTyp'] = "danger";
			$_SESSION['actMsg'] = "Something went wrong, try again later...";
		}
	}
	header("Location: manager.php");

	//$sqlAuth = "UPDATE authors SET name='$aName', surname='$aSname' WHERE name='$edAname' AND surname='$edAsname'";
		
}

 ?>