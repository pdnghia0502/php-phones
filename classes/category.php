<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath."/../lib/database.php");
include_once ($filepath."/../helpers/format.php");
?>

<?php
class category
{
	private $db;
	private $fm;

	public function __construct()
	{
		$this -> db = new database();
		$this -> fm = new format();
	}
	public function insert_category($catName) {
		$catName = $this->fm->validation($catName);
		$catName = mysqli_real_escape_string($this->db->link, $catName);
	
		if (empty($catName)) {
			$alert = "<span class='error'>Loại sản phẩm không được để trống</span>";
			return $alert;
		} else {
			$check_query = "SELECT * FROM tbl_category WHERE catName = '$catName'";
			$check_result = $this->db->select($check_query);
	
			if ($check_result) {
				$alert = "<span class='error'>Loại sản phẩm đã tồn tại</span>";
				return $alert;
			}
	
			$query = "INSERT INTO tbl_category(catName) VALUES('$catName')";
			$result = $this->db->insert($query);
	
			if ($result) {
				$alert = "<span class='success'>Thêm loại sản phẩm thành công</span>";
				return $alert;
			} else {
				$alert = "<span class='error'>Thêm loại sản phẩm không thành công</span>";
				return $alert;
			}
		}
	}	
	public function update_category($catName,$Id){
		$catName = $this -> fm -> validation ($catName);
		$catName = mysqli_real_escape_string($this->db->link, $catName);
		$Id = mysqli_real_escape_string($this->db->link, $Id);
		if(empty($catName)){

        $alert = "<span class='error'>Loại sản phẩm không được để trống</span>";
        return $alert;
       }else{
         $query = "UPDATE tbl_category SET catName = '$catName' WHERE catId = '$Id'";
         $result = $this->db->update($query);
         if($result==true){
         	$alert="<span class='success'>Cập nhật loại sản phẩm thành công</span>";
         	return $alert;
         }
         else{
         	$alert="<span class='error'>Cập nhật loại sản phẩm không thành công</span>";
         	return $alert;
         }
        }
	}
	public function show_category(){
		$query = "SELECT * FROM tbl_category order by catId desc";
        $result = $this->db->select($query);
        return $result;
	}
	public function getcatbyId($Id){
		$query = "SELECT * FROM tbl_category WHERE catId = '$Id'";
        $result = $this->db->select($query);
        return $result;
	}
	public function del_category($Id){
    $query = "DELETE FROM tbl_category WHERE catId = '$Id'";
        $result = $this->db->delete($query);
        if($result){

        		$alert="<span class='success'>Xóa loại sản phẩm thành công</span>";
         	return $alert;
         }
         else{
         	$alert="<span class='error'>Xóa loại sản phẩm không thành công</span>";
         	return $alert;
         }
        }
  public function show_category_fontend(){
		$query = "SELECT * FROM tbl_category order by catId desc";
        $result = $this->db->select($query);
        return $result;
	}
	public function get_product_by_cat($Id){
		$query = "SELECT * FROM tbl_product WHERE catId = '$Id' order by catId desc LIMIT 8";
        $result = $this->db->select($query);
        return $result;
	}
	public function get_name_by_cat($Id){
		$query = "SELECT tbl_product.*, tbl_category.catName, tbl_category.catId FROM tbl_product,tbl_category WHERE tbl_product.catId = tbl_category.catId AND tbl_product.catId = '$Id' LIMIT 1";
        $result = $this->db->select($query);
        return $result;
	}
	}
?>

