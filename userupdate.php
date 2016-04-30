<?php 
$edit = null;
if (isset($_POST['edit']))
	$edit = $_POST['edit'];
if (isset($_POST['delete'])){
	require_once('class.php');
	$obj = new database();
	if ($obj->delete($_POST['delete'])){
		header('Location: index.php');
		die();
	}
	else {
		echo "Error:<br/>";
		foreach ($obj->error as $value) {
			echo $value."<br/>";
		}
	}
	die();
}
?>
<!DOCTYPE html>
<html>
<header></header>
<body>
	<form action='update.php' method='post' name='createUser'>
		Username: <input type='text' name='username' value='<?php echo $edit; ?>'/><br/>
		Password: <input type='text' name='passwd'/><br/>
		<input type='submit' name='submit' value='Create'/><br/>
	</form>
</body>
</html>
<?php
if (isset($_POST['submit'])){
	require_once('class.php');
	$obj = new database();
	if ($obj->update()){
	header('Location: index.php');
	die();
	}
	else {
		echo "Error:<br/>";
		foreach($obj->error as $value){
			echo $value."<br/>";
		}
	}
}
