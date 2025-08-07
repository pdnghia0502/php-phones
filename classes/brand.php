<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath."/../lib/database.php");
include_once ($filepath."/../helpers/format.php");
?>
<?php
class brand
{
	private $db;
	private $fm;

	public function __construct()
	{
		$this -> db = new database();
		$this -> fm = new format();
	}
	public function insert_brand($brandName) {
		$brandName = $this->fm->validation($brandName);
		$brandName = mysqli_real_escape_string($this->db->link, $brandName);
	
		if (empty($brandName)) {
			$alert = "<span class='error'>Thương hiệu không được để trống</span>";
			return $alert;
		} else {
			$check_query = "SELECT * FROM tbl_brand WHERE brandName = '$brandName'";
			$check_result = $this->db->select($check_query);
	
			if ($check_result) {
				$alert = "<span class='error'>Thương hiệu đã tồn tại</span>";
				return $alert;
			}
	
			$query = "INSERT INTO tbl_brand(brandName) VALUES('$brandName')";
			$result = $this->db->insert($query);
	
			if ($result) {
				$alert = "<span class='success'>Thêm thương hiệu thành công</span>";
				return $alert;
			} else {
				$alert = "<span class='error'>Thêm thương hiệu không thành công</span>";
				return $alert;
			}
		}
	}	
	public function update_brand($brandName,$Id){
		$brandName = $this -> fm -> validation ($brandName);
		$brandName = mysqli_real_escape_string($this->db->link, $brandName);
		$Id = mysqli_real_escape_string($this->db->link, $Id);
		if(empty($brandName)){

        $alert = "<span class='error'>Thương hiệu không được để trống</span>";
        return $alert;
       }else{
         $query = "UPDATE tbl_brand SET brandName = '$brandName' WHERE brandId = '$Id'";
         $result = $this->db->update($query);
         if($result==true){
         	$alert="<span class='success'>Cập nhật thương hiệu thành công</span>";
         	return $alert;
         }
         else{
         	$alert="<span class='error'>Cập nhật thương hiệu không thành công</span>";
         	return $alert;
         }
        }
	}
	public function show_brand(){
		$query = "SELECT * FROM tbl_brand order by brandId desc";
        $result = $this->db->select($query);
        return $result;
	}
	public function getbrandbyId($Id){
		$query = "SELECT * FROM tbl_brand WHERE brandId = '$Id'";
        $result = $this->db->select($query);
        return $result;
	}
	public function del_brand($Id){
$query = "DELETE FROM tbl_brand WHERE brandId = '$Id'";
        $result = $this->db->delete($query);
        if($result){

        		$alert="<span class='success'>Xóa thương hiệu thành công</span>";
         	return $alert;
         }
         else{
         	$alert="<span class='error'>Xóa thương hiệu không thành công</span>";
         	return $alert;
         }
        }
	}
?>


