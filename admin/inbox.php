<?php
include_once 'inc/header.php';
include_once 'inc/sidebar.php';

$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../classes/cart.php');
include_once($filepath . '/../helpers/format.php');

$ct = new Cart();

if (isset($_GET['confirmid'])) {
    $orderId = $_GET['confirmid'];
    $confirm = $ct->confirm_order($orderId);  
    echo $confirm;
}

if (isset($_GET['confirmReceivedid'])) {
    $orderId = $_GET['confirmReceivedid'];
    $confirmReceived = $ct->confirm_received($orderId);  
    echo $confirmReceived;
}

if (isset($_GET['shiftid'])) {
    $Id = $_GET['shiftid'];
    $shifted = $ct->shifted($Id);
}

if (isset($_GET['deleteid'])) {
    $Id = $_GET['deleteid'];
    $deleted = $ct->delete_order($Id);
}

if (isset($_GET['returnid'])) {
    $orderId = $_GET['returnid'];
    $returnOrder = $ct->return_order($orderId);
    echo $returnOrder;
}

if (isset($_GET['confirmReturnid'])) {
    $orderId = $_GET['confirmReturnid'];
    $confirmReturn = $ct->confirm_return($orderId);
    if ($confirmReturn) {
        echo "<span class='success'>Trạng thái trả hàng đã được cập nhật thành 'Đã trả hàng'.</span>";
    } else {
        echo "<span class='error'>Có lỗi xảy ra khi cập nhật trạng thái trả hàng.</span>";
    }
}
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Quản lý đơn hàng</h2>
        <div class="block">
            <?php
            if (isset($shifted)) {
                echo $shifted;
            }
            if (isset($deleted)) {
                echo $deleted;
            }
            ?>
            <table class="data display datatable" id="example">
                <thead>
                    <tr>
                        <th>Id đơn</th>
                        <th>Ngày đặt hàng</th>
                        <th>Sản phẩm</th>
                        <th>Số lượng</th>
                        <th>Giá</th>
                        <th>ID khách hàng</th>
                        <th>Thông tin</th>
                        <th>Trạng thái</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $ct = new cart ();
                    $fm = new format ();
                    $get_inbox_cart = $ct->get_inbox_cart();
                    if ($get_inbox_cart) {
                        while ($result = $get_inbox_cart->fetch_assoc()) {
                            ?>
                            <tr class="odd gradeX">
                                <td><?php echo $result['Id']; ?></td>
                                <td><?php echo $fm->formatDate($result['date_order']); ?></td>
                                <td><?php echo $result['productName']; ?></td>
                                <td><?php echo $result['quantity']; ?></td>
                                <td><?php echo $result['price'] . ' VNĐ'; ?></td>
                                <td><?php echo $result['customer_Id']; ?></td>
                                <td><a href="customer.php?customerid=<?php echo $result['customer_Id'] ?>">Thông tin khách hàng</a></td>
                                <td>
                                    <?php
                                    if ($result['status'] == 0) {
                                        echo 'Đang xử lý';
                                    } elseif ($result['status'] == 1) {
                                        echo 'Đang vận chuyển';
                                    } elseif ($result['status'] == 2) {
                                        echo 'Đã hủy';
                                    } elseif ($result['status'] == 3) {
                                        echo 'Đã nhận hàng';
                                    } elseif ($result['status'] == 4) {
                                        echo 'Đã xác nhận';
                                    } elseif ($result['status'] == 5) {
                                        echo 'Đang trả hàng';
                                    } elseif ($result['status'] == 6) {
                                        echo 'Đã trả hàng';
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    if ($result['status'] == 0) {
                                        echo '<a href="?confirmid=' . $result['Id'] . '" class="table-action-link">Xác nhận</a>';
                                    } elseif ($result['status'] == 4) {
                                        echo '<a href="?shiftid=' . $result['Id'] . '" class="table-action-link">Vận chuyển</a>';
                                    } elseif ($result['status'] == 1) {
                                        echo '<span class="table-action-disabled">---</span>';
                                    } elseif ($result['status'] == 3) {
                                        echo '<span class="table-action-disabled">---</span>';
                                    } elseif ($result['status'] == 2) {
                                        echo '<a href="?deleteid=' . $result['Id'] . '" class="table-action-link table-action-delete">Xóa</a>';
                                    } elseif ($result['status'] == 5) {
                                        echo '<a href="?confirmReturnid=' . $result['Id'] . '" class="table-action-link">Xác nhận trả hàng</a>';
                                    } else {
                                        echo '---';
                                    }                                    
                                    ?>
                                </td>
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

<?php
include_once 'inc/footer.php';
?>
