<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath."/../lib/database.php");
include_once ($filepath."/../helpers/format.php");
?>

<?php
class product
{
	private $db;
	private $fm;

	public function __construct()
	{
		$this -> db = new database();
		$this -> fm = new format();
	}
  public function get_products_by_category_memory_and_series($catId, $memory = '', $series = '')
  {
      $query = "SELECT * FROM tbl_product WHERE catId = ?";
      $params = [$catId];
      $types = "i";

      if ($memory) {
          $query .= " AND productName LIKE ?";
          $params[] = "%$memory%";
          $types .= "s";
      }
      if ($series) {
          $query .= " AND LOWER(productName) LIKE ?";
          $params[] = "%" . strtolower($series) . "%";
          $types .= "s";
      }

      $stmt = $this->db->link->prepare($query);
      if ($stmt === false) {
          echo "SQL Error: " . $this->db->link->error;
          return false;
      }

      $stmt->bind_param($types, ...$params);
      $stmt->execute();
      $result = $stmt->get_result();

      return $result;
  }

  public function extract_memory_from_name($productName)
  {
      if (preg_match('/(\d{2,3})GB/', $productName, $matches)) {
          return $matches[0];
      }
      return '';
  }

  public function getLastestProductByCategory($catId)
  {
      $query = "SELECT * FROM tbl_product WHERE catId = ? ORDER BY productId DESC LIMIT 1";
      $stmt = $this->db->link->prepare($query);
      $stmt->bind_param("i", $catId);
      $stmt->execute();
      $result = $stmt->get_result();
      return $result;
  }
  public function insert_product($data, $files) {
    $productName = mysqli_real_escape_string($this->db->link, $data['productName']);
    $brand = mysqli_real_escape_string($this->db->link, $data['brand']);
    $category = mysqli_real_escape_string($this->db->link, $data['category']);
    $product_desc = mysqli_real_escape_string($this->db->link, $data['product_desc']);
    $price = mysqli_real_escape_string($this->db->link, $data['price']);
    $type = mysqli_real_escape_string($this->db->link, $data['type']);
    $quantity_in_stock = mysqli_real_escape_string($this->db->link, $data['quantity_in_stock']);
    $permited = array('jpg', 'jpeg', 'png', 'gif');
    $file_name = $_FILES['image']['name'];
    $file_size = $_FILES['image']['size'];
    $file_temp = $_FILES['image']['tmp_name'];
    $div = explode('.', $file_name);
    $file_ext = strtolower(end($div));
    $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
    $uploaded_image = "uploads/".$unique_image;

    if ($productName == "" || $brand == "" || $category == "" || $product_desc == "" || $price == "" || $type == "" || empty($file_name)) {
        $alert = "<span class='error'>Các mục không được để trống</span>";
        return $alert;
    } else {
        $check_query = "SELECT * FROM tbl_product WHERE productName = '$productName'";
        $check_result = $this->db->select($check_query);

        if ($check_result) {
            $alert = "<span class='error'>Sản phẩm đã tồn tại</span>";
            return $alert;
        }

        move_uploaded_file($file_temp, $uploaded_image);
        $query = "INSERT INTO tbl_product (productName, brandId, catId, product_desc, price, type, image, quantity_in_stock) 
                VALUES ('$productName', '$brand', '$category', '$product_desc', '$price', '$type', '$unique_image', '$quantity_in_stock')";
        $result = $this->db->insert($query);

        if ($result) {
            $alert = "<span class='success'>Thêm sản phẩm thành công</span>";
            return $alert;
        } else {
            $alert = "<span class='error'>Thêm sản phẩm không thành công</span>";
            return $alert;
        }
    }
  }
	public function update_product($data, $files, $Id, $quantity = 0) { 
    $productName = mysqli_real_escape_string($this->db->link, $data['productName']);
    $brand = mysqli_real_escape_string($this->db->link, $data['brand']);
    $category = mysqli_real_escape_string($this->db->link, $data['category']);
    $product_desc = mysqli_real_escape_string($this->db->link, $data['product_desc']);
    $price = mysqli_real_escape_string($this->db->link, $data['price']);
    $type = mysqli_real_escape_string($this->db->link, $data['type']);
    $quantity_in_stock = mysqli_real_escape_string($this->db->link, $data['quantity_in_stock']);
    $permited = array('jpg', 'jpeg', 'png', 'gif');
    $file_name = $_FILES['image']['name'];
    $file_size = $_FILES['image']['size'];
    $file_temp = $_FILES['image']['tmp_name'];

    $div = explode('.', $file_name);
    $file_ext = strtolower(end($div));
    $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
    $uploaded_image = "uploads/".$unique_image;

    if ($productName == "" || $brand == "" || $category == "" || $product_desc == "" || $price == "" || $type == "") {
        $alert = "<span class='error'>Vui lòng nhập đầy đủ thông tin</span>";
        return $alert;
    } else {
        if (!empty($file_name)) {
            if ($file_size > 100000) {
                $alert = "<span class='success'> Nên chọn ảnh < 2MB</span>";
                return $alert;
            } elseif (in_array($file_ext, $permited) === false) {
                $alert = "<span class='success'>Bạn chỉ có thể tải lên: ".implode(', ', $permited)."</span>";
                return $alert;
            }
            move_uploaded_file($file_temp, $uploaded_image);    
            $query = "UPDATE tbl_product SET 
                      productName = '$productName',
                      brandId = '$brand',
                      catId = '$category',
                      type = '$type',
                      price = '$price',
                      image = '$unique_image',
                      product_desc = '$product_desc',
                      quantity_in_stock = '$quantity_in_stock'
                      WHERE productId = '$Id'";     
            $result = $this->db->update($query);

            if ($result == true) {
                if ($quantity > 0) {
                    $this->update_stock_after_purchase($Id, $quantity);
                }
                $alert = "<span class='success'>Cập nhật sản phẩm thành công</span>";
                return $alert;
            } else {
                $alert = "<span class='error'>Cập nhật sản phẩm không thành công</span>";
                return $alert;
            }
        } else {
            $query = "UPDATE tbl_product SET 
                      productName = '$productName',
                      brandId = '$brand',
                      catId = '$category',
                      type = '$type',
                      price = '$price',
                      product_desc = '$product_desc',
                      quantity_in_stock = '$quantity_in_stock'
                      WHERE productId = '$Id'";     
            $result = $this->db->update($query);

            if ($result == true) {
                if ($quantity > 0) {
                    $this->update_stock_after_purchase($Id, $quantity);
                }
                $alert = "<span class='success'>Cập nhật sản phẩm thành công</span>";
                return $alert;
            } else {
                $alert = "<span class='error'>Cập nhật sản phẩm không thành công</span>";
                return $alert;
            }
        }
    }
  }
	public function show_product() {
    $query = "
      SELECT tbl_product.*, tbl_category.catName, tbl_brand.brandName
      FROM tbl_product 
      INNER JOIN tbl_category ON tbl_product.catId = tbl_category.catId
      INNER JOIN tbl_brand ON tbl_product.brandId = tbl_brand.brandId 
      ORDER BY tbl_product.productId DESC";
    $result = $this->db->select($query);
    return $result;
  }

