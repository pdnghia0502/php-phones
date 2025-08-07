<?php 
include_once 'inc/header.php';
include_once 'inc/sidebar.php';
include_once ("../classes/contact.php");
$contact = new Contact();

if (isset($_GET['contactId'])) {
    $id = $_GET['contactId'];
    $get_contact = $contact->get_contact_by_id($id);
}

if ($get_contact) {
    $contact_details = $get_contact->fetch_assoc();
}
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Chi tiết đơn hỗ trợ</h2>
        <div class="block">
            <?php if (isset($contact_details)) { ?>
                <form action="update_contact.php" method="post">
                    <table class="form">
                        <tr>
                            <td><label>ID Đơn hỗ trợ</label></td>
                            <td><input type="text" name="order_Id" value="<?php echo $contact_details['id']; ?>" class="medium" readonly /></td>
                        </tr>
                        <tr>
                            <td><label>ID Khách hàng</label></td>
                            <td><input type="text" name="customer_Id" value="<?php echo $contact_details['customer_Id']; ?>" class="medium" readonly /></td>
                        </tr>
                        <tr>
                            <td><label>Tên khách hàng</label></td>
                            <td><input type="text" name="name" value="<?php echo $contact_details['name']; ?>" class="medium" readonly /></td>
                        </tr>
                        <tr>
                            <td><label>Email</label></td>
                            <td><input type="email" name="email" value="<?php echo $contact_details['email']; ?>" class="medium" readonly /></td>
                        </tr>
                        <tr>
                            <td><label>Số điện thoại</label></td>
                            <td><input type="text" name="phone" value="<?php echo $contact_details['phone']; ?>" class="medium" readonly /></td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Nội dung</label>
                            </td>
                            <td><textarea name="message" class="tinymce" readonly><?php echo $contact_details['message']; ?></textarea></td>
                        </tr>
                        <tr>
                            <td><label>Thời gian gửi</label></td>
                            <td><input type="text" name="created_at" value="<?php echo $contact_details['created_at']; ?>" class="medium" readonly /></td>
                        </tr>
                    </table>
                </form>
            <?php } else { ?>
                <p>Không tìm thấy thông tin chi tiết đơn hỗ trợ.</p>
            <?php } ?>
        </div>
    </div>
</div>

<?php include_once 'inc/footer.php'; ?>
