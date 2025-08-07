<?php
include_once("inc/header.php");
include_once ("helpers/format.php");

$ct = new Cart();

if (isset($_GET['confirmid'])) {
    $orderId = $_GET['confirmid'];
    $confirm = $ct->confirm_order($orderId);  
    echo $confirm;
    header("Location: orderdetails.php");
}

if (isset($_GET['confirmid'])) {
    $orderId = $_GET['confirmid'];
    $confirmReceived = $ct->confirm_received($orderId);  
    echo $confirmReceived;
}

if (isset($_GET['cancelid'])) {
    $orderId = $_GET['cancelid'];
    $cancel = $ct->cancel_order($orderId);
    if ($cancel) {
        echo "<span class='success'>Đơn hàng đã được hủy.</span>";
    } else {
        echo "<span class='error'>Hủy đơn hàng thất bại.</span>";
    }
}
if (isset($_GET['deleteid']) && $_GET['deleteid']) {
    $orderId = $_GET['deleteid'];
    $deleteOrder = $ct->delete_order($orderId);
    if ($deleteOrder) {
        echo "<span class='success'>Đơn hàng đã được xóa thành công.</span>";
    } else {
        echo "<span class='error'>Có lỗi xảy ra, không thể xóa đơn hàng.</span>";
    }
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
        echo "<span class='success'>Trạng thái đơn hàng đã được cập nhật thành 'Đã trả hàng'.</span>";
    } else {
        echo "<span class='error'>Có lỗi xảy ra khi cập nhật trạng thái trả hàng.</span>";
    }
}
?>
<style>
    .cancel-btn {
        background-color: #ff4d4d !important;
        color: white !important;
        padding: 5px 10px;
        border: none;
        border-radius: 5px;
        text-decoration: none;
    }

    .cancel-btn:hover {
        background-color: #ff1a1a !important;
    }

    .confirm-btn {
        background-color: #4CAF50 !important;
        color: white !important;
        padding: 5px 2px;
        border: none;
        border-radius: 5px;
        text-decoration: none;
    }

    .confirm-btn:hover {
        background-color: #45a049 !important;
    }
    .delete-btn {
        background-color: #808080 !important;
        color: white !important;
        padding: 5px 10px;
        border: none;
        border-radius: 5px;
        text-decoration: none;
    }

    .delete-btn:hover {
        background-color: #595959 !important;
    }
    .return-btn {
        background-color: #ff9900 !important;
        color: white !important;
        padding: 5px 10px;
        border: none;
        border-radius: 5px;
        text-decoration: none;
    }

    .return-btn:hover {
        background-color: #e68a00 !important;
    }
</style>
<div class="main">
    <div class="content">
        <div class="content_top">
            <div class="heading">
                <h3>Chi tiết đơn hàng của bạn</h3>
            </div>
            <div class="clear"></div>
        </div>

        <div class="cartpage">
            <table class="tblone">
                <tr>
                    <th width="5%">ID</th>
                    <th width="15%">Tên sản phẩm</th>
                    <th width="10%">Ảnh</th>
                    <th width="13%">Giá</th>
                    <th width="5%">Số lượng</th>
                    <th width="15%">Ngày đặt hàng</th>
                    <th width="10%">Trạng thái</th>
                    <th width="10%">Xác nhận</th>
                </tr>

                <?php
                $customer_Id = Session::get('customer_Id');
                $query = "SELECT * FROM tbl_order WHERE customer_Id = '$customer_Id' ORDER BY date_order DESC";
                $get_cart_ordered = $ct->get_cart_ordered($customer_Id);

                if ($get_cart_ordered) {
                    while ($result = $get_cart_ordered->fetch_assoc()) {
                        ?>
                        <tr>
                            <td><?php echo $result['Id']; ?></td>
                            <td><?php echo $result['productName']; ?></td>
                            <td><img src="admin/uploads/<?php echo $result['image']; ?>" alt="" /></td>
                            <td><?php echo number_format($result['price'], 0, ',', '.') . ' VNĐ'; ?></td>
                            <td><?php echo $result['quantity']; ?></td>
                            <td><?php echo $fm->formatDate($result['date_order']); ?></td>
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
                                if ($result['status'] == 0 || $result['status'] == 4) {
                                    echo '<a href="?cancelid=' . $result['Id'] . '" class="cancel-btn" onclick="return confirm(\'Bạn có chắc chắn muốn hủy đơn hàng này?\');">Hủy</a>';
                                } elseif ($result['status'] == 1) {
                                    echo '<a href="?confirmid=' . $result['Id'] . '" class="confirm-btn" onclick="return confirm(\'Bạn đã nhận hàng?\');">Đã nhận hàng</a>';
                                } elseif ($result['status'] == 2) {
                                    echo '<a href="?deleteid=' . $result['Id'] . '" class="delete-btn" onclick="return confirm(\'Bạn có chắc chắn muốn xóa đơn hàng này?\');">Xóa</a>';
                                } elseif ($result['status'] == 3) {
                                    echo '<a href="?returnid=' . $result['Id'] . '" class="return-btn" onclick="return confirm(\'Bạn có chắc chắn muốn trả hàng?\');">Trả hàng</a>';
                                } elseif ($result['status'] == 5 || $result['status'] == 6) {
                                    echo '---';
                                }
                                ?>
                            </td>
                        </tr>
                        <?php
                    }
                }
                ?>
            </table>
        </div>
    </div>
</div>

<?php
include_once("inc/footer.php");
?>
