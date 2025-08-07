<?php
include_once ("inc/header.php");
?>
<?php
    $login_check = Session::get('customer_login');
    if($login_check == false){
    	header('Location:login.php');
    }
    ?>

<div class="main">
   <div class="content">
    	<div class="section group">
    		<div class="content_top">
    		<div class="heading">
    		<h3>Phương thức thanh toán</h3>
    		</div>
    		<div class="clear"></div>
            <div class="wrapper_method">
               <h3 class="payment">Chọn phương thức thanh toán của bạn</h3>
               <a class="payment_href" href="offlinepayment.php">Tiền Mặt</a>
               <a class="payment_href" href="onlinepayment.php">Chuyển Khoản</a><br><br><br>
               <a style="background: gray;" href="cart.php"> << Quay lại</a>
           </div>
    	</div>
 	</div>
</div>
</div>
<?php
include_once("inc/footer.php");
?>
