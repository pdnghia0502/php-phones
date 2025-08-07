<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath."/../lib/database.php");
include_once ($filepath."/../helpers/format.php");
?>
<?php
class Contact {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function show_contact() {
        $query = "SELECT id, customer_Id, created_at FROM tbl_contact ORDER BY created_at DESC";
        return $this->db->select($query);
    }
    
    public function get_contact_by_id($id) {
        $query = "SELECT * FROM tbl_contact WHERE id = '$id'";
        return $this->db->select($query);
    }    

    public function del_contact($id) {
        $query = "DELETE FROM tbl_contact WHERE id = '$id'";
        $result = $this->db->delete($query);
        if ($result) {
            return "<span class='success'>Xóa đơn hỗ trợ thành công!</span>";
        } else {
            return "<span class='error'>Xóa đơn hỗ trợ thất bại!</span>";
        }
    }
}
?>
