<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath."/../lib/session.php");
Session::checkLogin();
include_once ($filepath."/../lib/database.php");
include_once ($filepath."/../helpers/format.php");
?>

<style>
	.success {
  		color: green;
  		font-weight: bold;
	}

	.error {
  		color: red;
  		font-weight: bold;
	}
</style>

<?php
class adminlogin 
{
	private $db;
	private $fm;

	public function __construct()
	{
		$this -> db = new database();
		$this -> fm = new format();
	}
	public function login_admin($adminUser, $adminPass)
	{
		$adminUser = $this -> fm -> validation ($adminUser);
		$adminPass = $this -> fm -> validation ($adminPass);

		$adminUser = mysqli_real_escape_string($this->db->link, $adminUser);
		$adminPass = mysqli_real_escape_string($this->db->link, $adminPass); 

		if (empty($adminUser) || empty($adminPass)) {
	        $alert = "<div class='error'>Tài khoản hoặc mật khẩu không được để trống</div>";
	        return $alert;
	    } else {
	        $query = "SELECT * FROM tbl_admin WHERE adminUser = '$adminUser' AND adminPass = '$adminPass' LIMIT 1";
	        $result = $this->db->select($query);

	        if ($result != false) {
	        	$value = $result -> fetch_assoc();
	        	Session::set ('adminlogin', true);
	        	Session::set ('adminId', $value["adminId"]);
	        	Session::set ('adminUser', $value["adminUser"]);
	        	Session::set ('adminName', $value["adminName"]);
	        	header('Location:index.php');
	        } else {
	        	$alert = "<div class='error'>Tài khoản hoặc mật khẩu không tồn tại</div>";
	            return $alert;
	        }
	    }
	}
	public function register_admin($adminName, $adminEmail, $adminUser, $adminPass)
	{
		$adminName = $this->fm->validation($adminName);
		$adminEmail = $this->fm->validation($adminEmail);
    	$adminUser = $this->fm->validation($adminUser);
    	$adminPass = $this->fm->validation($adminPass);

		$adminName = mysqli_real_escape_string($this->db->link, $adminName);
		$adminEmail = mysqli_real_escape_string($this->db->link, $adminEmail);
    	$adminUser = mysqli_real_escape_string($this->db->link, $adminUser);
    	$adminPass = mysqli_real_escape_string($this->db->link, $adminPass);

    	if (empty($adminName) || empty($adminEmail) || empty($adminUser) || empty($adminPass)) {
        	$alert = "Vui lòng điền đầy đủ thông tin";
        	return $alert;
    	} else {
	        $query = "SELECT * FROM tbl_admin WHERE adminUser = '$adminUser' LIMIT 1";
	        $result = $this->db->select($query);

	        if ($result) {
	            $alert = "<div class='error'>Tên đăng nhập đã tồn tại</div>";
	            return $alert;
	        } else {
	            $hashedPass = md5($adminPass);
	            $insertQuery = "INSERT INTO tbl_admin (adminName, adminEmail, adminUser, adminPass) VALUES ('$adminName', '$adminEmail', '$adminUser', '$hashedPass')";
	            $insertRow = $this->db->insert($insertQuery);

	            if ($insertRow) {
	                $alert = "<div class='success'>Đăng ký thành công</div>";
	                return $alert;
	            } else {
	                $alert = "<div class='error'>Đăng ký thất bại</div>";
	                return $alert;
	            }
	        }
	    }
	}
}
?>
