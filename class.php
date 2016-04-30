<?php
class database {
	private
	$servername = '192.168.56.101',
	$username = 'root',
	$passwd = '123456',
	$dbname = 'gps';
	

	public
	$conn, $columnName, $table, $msg = array();

	function __construct(){
		$this->connect();
	}

	private function connect(){
		$this->conn = new PDO("mysql:host=$this->servername;dbname=$this->dbname",$this->username,$this->passwd);
	}

	// reuturn $table, $columnName[], rowCount.
	function view(){
		$sql = 'select * from GpsUser';
		$select = $this->conn->prepare($sql);
		if ($select->execute()){
			for($i = 0; $i < $select->columnCount(); $i++){
				$this->columnName[$i] = $select->getColumnMeta($i)['name'];		
			}
			$this->table = $select->fetchAll(PDO::FETCH_ASSOC);
		}
		else
			$this->msg = $select->errorInfo();
		return $select->rowCount();
	}

	function insert(){
		
	}

	function update(){
		$sql = 'update GpsUser set username=:username, password=:passwd where id=:id';
		$update = $this->conn->prepare($sql);
		$update->bindParam(':username', $_POST['username'], PDO::PARAM_STR);
		$update->bindParam(':passwd', $_POST['passwd'], PDO::PARAM_STR);
		if ($update->execute())
			$return = true;
		$this->msg = $update->errorInfo();
		return $return;
	}

	function delete($id = null){
		$sql = 'delete from GpsUser where id=:id';
		$delete = $this->conn->prepare($sql);
		$delete->bindParam(':id', $id, PDO::PARAM_STR);
		if ($delete->execute())
			$return = true;
		$this->msg = $delete->errorInfo();
		return $return;
	}
}

class User extends database {
	public $id, $username, $passwd, $fullname, $addr, $phone, $email, $groupId, $groupManId;
	
	public function __construct(){
		parent::__construct();
		if (isset($_POST)){
			$this->username = $_POST['username'];
			$this->passwd = $_POST['passwd'];
			$this->fullname = $_POST['fullname'];
			$this->addr = $_POST['addr'];
			$this->phone = $_POST['phone'];
			$this->email = $_POST['email'];
			$this->groupId = $_POST['groupId'];
			$this->groupManId = $_POST['groupManId'];
		}
	}

	function checkExist($field,$data){
		$sql = 'select id from GpsUser where :field = :data';
		$checker = $this->conn->prepare($sql);
		$checker->bindParam(':field', $fiels, PDO::PARAM_STR);
		$checker->bindParam(':data', $data, PDO::PARAM_STR);
		if ($checker->execute())
			return true;

	}

	function validate(){
		$return = true;
		if (strlen($this->username)<6){
			$checkMsg[] = 'User Name must more than 6 characters!';
			$return = false;
		}
		elseif ($this->checkExist('username',$this->username)){
			$checkMsg[] = 'User Name already exists!';
			$return = false;
		}
		if (strlen($this->passwd)<6){
			$checkMsg[] = 'Password must more than 6 characters!';
			$return = false;
		}
		if (strlen($this->email)==0){
			$checkMsg[] = 'Email is required!';
			$return = false;
		}
		if ($this->checkExist('email',$this->email)){
			$checkMsg[] = 'Email already exist!';
			$return = false;
		}
		if (!is_numeric($this->groupId)){
			$checkMsg[] = 'Group Id must be number!';
			$return = false;
		}
		if (!is_numeric($this->groupManId)){
			$checkMsg[] = 'Group Manager Id must be number!';
			$return = false;
		}
		if (!$return)
			$this->msg = array_merge($this->msg,$checkMsg);
		return $return;
	}

	function insert(){
			$sql = 'insert into GpsUser (username, password, fullname, address, phone, email, group_id, groupman_id) values (:username, :passwd, :fullname, :addr, :phone, :email, :groupId, :groupManId)';
			$insert = $this->conn->prepare($sql);
			$insert->bindParam(':username', $this->username, PDO::PARAM_STR);
			$insert->bindParam(':passwd', $this->passwd, PDO::PARAM_STR);
			$insert->bindParam(':fullname', $this->fullname, PDO::PARAM_STR);
			$insert->bindParam(':addr', $this->addr, PDO::PARAM_STR);
			$insert->bindParam(':phone', $this->phone, PDO::PARAM_STR);
			$insert->bindParam(':email', $this->email, PDO::PARAM_STR);
			$insert->bindParam(':groupId', $this->groupId, PDO::PARAM_STR);
			$insert->bindParam(':groupManId', $this->groupManId, PDO::PARAM_STR);
			if ($insert->execute())
				return true;
			$this->msg = array_merge($this->msg,$insert->errorInfo());
	}

	function update(){
		$sql = 'update GpsUser set username=:username, password=:passwd, fullname=:fullname, address=:addr, phone=:phone, email=:email, group_id=:groupId, groupman_id=:groupManId where id=:id');
		
	}
}
?>
