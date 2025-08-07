<?php
include_once ("inc/header.php");

$login_check = Session::get('customer_login');
if($login_check == false){
    header('Location:login.php');
}

$Id = Session::get('customer_Id');

if (isset($_POST['update_info'])) {
    $update_info = $cs->update_customers($_POST, $Id);
    echo $update_info;
}
$get_customers = $cs->show_customers($Id);
?>

<div class="main">
    <div class="content">
        <div class="section group">
            <div class="content_top">
                <div class="heading">
                    <h3>Thông tin cá nhân</h3>
                </div>
                <div class="clear"></div>
            </div>
            <form action="" method="post">
                <table class="tblone">
                    <?php
                    if ($get_customers) {
                        while ($result = $get_customers->fetch_assoc()) {
                    ?>
                    <tr>
                        <td>Tên</td>
                        <td>:</td>
                        <td><input type="text" name="name" value="<?php echo $result['name']; ?>" /></td>
                    </tr>
                    <tr>
                        <td>Số điện thoại</td>
                        <td>:</td>
                        <td><input type="text" name="phone" value="<?php echo $result['phone']; ?>" /></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>:</td>
                        <td><input type="email" name="email" value="<?php echo $result['email']; ?>" /></td>
                    </tr>
                    <tr>
                        <td>Địa chỉ</td>
                        <td>:</td>
                        <td><input type="text" name="address" value="<?php echo $result['address']; ?>" /></td>
                    </tr>
                    <tr>
                        <td>Đổi mật khẩu</td>
                        <td>:</td>
                        <td><input type="password" name="new_pass" placeholder="Có thể đổi (hoặc không)" /></td>
                    </tr>
                    <tr>
                        <td colspan="3"><input type="submit" name="update_info" value="Cập nhật thông tin" /></td>
                    </tr>
                    <?php
                        }
                    }
                    ?>
                </table>
            </form>
        </div>
    </div>
</div>

<?php
include_once("inc/footer.php");
?>
