<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath."/../lib/database.php");
include_once ($filepath."/../helpers/format.php");  
?>

<?php
class customer
{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new database();
        $this->fm = new format();
    }

    public function insert_customers($data){
        $name = mysqli_real_escape_string($this->db->link, $data['name']);  
        $emailguest = mysqli_real_escape_string($this->db->link, $data['emailguest']);
        $email = mysqli_real_escape_string($this->db->link, $data['email']);
        $address = mysqli_real_escape_string($this->db->link, $data['address']);  
        $phone = mysqli_real_escape_string($this->db->link, $data['phone']);
        $password = mysqli_real_escape_string($this->db->link, md5($data['password']));
        if($name=="" || $email== "" || $address== "" || $phone== "" || $password==""){
            $alert = "<span class='error'>Vui lòng nhập đầy đủ thông tin</span>";
            return $alert;     
        }else{
            $check_email = "SELECT * FROM tbl_customer WHERE email='$email' LIMIT 1 ";
            $result_check = $this->db->select($check_email);
            if($result_check){
                $alert = "<span class='error'>Email đã tồn tại</span>";
                return $alert;
            }else{
                $query = "INSERT INTO tbl_customer (name,emailguest,email,address,phone, password) VALUES('$name','$emailguest','$email','$address','$phone','$password')";
                $result = $this->db->insert($query);  
                if($result==true){
                    $alert="<span class='success'> Tạo mới tài khoản thành công</span>";
                    return $alert;
                }
                else{
                    $alert="<span class='error'> Tạo mới tài khoản không thành công</span>";
                    return $alert;
                }
            }
        }
    }

    public function login_customers($data){
        $email = mysqli_real_escape_string($this->db->link, $data['email']);
        $password = mysqli_real_escape_string($this->db->link, md5($data['password']));
        if($email=="" || $password==""){
            $alert = "<span class='error'>Tài khoản hoặc mật khẩu không đúng!</span>";
            return $alert;
        }else{
            $check_login = "SELECT * FROM tbl_customer WHERE email='$email' AND password = '$password' LIMIT 1 ";
            $result_check = $this->db->select($check_login);
            if($result_check != false){
                $value = $result_check->fetch_assoc();
                Session::set('customer_login', true);
                Session::set('customer_Id', $value['Id']);
                Session::set('customer_name', $value['name']);
                
                $this->restoreCart($value['Id']);
                
                header('Location:index.php');
            }else{
                $alert = "<span class='error'>Email hoặc mật khẩu không tồn tại</span>";
                return $alert;
            }
        }
    }
    

    public function show_customers($Id){
        $query = "SELECT * FROM tbl_customer WHERE Id='$Id'";
        $result = $this->db->select($query);
        return $result;
    }

    public function update_customers($data, $Id){
        $name = mysqli_real_escape_string($this->db->link, $data['name']);
        $email = mysqli_real_escape_string($this->db->link, $data['email']);
        $address = mysqli_real_escape_string($this->db->link, $data['address']);
        $phone = mysqli_real_escape_string($this->db->link, $data['phone']);
        $new_pass = mysqli_real_escape_string($this->db->link, $data['new_pass']);
        if($name=="" || $email== "" || $address== "" || $phone== ""){
            $alert = "<span class='error'>Vui lòng nhập đầy đủ thông tin</span>";
            return $alert;
        }
        if($new_pass != ""){
            $new_pass = md5($new_pass);
            $query = "UPDATE tbl_customer SET name='$name', email='$email', address='$address', phone='$phone', password='$new_pass' WHERE Id = '$Id'";
        } else {
            $query = "UPDATE tbl_customer SET name='$name', email='$email', address='$address', phone='$phone' WHERE Id = '$Id'";
        }
        $result = $this->db->update($query);
        if($result == true){
            $alert = "<span class='success'> Cập nhật thông tin thành công</span>";
            return $alert;
        } else {
            $alert = "<span class='error'> Cập nhật không thành công</span>";
            return $alert;
        }
    }

    public function restoreCart() {
        $customer_Id = Session::get('customer_Id');
        $query = "SELECT * FROM tbl_cart WHERE customer_Id = '$customer_Id'";
        $result = $this->db->select($query);
        
        if ($result) {
            $_SESSION['cart'] = [];
            while ($row = $result->fetch_assoc()) {
                $_SESSION['cart'][$row['productId']] = [
                    'productId' => $row['productId'],
                    'quantity' => $row['quantity'],
                    'image' => $row['image'],
                    'price' => $row['price'],
                    'productName' => $row['productName']
                ];
            }
        }
    }
    public function saveCart($customer_Id) {
        if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
            foreach ($_SESSION['cart'] as $item) {
                
                $query_check = "SELECT * FROM tbl_cart WHERE productId = '{$item['productId']}' AND customer_Id = '$customer_Id'";
                $check_result = $this->db->select($query_check);
        
                if ($check_result && $check_result->num_rows > 0) {
                    $cart_item = $check_result->fetch_assoc();
                    $new_quantity = $cart_item['quantity'] + $item['quantity'];
                    $query_update = "UPDATE tbl_cart SET quantity = '$new_quantity' WHERE cartId = '{$cart_item['cartId']}'";
                    $this->db->update($query_update);
                } else {
                    $query_insert = "INSERT INTO tbl_cart (productId, quantity, customer_Id) VALUES ('{$item['productId']}', '{$item['quantity']}', '$customer_Id')";
                    $this->db->insert($query_insert);
                }
            }
        }
    }
    
    public function logout() {
        if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
            $customer_Id = Session::get('customer_Id');
            foreach ($_SESSION['cart'] as $productId => $item) {
                $quantity = $item['quantity'];
                $image = $item['image'];
                $price = $item['price'];
                $productName = $item['productName'];
    
                $query_insert = "INSERT INTO tbl_cart (productId, quantity, customer_Id, image, price, productName)
                                 VALUES ('$productId', '$quantity', '$customer_Id', '$image', '$price', '$productName')
                                 ON DUPLICATE KEY UPDATE 
                                 quantity = quantity + VALUES(quantity), 
                                 image = VALUES(image), 
                                 price = VALUES(price), 
                                 productName = VALUES(productName)";
                $this->db->insert($query_insert);
            }
            unset($_SESSION['cart']);
        }
        Session::destroy();
    }       
    
}
?>
