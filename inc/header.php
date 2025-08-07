<?php
include_once ("lib/session.php");
include_once("classes/cart.php");
Session::init();
?>
<?php
include_once ("lib/database.php");
include_once ($filepath."/../helpers/format.php");

spl_autoload_register(function ($className) {
    include_once 'classes/' . $className . '.php';
});

$db = new Database();
$fm = new Format();
$ct = new cart();
$cat = new category();
$cs = new customer();
$product = new product();

if (isset($_GET['customer_Id'])) {
    $customer_Id = Session::get('customer_Id');
    
    if ($customer_Id) {
        $ct->saveCart($customer_Id);
    }
    Session::destroy();
    header("Location: login.php");
    exit();
}

$customer_Id = Session::get('customer_Id');
if ($customer_Id) {
    $ct->restoreCart($customer_Id);
}
if (isset($_SESSION['error_message'])) {
    echo "<span class='error'>" . $_SESSION['error_message'] . "</span>";
    unset($_SESSION['error_message']);
}
?>

<!DOCTYPE HTML>
<head>
<title>Smart Phone Store</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>
<link href="css/menu.css" rel="stylesheet" type="text/css" media="all"/>
<script src="js/jquerymain.js"></script>
<script src="js/script.js" type="text/javascript"></script>
<script type="text/javascript" src="js/jquery-3.6.4.min.js"></script> 
<script type="text/javascript" src="js/nav.js"></script>
<script type="text/javascript" src="js/easing.js"></script> 
<script type="text/javascript" src="js/nav-hover.js"></script>
<link href='http://fonts.googleapis.com/css?family=Monda' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Doppio+One' rel='stylesheet' type='text/css'>
<script type="text/javascript">
  	$(document).ready(function($){
    	$('#dc_mega-menu-orange').dcMegaMenu({rowItems:'3',speed:'fast',effect:'fade'});
  	});
</script>
</head>
<body>
  	<div class="wrap">
		<div class="header_top">
			<div class="logo">
				<a href="index.php"><img style="width: 100px;"src="images/ly-do-moi-san-pham-apple-lam-ra-deu-chay-hang.png" alt="" /></a>
			</div>
			  <div class="header_top_right">
			    <div class="search_box">
				    <form action="search.php" method="GET">
				    	<input type="text" name="keyword" value="" placeholder="Nhập tên sản phẩm">
              			<input type="submit" name="search" value="Tìm kiếm">
				    </form>
			    </div>
			    <div class="shopping_cart">
					<div class="cart">
						<a href="cart.php" title="View my shopping cart" rel="nofollow">
							<span class="cart_title">Giỏ hàng</span>
							<span class="no_product">
                             <?php
								$check_cart = $ct->check_cart();
								if ($check_cart) {
									$sum = Session::get("sum");
									$qty = Session::get("qty");
									echo number_format($sum, 0, ',', '.') . 'đ';
								} else {
									echo '(trống)';
								}
                             ?>
							</span>
						</a>
					</div>
			    </div>
				<?php
				$login_check = Session::get('customer_login');
				if ($login_check == false) {
					echo '<div class="login"><a href="login.php">Đăng nhập</a></div>';
				} else {
					echo '<div class="login"><a href="?customer_Id='.Session::get('customer_Id').'">Đăng xuất</a></div>';
				}
				?>
		   <div class="clear"></div>
	 </div>
	<div class="clear"></div>
</div>
<div class="menu">
	<ul id="dc_mega-menu-orange" class="dc_mm-orange">
	<li>
		<a href="index.php">Trang chủ</a>
	</li>
	<li>
		<a href="products.php">Tất cả sản phẩm</a> 
	</li>
    <?php
    $login_check = Session::get('customer_login');
    if ($login_check == false) {
        echo '';
    } else {
      echo '<li><a href="orderdetails.php">Đơn hàng đã đặt</a> </li>';
      echo '<li><a href="profile.php">Thông tin cá nhân</a> </li>';
    }
    ?>
	<li><a href="contact.php">Hỗ trợ</a></li>
	<div class="clear"></div>
	</ul>
</div>
