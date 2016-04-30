<!DOCTYPE html>
<html>
<header></header>
<body>
	<form action='usercreate.php' method='post' name='createUser'>
		Username: <input type='text' name='username' placeholder='User Name'/></br>
		Password: <input type='text' name='passwd' placeholder='Password'/></br>
		Full Name: <input type='text' name='fullname' placeholder='Full Name'/></br>
		Address: <input type='text' name='addr' placeholder='Address'/></br>
		Phone: <input type='text' name='phone' placeholder='Phone'/></br>
		Email: <input type='text' name='email' placeholder='Email'/></br>
		Group Id: <input type='text' name='groupId' placeholder='Group Id'/></br>
		Group Man Id: <input type='text' name='groupManId' placeholder='Group Manager Id'/></br>
		<input type='submit' name='submit' value='Create'/></br>
	</form>
</body>
</html>
<?php
if (isset($_POST['submit'])){
	require_once('class.php');
	$obj = new User();
	if ($obj->validate() && $obj->insert()){
	header('Location: index.php');
	die();
	}
	else {
		echo "Error:</br>";
			foreach($obj->msg as $value){
		 	echo $value."</br>";
		}
	}
}