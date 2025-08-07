<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath."/../lib/database.php");
include_once ($filepath."/../helpers/format.php");	
?>

<?php
class cart
{  
	private $db;
	private $fm;

	public function __construct()
	{
		$this -> db = new database();
		$this -> fm = new format();
	}
	public function add_to_cart($quantity, $productId) {
        if (!isset($_SESSION['customer_Id'])) {
            header('Location: login.php');
            exit();
        }
        $quantity = $this->fm->validation($quantity);
        $quantity = mysqli_real_escape_string($this->db->link, $quantity);
        $productId = mysqli_real_escape_string($this->db->link, $productId);
        $customer_Id = Session::get('customer_Id');

        $query_product = "SELECT * FROM tbl_product WHERE productId = '$productId'";
        $product_result = $this->db->select($query_product);
    
        if (!$product_result) {
            return "<span class='error'>Sản phẩm không tồn tại.</span>";
        }
    
        $product = $product_result->fetch_assoc();
        if ($product['quantity_in_stock'] <= 0) {
            return "<span class='error'>Sản phẩm đã hết hàng.</span>";
        }
    
        $query_cart = "SELECT * FROM tbl_cart WHERE productId = '$productId' AND customer_Id = '$customer_Id'";
        $check_cart = $this->db->select($query_cart);
    
        if ($check_cart) {
            $cart_item = $check_cart->fetch_assoc();
            $new_quantity = $cart_item['quantity'] + $quantity;
    
            if ($new_quantity > $product['quantity_in_stock']) {
                return "<span class='error'>Không đủ hàng trong kho. Số lượng còn lại: " . $product['quantity_in_stock'] . "</span>";
            }
    
            $query_update = "UPDATE tbl_cart SET quantity = '$new_quantity' WHERE productId = '$productId' AND customer_Id = '$customer_Id'";
            $this->db->update($query_update);
            return "<span class='success'>Cập nhật số lượng sản phẩm trong giỏ hàng thành công.</span>";
        } else {
            if ($quantity > $product['quantity_in_stock']) {
                return "<span class='error'>Không đủ hàng trong kho. Số lượng còn lại: " . $product['quantity_in_stock'] . "</span>";
            }
    
            $query_insert = "INSERT INTO tbl_cart(productId, quantity, customer_Id, image, price, productName) 
                            VALUES('$productId', '$quantity', '$customer_Id', '{$product['image']}', '{$product['price']}', '{$product['productName']}')";
            $insert_cart = $this->db->insert($query_insert);
    
            if ($insert_cart) {
                return "<span class='success'>Sản phẩm đã được thêm vào giỏ hàng.</span>";
            } else {
                return "<span class='error'>Không thể thêm sản phẩm vào giỏ hàng.</span>";
            }
        }
    }
    public function check_product_in_cart($productId) {
        $sId = session_Id('customer_Id');
        $query = "SELECT * FROM tbl_cart WHERE productId = '$productId' AND sId = '$sId'";
        $result = $this->db->select($query);
        return $result->num_rows > 0;
    }
    public function get_product_cart() {
        $customer_Id = Session::get('customer_Id');
        $query = "SELECT * FROM tbl_cart WHERE customer_Id = '$customer_Id'";
        $result = $this->db->select($query);
        return $result;
    }
    public function update_quantity_cart($quantity, $cartId) {
        $quantity = mysqli_real_escape_string($this->db->link, $quantity);
        $cartId = mysqli_real_escape_string($this->db->link, $cartId);
        
        if ($quantity <= 0) {
            return "<span class='error'>Số lượng phải lớn hơn hoặc bằng 1.</span>";
        }
        
        $query_cart = "SELECT * FROM tbl_cart WHERE cartId = '$cartId'";
        $result_cart = $this->db->select($query_cart);
        
        if (!$result_cart) {
            return "<span class='error'>Không tìm thấy sản phẩm trong giỏ hàng.</span>";
        }
    
        $product = $result_cart->fetch_assoc();
        $productId = $product['productId'];
        $current_quantity_in_cart = $product['quantity'];
    
        $query_product = "SELECT productName, quantity_in_stock FROM tbl_product WHERE productId = '$productId'";
        $result_product = $this->db->select($query_product);
        $productDetails = $result_product->fetch_assoc();
        $quantity_in_stock = $productDetails['quantity_in_stock'];
        $productName = $productDetails['productName'];
    
        $quantity_diff = $quantity - $current_quantity_in_cart;
        if ($quantity_diff > $quantity_in_stock) {
            return "<span class='error'>Không đủ sản phẩm trong kho. Số lượng '$productName' còn lại: $quantity_in_stock</span>";
        }
    
        $query_update_cart = "UPDATE tbl_cart SET quantity = '$quantity' WHERE cartId = '$cartId'";
        $result_update_cart = $this->db->update($query_update_cart);
    
        if ($result_update_cart) {
            $new_quantity_in_stock = $quantity_in_stock - $quantity_diff;
            if ($new_quantity_in_stock < 0) {
                return "<span class='error'>Không đủ sản phẩm trong kho. Số lượng '$productName' còn lại: 0</span>";
            }
            $query_update_stock = "UPDATE tbl_product SET quantity_in_stock = '$new_quantity_in_stock' WHERE productId = '$productId'";
            $result_update_stock = $this->db->update($query_update_stock);
    
            if ($result_update_stock) {
                return "<span class='success'>Cập nhật số lượng sản phẩm thành công</span>";
            } else {
                return "<span class='error'>Cập nhật kho không thành công.</span>";
            }
        } else {
            return "<span class='error'>Cập nhật số lượng sản phẩm không thành công.</span>";
        }
    }
    
    

