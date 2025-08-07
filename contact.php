<?php
include_once("inc/header.php");
include_once("lib/database.php");
include_once("helpers/format.php");
include_once("lib/session.php");

Session::init(); // Khởi tạo session

// Kiểm tra xem người dùng đã đăng nhập chưa
if (!isset($_SESSION['customer_Id'])) {
    header('Location: login.php'); // Chuyển hướng đến trang đăng nhập nếu chưa đăng nhập
    exit(); // Dừng thực thi tiếp theo
}

$db = new Database();
$fm = new Format();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $name = $fm->validation($_POST['name']);
    $email = $fm->validation($_POST['email']);
    $phone = $fm->validation($_POST['phone']);
    $message = $fm->validation($_POST['message']);
    $customer_id = $_SESSION['customer_Id']; // Lấy customer_Id từ session

    if (empty($name) || empty($email) || empty($phone) || empty($message)) {
        echo "<span class='error'>Vui lòng điền đầy đủ thông tin!</span>";
    } else {
        $query = "INSERT INTO tbl_contact (customer_Id, name, email, phone, message, created_at) 
                  VALUES ('$customer_id', '$name', '$email', '$phone', '$message', NOW())";
        $result = $db->insert($query);
        if ($result) {
            echo "<span class='success'>Cảm ơn bạn đã liên hệ! Chúng tôi sẽ trả lời bạn sớm.</span>";
        } else {
            echo "Có lỗi xảy ra, vui lòng thử lại!";
        }
    }
}
?>

<div class="main">
    <div class="content">
        <div class="support">
            <div class="support_desc">
                <h3>Hỗ trợ trực tuyến</h3>
                <p><span> 24 giờ / 7 ngày&nbsp;&nbsp</span></p>
                <p> ...</p>
            </div>
            <img src="web/images/contact.png" alt="" />
            <div class="clear"></div>
        </div>
        <div class="section group">
            <div class="col span_2_of_3">
                <div class="contact-form">
                    <h2>Liên hệ chúng tôi</h2>
                    <form action="contact.php" method="POST">
                        <div>
                            <span><label>Tên</label></span>
                            <span><input type="text" name="name" value=""></span>
                        </div>
                        <div>
                            <span><label>E-MAIL</label></span>
                            <span><input type="text" name="email" value=""></span>
                        </div>
                        <div>
                            <span><label>Số điện thoại</label></span>
                            <span><input type="text" name="phone" value=""></span>
                        </div>
                        <div>
                            <span><label>Nội dung</label></span>
                            <span><textarea name="message"></textarea></span>
                        </div>
                        <div>
                            <span><input type="submit" value="SUBMIT"></span>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col span_1_of_3">
                <div class="company_address">
                    <h2>Thông tin công ty :</h2>
                    <p>55 Đường Giải Phóng</p>
                    <p>Tòa nhà A1</p>
                    <p>Hà Nội</p>
                    <p>Phone:123456789</p>
                    <p>Fax: 000 00 00 0</p>
                    <p>Email: <span>@huce.edu.com</span></p>
                    <p>Theo dõi: <span>Facebook</span>, <span>Youtube</span></p>
                </div>
            </div>
        </div>      
    </div>
</div>

<?php
include_once("inc/footer.php");
?>
