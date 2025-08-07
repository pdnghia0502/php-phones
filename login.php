<?php
include_once ("inc/header.php");
include_once("classes/customer.php");
?>
<?php
    $login_check = Session::get('customer_login');
    if($login_check){
        header('Location:order.php');
    }
?>
<?php
if ($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['submit'])) {
    $insertCustomers = $cs->insert_customers($_POST);   
}
?>
<?php
if ($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['login'])) {
    $login_Customers = $cs->login_customers($_POST);
}
?>
<div class="main">
    <div class="content">
        <div class="login_panel">
            <h3>Đăng nhập</h3>
            <?php
            if (isset($login_Customers)) {
                echo $login_Customers;
            }
            ?>
            <form action="" method="POST">
                <input style="color: black" type="text" name="email" class="field" placeholder="Nhập email tại đây...">
                <input style="color: black" type="password" name="password" class="field" placeholder="Password...">
                <p class="note">Quên mật khẩu <a href="#">tại đây</a></p>
                <div class="buttons">
                    <div><input type="submit" name="login" class="grey" value="Đăng nhập"></div>
                </div>
            </form>
        </div>

        <div class="register_account">
            <h3>Đăng kí tài khoản</h3>
            <?php
            if (isset($insertCustomers)) {
                echo $insertCustomers;
            }
            ?>
            <form action="" method="POST">
                <table>
                    <tbody>
                        <tr>
                            <td>
                                <div>
                                    <input style="color: black" type="text" name="name" placeholder="Nhập tên...">
                                </div>
                                <div>
                                    <input style="color: black" type="text" name="emailguest" placeholder="Nhập email người giới thiệu (nếu có)...">
                                </div>
                                <div>
                                    <input style="color: black" type="text" name="email" placeholder="Nhập Email...">
                                </div>
                            </td>
                            <td>
                                <div>
                                    <input style="color: black" type="text" name="address" placeholder="Nhập địa chỉ...">
                                </div>
                                <div>
                                    <input style="color: black" type="text" name="phone" placeholder="Nhập số điện thoại...">
                                </div>
                                <div>
                                    <input style="color: black" type="text" name="password" placeholder="Nhập mật khẩu...">
                                </div>
                            </td>
                        </tr> 
                    </tbody>
                </table>
                <div class="buttons">
                    <div><input type="submit" name="submit" class="grey" value="Tạo tài khoản"></div>
                </div>
                <p class="terms">Tạo tài khoản đồng nghĩa với việc bạn đã đồng ý với <a href="#">Điều khoản &amp; Điều kiện</a></p>
                <div class="clear"></div>
            </form>
        </div> 
        <div class="clear"></div>
    </div>
</div>
<?php
include_once("inc/footer.php");
?>