    public function del_product_cart($cartId) {
        $this->update_stock_after_removal($cartId);
        $cartId = mysqli_real_escape_string($this->db->link, $cartId);
        $query = "DELETE FROM tbl_cart WHERE cartId = '$cartId'";
        $result = $this->db->delete($query);
        if ($result) {
            return true; 
        } else {
            $msg = "<span class='error'>Xóa sản phẩm không thành công</span>";
            return false;
        }
    }
    public function check_cart() {
        $customer_Id = Session::get('customer_Id');
        $query = "SELECT * FROM tbl_cart WHERE customer_Id = '$customer_Id'";
        $result = $this->db->select($query);
        if ($result) {
            $total_price = 0;
            $total_qty = 0;
            while ($row = $result->fetch_assoc()) {
                $price = floatval($row['price']);
                $quantity = intval($row['quantity']);
                $total_price += $price * $quantity;
                $total_qty += $quantity;
            }
            Session::set("sum", $total_price);
            Session::set("qty", $total_qty);
            return $result;
        }
        return false;
    }

    public function del_all_data_cart() {
        $customer_Id = Session::get('customer_Id');
        $query = "DELETE FROM tbl_cart WHERE customer_Id = '$customer_Id'";
        $result = $this->db->delete($query);
        if ($result) {
            unset($_SESSION['cart']);
        }
        return $result;
    }
    
