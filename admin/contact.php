<?php
include_once 'inc/header.php';
include_once 'inc/sidebar.php';
include_once ("../classes/contact.php");

$contact = new Contact();

if (isset($_GET['delId'])) {
    $Id = $_GET['delId'];
    $delContact = $contact->del_contact($Id);
}
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Danh sách đơn hỗ trợ</h2>
        <div class="block">
        <?php
        if (isset($delContact)){
            echo $delContact;
        }
        ?>        
            <table class="data display datatable" id="example">
                <thead>
                    <tr>
                        <th>ID Khách hàng</th>
                        <th>Thời gian gửi</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $show_contact = $contact->show_contact();
                    if ($show_contact) {
                        while ($result = $show_contact->fetch_assoc()) {
                    ?>
                    <tr class="odd gradeX">
                        <td><?php echo $result['customer_Id'] ?></td>
                        <td><?php echo $result['created_at'] ?></td>
                        <td><a href="contactdetails.php?contactId=<?php echo $result['id']?>">Chi tiết</a> || 
                            <a onclick="return confirm('Bạn có thực sự muốn xóa?')" href="?delId=<?php echo $result['id']?>">Xóa</a></td>
                    </tr>
                    <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();
        $('.datatable').dataTable();
        setSidebarHeight();
    });
</script>

<?php include_once 'inc/footer.php'; ?>
