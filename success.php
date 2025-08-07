<?php
include_once("inc/header.php");
?>
<style type="text/css">
    body {
        font-family: 'Roboto', sans-serif;
        background-color: #f0f0f0;
        margin: 0;
        padding: 0;
    }
    .main {
        width: 70%;
        margin: 50px auto;
        padding: 30px;
        background-color: white;
        border-radius: 10px;
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        text-align: center;
    }
    .success_order {
        color: #28a745;
        font-size: 28px;
        margin-bottom: 20px;
        font-weight: bold;
    }
    .success_note {
        background-color: #eaf8e6;
        padding: 15px;
        border-radius: 8px;
        font-size: 18px;
        color: #333;
        margin-bottom: 25px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        max-width: 600px;
        margin: 20px auto;
        line-height: 1.6;
    }
    .success_note a {
        color: #007bff;
        text-decoration: none;
        font-weight: bold;
    }
    .success_note a:hover {
        text-decoration: underline;
    }
    .section p {
        font-size: 18px;
        color: #555;
        margin-top: 10px;
    }
    .footer-link {
        color: #28a745;
        text-decoration: none;
        font-weight: bold;
        font-size: 16px;
    }
    .footer-link:hover {
        text-decoration: underline;
    }
</style>
<form action="" method="post">
    <div class="main">
        <h2 class="success_order">Đặt hàng thành công</h2>
        <p class="success_note">
            Cảm ơn bạn đã đặt hàng tại cửa hàng của chúng tôi, đơn hàng của bạn đã được xác nhận và đang được xử lý. Bạn sẽ nhận được thông báo chi tiết trong thời gian sớm nhất.
        </p>
        <p class="success_note">
            Bạn có thể theo dõi chi tiết đơn hàng của mình <a href="orderdetails.php">Tại đây</a>.
        </p>
        <p class="section">
            Chúng tôi sẽ liên lạc với bạn trong thời gian sớm nhất để hoàn tất thủ tục giao hàng.
        </p>
        <p class="section">
            Nếu bạn cần thêm thông tin, <a href="contact.php" class="footer-link">liên hệ với chúng tôi</a>.
        </p>
    </div>
</form>

<?php
include_once("inc/footer.php");
?>