    public function insertOrder($customer_Id) {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $customer_Id = mysqli_real_escape_string($this->db->link, $customer_Id);
        $query = "SELECT * FROM tbl_cart WHERE customer_Id = '$customer_Id'";
        $get_product = $this->db->select($query);
    
        if ($get_product) {
            while ($result = $get_product->fetch_assoc()) {
                $productId = $result['productId'];
                $productName = $result['productName'];
                $quantity = $result['quantity'];
                $price = $result['price'] * $quantity;
                $image = $result['image'];
                $date_order = date("Y-m-d H:i:s");
    
                $query_order = "INSERT INTO tbl_order(productId, productName, quantity, price, image, customer_Id, status, date_order) 
                                VALUES('$productId', '$productName', '$quantity', '$price', '$image', '$customer_Id', '0', '$date_order')";
    
                $insert_order = $this->db->insert($query_order);
    
                if (!$insert_order) {
                    echo "<span class='error'>Không thể thêm sản phẩm $productName vào đơn hàng!</span>";
                }
            }
    
            $query_delete_cart = "DELETE FROM tbl_cart WHERE customer_Id = '$customer_Id'";
            $this->db->delete($query_delete_cart);
    
            return "<span class='success'>Đặt hàng thành công!</span>";
        } else {
            return "<span class='error'>Giỏ hàng của bạn không có sản phẩm.</span>";
        }
    }
    public function getAmountPrice($customer_Id){
        $query = "SELECT price FROM tbl_order WHERE customer_Id = '$customer_Id'";
        $get_price = $this -> db ->select($query);
        return $get_price;
    }
    public function get_cart_ordered($customer_Id) {
        $query = "SELECT * FROM tbl_order WHERE customer_Id = '$customer_Id' ORDER BY date_order DESC";
        $result = $this->db->select($query);
        return $result;
    }
    public function get_inbox_cart(){
        $query = "SELECT * FROM tbl_order ORDER BY date_order";
        $get_inbox_cart = $this -> db ->select($query);
        return $get_inbox_cart;
    }
    public function shifted($Id){
        $Id = mysqli_real_escape_string($this->db->link, $Id);
        $query = "UPDATE tbl_order SET status = '1' WHERE Id= '$Id'";
        $result = $this -> db ->update($query);
            if($result){
                $msg = "<span class='success'>Cập nhật đơn hàng thành công</span>";
                return $msg;
            }else{
                $msg = "<span class='error'>Cập nhật đơn hàng không thành công</span>";
            return $msg;
            }
    }
    public function shifted_confirm($Id){
            $Id = mysqli_real_escape_string($this->db->link, $Id);
            $query = "UPDATE tbl_order SET status = '2' WHERE Id = '$Id'";
            $result = $this->db->update($query);
            if ($result) {
                return "<span class='success'>Xác nhận vận chuyển thành công.</span>";
            } else {
                return "<span class='error'>Xác nhận vận chuyển thất bại.</span>";
            }
    }
    public function confirm_received($orderId) {
        $query = "UPDATE tbl_order SET status = '3' WHERE Id = '$orderId' AND status != '3'";
        $result = $this->db->update($query);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
    
    public function confirm_order($orderId) {
        $query = "UPDATE tbl_order SET status = '4' WHERE Id = '$orderId' AND status = '0'";
        $result = $this->db->update($query);
        if ($result) {
            return "<span class='success'>Đơn hàng đã được xác nhận.</span>";
        } else {
            return "<span class='error'>Xác nhận đơn hàng thất bại.</span>";
        }
    }
    public function return_order($orderId) {
        $orderId = mysqli_real_escape_string($this->db->link, $orderId);
        $query = "UPDATE tbl_order SET status = '5' WHERE Id = '$orderId'";
        $result = $this->db->update($query);
    
        if ($result) {
            return "<span class='success'>Đơn hàng đã được cập nhật trạng thái trả hàng.</span>";
        } else {
            return "<span class='error'>Có lỗi xảy ra khi cập nhật trạng thái trả hàng.</span>";
        }
    }    
    public function confirm_return($orderId) {
        $query = "UPDATE tbl_order SET status = '6' WHERE Id = '$orderId'";
        $result = $this->db->update($query);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
    public function update_stock_after_removal($cartId) {
        $query = "SELECT productId, quantity FROM tbl_cart WHERE cartId = '$cartId'";
        $result = $this->db->select($query);
        if ($result) {
            $row = $result->fetch_assoc();
            $productId = $row['productId'];
            $quantity = $row['quantity'];
            $update_query = "UPDATE tbl_product SET quantity_in_stock = quantity_in_stock + '$quantity' WHERE productId = '$productId'";
            $this->db->update($update_query);
        }
    }
    public function delete_order($orderId) {
        $orderId = mysqli_real_escape_string($this->db->link, $orderId);
        $query = "DELETE FROM tbl_order WHERE Id = '$orderId'";
        $result = $this->db->delete($query);
        if ($result) {
            return "<span class='success'>Đơn hàng đã được xóa thành công.</span>";
        } else {
            return "<span class='error'>Xóa đơn hàng không thành công.</span>";
        }
    }
    public function cancel_order($orderId) {
        $orderId = mysqli_real_escape_string($this->db->link, $orderId);
        $query_order = "SELECT productId, quantity, status FROM tbl_order WHERE Id = '$orderId'";
        $result_order = $this->db->select($query_order);
        
        if ($result_order) {
            $row = $result_order->fetch_assoc();
            $status = $row['status']; 
            $productId = $row['productId'];
            $quantity = $row['quantity'];
            if ($status == 0 || $status == 4) {
                $query_update_order = "UPDATE tbl_order SET status = '2' WHERE Id = '$orderId' AND status = '$status'";
                $result_update_order = $this->db->update($query_update_order);
    
                if ($result_update_order) {
                    $query_update_stock = "UPDATE tbl_product SET quantity_in_stock = quantity_in_stock + $quantity WHERE productId = '$productId'";
                    $this->db->update($query_update_stock);
    
                    return "<span class='success'>Hủy đơn hàng và cập nhật kho thành công.</span>";
                } else {
                    return "<span class='error'>Hủy đơn hàng thất bại.</span>";
                }
            } else {
                return "<span class='error'>Không thể hủy đơn hàng vì đơn hàng đã được xử lý hoặc không trong trạng thái có thể hủy.</span>";
            }
        } else {
            return "<span class='error'>Không tìm thấy đơn hàng để hủy.</span>";
        }
    }
    public function saveCart($customer_Id) {
        if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
            foreach ($_SESSION['cart'] as $productId => $quantity) {
                $query = "SELECT productId FROM tbl_product WHERE productId = '$productId'";
                $result = $this->db->select($query);
                if ($result) {
                    $query_check = "SELECT * FROM tbl_cart WHERE customer_Id = '$customer_Id' AND productId = '$productId'";
                    $check_result = $this->db->select($query_check);
                    if ($check_result) {
                        $update_query = "UPDATE tbl_cart SET quantity = '$quantity' WHERE customer_Id = '$customer_Id' AND productId = '$productId'";
                        $this->db->update($update_query);
                    } else {
                        $insert_query = "INSERT INTO tbl_cart (customer_Id, productId, quantity) VALUES ('$customer_Id', '$productId', '$quantity')";
                        $this->db->insert($insert_query);
                    }
                } else {
                    echo "Sản phẩm với ID $productId không tồn tại trong hệ thống!";
                }
            }
        } else {
            echo "";
        }
    }
    public function restoreCart($customer_Id) {
        if (!$customer_Id) {
            return;
        }
        $query = "SELECT * FROM tbl_cart WHERE customer_Id = '$customer_Id'";
        $result = $this->db->select($query);
        if ($result) {
            $_SESSION['cart'] = array();
    
            while ($row = $result->fetch_assoc()) {
                $productId = $row['productId'];
                $quantity = $row['quantity'];
    
                if ($productId && $quantity) {
                    $_SESSION['cart'][$productId] = $quantity;
                } else {
                    echo "Lỗi: Dữ liệu không hợp lệ cho sản phẩm ID: $productId";
                }
            }
        } else {
            
        }
    }
}
?>

