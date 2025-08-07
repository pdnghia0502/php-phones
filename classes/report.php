<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . "/../lib/database.php");
include_once($filepath . "/../helpers/format.php");

class Report {
    private $db;

    public function __construct() {
        $this->db = new database();
    }

    public function getSalesReport($year, $month = '', $category = '') {
        $query = "
            SELECT 
                p.productName, 
                c.catName AS category, 
                SUM(o.quantity) AS quantity, 
                SUM(o.price) AS price 
            FROM tbl_order AS o
            INNER JOIN tbl_product AS p ON o.productId = p.productId
            INNER JOIN tbl_category AS c ON p.catId = c.catId
            WHERE YEAR(o.date_order) = ? 
              AND o.status = 3 -- Chỉ thống kê sản phẩm đã nhận hàng
        ";
        $params = [$year];
        $types = "i";
    
        if (!empty($month)) {
            $query .= " AND MONTH(o.date_order) = ?";
            $params[] = $month;
            $types .= "i";
        }
    
        if (!empty($category)) {
            $query .= " AND c.catId = ?";
            $params[] = $category;
            $types .= "i";
        }
    
        $query .= " GROUP BY p.productId, c.catId";
    
        $stmt = $this->db->link->prepare($query);
        if ($stmt === false) {
            echo "SQL Error: " . $this->db->link->error;
            return false;
        }
    
        $stmt->bind_param($types, ...$params);
        $stmt->execute();
    
        $result = $stmt->get_result();
        if ($result === false) {
            echo "Query Error: " . $stmt->error;
            return false;
        }
    
        $data = $result->fetch_all(MYSQLI_ASSOC);
    
        return $data;
    }      
}
?>