    public function getproductbyId($Id){
        $query = "SELECT * FROM tbl_product WHERE productId = '$Id'";
    $result = $this->db->select($query);
    return $result;
    }
	public function del_product($Id){
    $query_cart = "DELETE FROM tbl_cart WHERE productId = '$Id'";
    $this->db->delete($query_cart);
    $query = "DELETE FROM tbl_product WHERE productId = '$Id'";
    $result = $this->db->delete($query);

    if($result) {
        $alert = "<span class='success'>Xóa sản phẩm thành công</span>";
        return $alert;
    } else {
        $alert = "<span class='error'>Xóa sản phẩm không thành công</span>";
        return $alert;
    }
  }

  public function getproduct_featured(){
    $query = "SELECT * FROM tbl_product WHERE type ='1' order by productId desc LIMIT 4";
    $result = $this->db->select($query);
    return $result;
  }
  public function getproduct_featured_all(){
    $sp_tungtrang = 12;
    $trang = isset($_GET['trang']) ? $_GET['trang'] : 1;
    $tung_trang = ($trang - 1) * $sp_tungtrang;
    $query = "SELECT * FROM tbl_product WHERE type ='1' ORDER BY productId DESC LIMIT $tung_trang, $sp_tungtrang ";
    $result = $this->db->select($query);
    return $result;
  }
  public function get_productfeatured_count() {
    $query = "SELECT COUNT(*) as count FROM tbl_product WHERE type ='1'";
    $result = $this->db->select($query);
    $row = $result->fetch_assoc();
    return $row['count'];
  }
  public function getproduct_new(){
    $query = "SELECT * FROM tbl_product order by productId desc LIMIT 4";
    $result = $this->db->select($query);
    return $result;
  }
  public function get_product_count() {
    $query = "SELECT COUNT(*) as count FROM tbl_product";
    $result = $this->db->select($query);
    $row = $result->fetch_assoc();
    return $row['count'];
  }
  public function get_all_product(){
    $sp_tungtrang = 12;
    $trang = isset($_GET['trang']) ? $_GET['trang'] : 1;
    $tung_trang = ($trang - 1) * $sp_tungtrang;
    $query = "SELECT * FROM tbl_product ORDER BY productId DESC LIMIT $tung_trang, $sp_tungtrang";
    $result = $this->db->select($query);
    return $result;
  }
  public function get_products_by_category_memory_and_series_with_pagination($catId, $memory, $series, $start_from, $sp_tungtrang)
  {
      $query = "SELECT * FROM tbl_product WHERE catId = '$catId'";
      if (!empty($memory)) {
          $query .= " AND productName LIKE '%$memory%'";
      }
      if (!empty($series)) {
          $query .= " AND productName LIKE '%$series%'";
      }
      $query .= " LIMIT $start_from, $sp_tungtrang";
      return $this->db->select($query);
  }

