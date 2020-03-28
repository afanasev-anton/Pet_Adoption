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
/*$classHide = 'd-none';
$classShow = 'd-block';
if (isset($_GET['edit'])) {
	$mdId = $_GET['edit'];


	$classHide = 'd-block';
	$classShow = 'd-none';

	$editSql = "SELECT media.mdId, media.title, authors.name as aName, authors.surname as aSname, publishers.name as pName, media.type
		FROM media
		LEFT JOIN author_media ON media.mdId = author_media.mdId
		LEFT JOIN authors ON author_media.authId = authors.authId
		LEFT JOIN publishers ON media.publisher = publishers.pubId
		WHERE media.mdId=".$mdId;
	$editRes = mysqli_query($conn, $editSql);
	if ($editRes) {
		$editRow = $editRes-> fetch_assoc();
		$edMdId = $editRow['mdId'];
		$edTitle = $editRow['title'];
		$edAname = $editRow['aName'];
		$edAsname = $editRow['aSname'];
		$edPname = $editRow['pName'];
		$edType = $editRow['type'];

	}

}
// UPDATE
$error = false ;
if (isset($_POST['btn-upd'])) {
	$title = trim($_POST['title']);
	$aName = trim($_POST['aName']);
    $aSname = trim($_POST['aSname']);
    $pName = trim($_POST['pName']);
    $type = trim($_POST['type']);

	// basic validation
	if (empty($title)||empty($aName)||empty($aSname)||empty($pName)||empty($type)) {
		$error = true ;
		$_SESSION['actMsg'] = 'Empty Field, fill it!';
		$_SESSION['actMsgTyp'] = 'danger';		
	}

	if( !$error ) {
		

		$sqlAuth = "UPDATE authors SET name='$aName', surname='$aSname' WHERE name='$edAname' AND surname='$edAsname'";
		$res = mysqli_query($conn, $sqlAuth);
		if ($res) {
			$msgTyp = "success";
			$msg = "Author has been updated";
			$_SESSION['actMsg'] = $msg;
			$_SESSION['actMsgTyp'] = $msgTyp;
			
			unset($aName);
			unset($aSname);
			
			$sqlPubl = "UPDATE publishers SET name='$pName' WHERE name='$edPname'";
			$res = mysqli_query($conn, $sqlPubl);

			if ($res) {

				unset($pName);

				$sqlMedia= "UPDATE media SET title='$title', type='$type' WHERE title=".$edTitle;
				$res = mysqli_query($conn, $sqlMedia);

				if ($res) {
					
					unset($title);
					unset($type);

					$_SESSION['actMsg'] = "Media (".$edTitle.") have been updated";
					$_SESSION['actMsgTyp'] = "success";

					header("Location: manager.php");
				} else {
					$_SESSION['actMsgTyp'] = "danger";
					$_SESSION['actMsg'] = "Something went wrong, try again later...".$edTitle;
				}
			} else {
				$_SESSION['actMsgTyp'] = "danger";
				$_SESSION['actMsg'] = "Something went wrong, try again later... (1)";
			}
		} else {
			$_SESSION['actMsgTyp'] = "danger";
			$_SESSION['actMsg'] = "Something went wrong, try again later... (2)";
		}
	}
}*/

 ?>