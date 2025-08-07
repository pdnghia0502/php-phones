<?php
include_once("inc/header.php");
include_once("classes/cart.php");

$customer_Id = Session::get('customer_Id');
$ct = new cart();
$ct->saveCart($customer_Id);
$get_product_cart = $ct->get_product_cart($customer_Id);

if (!isset($_SESSION['customer_Id'])) {
    header('Location: login.php');
    exit();
}
if (isset($_GET['cartId'])) {
    $cartId = $_GET['cartId'];
    $delcart = $ct->del_product_cart($cartId);

    if ($delcart) {
        $productId = isset($_GET['productId']) ? $_GET['productId'] : null;
        if ($productId && isset($_SESSION['cart'][$productId])) {
            unset($_SESSION['cart'][$productId]);
        }

        if (!$productId) {
            foreach ($_SESSION['cart'] as $id => $item) {
                if ($item['cartId'] == $cartId) {
                    unset($_SESSION['cart'][$id]);
                    break;
                }
            }
        }
        header("Location: cart.php");
        exit();
    }
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $cartId = $_POST['cartId'];
    $quantity = $_POST['quantity'];
    if ($quantity <= 0) {
        echo "<span class='error'>Số lượng phải lớn hơn hoặc bằng 1.</span>";
    } else {
        $update_quantity_cart = $ct->update_quantity_cart($quantity, $cartId);

        if (strpos($update_quantity_cart, 'Không đủ sản phẩm') !== false) {
            echo "<span class='error'>$update_quantity_cart</span>";
        } else {
            $get_product_cart = $ct->get_product_cart($customer_Id);
            $subtotal = 0;
            $qty = 0;
            while ($result = $get_product_cart->fetch_assoc()) {
                $price = (float)str_replace('.', '', $result['price']);
                $quantity = (int)$result['quantity'];
                $total = $price * $quantity;
                $subtotal += $total;
                $qty += $quantity;
            }
            Session::set('sum', $subtotal);
            Session::set('qty', $qty);
            header("Location: cart.php");
            exit();
        }
    }
}
?>
<div class="main">
    <div class="content">
        <div class="content_top">
            <div class="heading">
                <h3>Giỏ hàng của bạn</h3>
            </div>
            <div class="clear"></div>
        </div>
        <div class="section group">
            <table class="tblone">
                <tr>
                    <th width="20%">Tên</th>
                    <th width="10%">Ảnh</th>
                    <th width="15%">Đơn Giá</th>
                    <th width="25%">Số lượng</th>
                    <th width="20%">Tổng giá</th>
                    <th width="10%">Thao tác</th>
                </tr>
                <?php
                $subtotal = 0;
                $qty = 0;
                if ($get_product_cart) {
                    while ($result = $get_product_cart->fetch_assoc()) {
                        $price = str_replace('.', '', $result['price']);
                        $price = (float)$price;
                        $quantity = (int)$result['quantity'];
                        ?>
                        <tr>
                            <td><?php echo $result['productName']; ?></td>
                            <td><img src="admin/uploads/<?php echo $result['image']; ?>" alt="" /></td>
                            <td><?php echo number_format($price, 0, ',', '.'); ?></td>
                            <td>
                                <form action="" method="post">
                                    <input type="hidden" name="cartId" value="<?php echo $result['cartId']; ?>" />
                                    <input type="number" name="quantity" min="0" value="<?php echo $result['quantity']; ?>" />
                                    <input type="submit" name="submit" value="Cập nhật" />
                                </form>
                            </td>
                            <td><?php
                                $total = $price * $quantity;
                                echo number_format($total, 0, ',', '.');
                                ?></td>
                            <td><a onclick="return confirm('Bạn có muốn xóa?');" href="?cartId=<?php echo $result['cartId']; ?>&productId=<?php echo $result['productId']; ?>">Xóa</a></td>
                        </tr>
                        <?php
                        $subtotal += $total;
                        $qty += $quantity;
                    }
                }
                ?>
            </table>
            <?php
            $check_cart = $ct->check_cart($customer_Id);
            if ($check_cart) {
            ?>
                <table style="float:right;text-align:left;" width="40%">
                    <tr>
                        <th>Tổng giá sản phẩm: </th>
                        <td><?php
                            echo number_format($subtotal, 0, ',', '.');
                            Session::set('sum', $subtotal);
                            Session::set('qty', $qty);
                            ?></td>
                    </tr>
                    <tr>
                        <th>VAT : </th>
                        <td>3%</td>
                    </tr>
                    <tr>
                        <th>Tổng giá đơn hàng:</th>
                        <td>
                            <?php
                            $vat = $subtotal * 0.03;
                            $gtotal = $subtotal + $vat;
                            echo number_format($gtotal, 0, ',', '.');
                            ?>
                        </td>
                    </tr>
                </table>
            <?php
            } else {
                echo 'Giỏ hàng của bạn đang trống! Hãy tiếp tục mua hàng';
            }
            ?>
        </div>
        <div class="shopping">
            <div class="shopleft">
                <a href="index.php">
                    <button class="btn-yellow">Tiếp tục mua hàng</button>
                </a>
            </div>
            <div class="shopright">
                <?php
                if ($check_cart) {
                ?>
                    <a href="payment.php">
                        <button class="btn-yellow">Thanh toán</button>
                    </a>
                <?php
                } else {
                }
                ?>
            </div>
        </div>
    </div>
    <div class="clear"></div>
</div>

<?php
include_once("inc/footer.php");
?>