  public function get_product_count_by_category_memory_and_series($catId, $memory, $series)
  {
      $query = "SELECT COUNT(*) as total FROM tbl_product WHERE catId = '$catId'";
      if (!empty($memory)) {
          $query .= " AND productName LIKE '%$memory%'";
      }
      if (!empty($series)) {
          $query .= " AND productName LIKE '%$series%'";
      }
      $result = $this->db->select($query);
      if ($result) {
          $row = $result->fetch_assoc();
          return $row['total'];
      } else {
          return 0;
      }
  }
  public function get_details($Id){
    $query = "
      SELECT tbl_product.*, tbl_category.catName, tbl_brand.brandName
      FROM tbl_product INNER JOIN tbl_category ON tbl_product.catId = tbl_category.catId
      INNER JOIN tbl_brand ON tbl_product.brandId = tbl_brand.brandId WHERE tbl_product.productId = '$Id'";
    $result = $this->db->select($query);
    return $result;
  }
  public function getLastestiPhone(){
    $query = "SELECT * FROM tbl_product WHERE productId='18' order by productId desc LIMIT 1";
    $result = $this->db->select($query);
    return $result;
  }
  public function getLastestiPad(){
    $query = "SELECT * FROM tbl_product WHERE productId='15' order by productId desc LIMIT 1";
    $result = $this->db->select($query);
    return $result;
  }
  public function getLastestMacBook(){
    $query = "SELECT * FROM tbl_product WHERE productId='5' order by productId desc LIMIT 1";
    $result = $this->db->select($query);
    return $result;
  }
  public function getLastestAirPods(){
    $query = "SELECT * FROM tbl_product WHERE productId='4' order by productId desc LIMIT 1";
    $result = $this->db->select($query);
    return $result;
  }
  public function searchProduct($category = '', $memory = '', $brand = '', $price = '') {
    $query = "
        SELECT tbl_product.*, tbl_category.catName, tbl_brand.brandName 
        FROM tbl_product 
        INNER JOIN tbl_category ON tbl_product.catId = tbl_category.catId
        INNER JOIN tbl_brand ON tbl_product.brandId = tbl_brand.brandId
        WHERE 1";

    $params = [];
    $types = "";

    if (!empty($category)) {
        $query .= " AND tbl_product.productName LIKE ?";
        $params[] = "%$category%";
        $types .= "s";
    }

    if (!empty($memory)) {
        $query .= " AND tbl_product.productName LIKE ?";
        $params[] = "%$memory%";
        $types .= "s";
    }

    if (!empty($brand)) {
        $query .= " AND tbl_product.brandId = ?";
        $params[] = $brand;
        $types .= "i";
    }

    $stmt = $this->db->link->prepare($query);

    if ($stmt === false) {
        echo "SQL Error: " . $this->db->link->error;
        return false;
    }

    if (!empty($params)) {
        $stmt->bind_param($types, ...$params);
    }

    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        return $result;
    } else {
        return false;
    }
  }
  public function update_stock_after_purchase($productId, $quantity) {
  $query = "SELECT quantity_in_stock FROM tbl_product WHERE productId = '$productId'";
  $result = $this->db->select($query);
  if ($result) {
      $row = $result->fetch_assoc();
      $new_quantity = $row['quantity_in_stock'] - $quantity; 
      if ($new_quantity < 0) {
          return false;
      } else {
          $update_query = "UPDATE tbl_product SET quantity_in_stock = '$new_quantity' WHERE productId = '$productId'";
          $this->db->update($update_query);
          return true;
      }
  }
  return false;
  }

}
?>

