<?php
include_once 'inc/header.php';
include_once 'inc/sidebar.php';
include_once("../classes/brand.php");
include_once("../classes/category.php");
include_once("../classes/product.php");

$pd = new product();

$insertProduct = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $productName = $_POST['productName'];
    $category = $_POST['category'];
    $brand = $_POST['brand'];
    $product_desc = $_POST['product_desc'];
    $price_input = $_POST['price'];
    $image = $_FILES['image'];
    $type = $_POST['type'];
    $quantity_in_stock = $_POST['quantity_in_stock'];

    if (preg_match('/\D/', str_replace('.', '', $price_input))) {
        $insertProduct = "<span style='color: red;'>Giá không hợp lệ! Vui lòng nhập số</span>";
    } else {
        $price = (float)str_replace('.', '', $price_input);
        $insertProduct = $pd->insert_product([
            'productName' => $productName,
            'category' => $category,
            'brand' => $brand,
            'product_desc' => $product_desc,
            'price' => $price,
            'image' => $image,
            'type' => $type,
            'quantity_in_stock' => $quantity_in_stock
        ], $_FILES);
    }
}
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Thêm sản phẩm</h2>
        <div class="block">    
            <?php if (isset($insertProduct)) { echo $insertProduct; } ?>              
            <form action="productadd.php" method="post" enctype="multipart/form-data">
                <table class="form">
                    <tr>
                        <td><label>Tên SP</label></td>
                        <td><input type="text" name="productName" placeholder="Nhập tên sản phẩm..." class="medium" /></td>
                    </tr>
                    <tr>
                        <td><label>Loại SP</label></td>
                        <td>
                            <select id="select" name="category">
                                <option>-----Chọn loại SP-----</option>
                                <?php
                                $cat = new category();
                                $catlist = $cat->show_category();
                                if ($catlist) {
                                    while ($result = $catlist->fetch_assoc()) {
                                        echo "<option value='{$result['catId']}'>{$result['catName']}</option>";
                                    }
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td><label>Thương hiệu</label></td>
                        <td>
                            <select id="select" name="brand">
                                <option>-----Chọn thương hiệu-----</option>
                                <?php
                                $brand = new brand();
                                $brandlist = $brand->show_brand();
                                if ($brandlist) {
                                    while ($result = $brandlist->fetch_assoc()) {
                                        echo "<option value='{$result['brandId']}'>{$result['brandName']}</option>";
                                    }
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top; padding-top: 9px;"><label>Mô tả SP</label></td>
                        <td><textarea name="product_desc" class="tinymce"></textarea></td>
                    </tr>
                    <tr>
                        <td><label>Giá</label></td>
                        <td><input name="price" type="text" placeholder="Nhập giá..." class="medium" /></td>
                    </tr>
                    <tr>
                        <td><label>Ảnh</label></td>
                        <td><input type="file" name="image" /></td>
                    </tr>
                    <tr>
                        <td><label>Phân loại</label></td>
                        <td>
                            <select id="select" name="type">
                                <option>Chọn phân loại</option>
                                <option value="1">Nổi bật</option>
                                <option value="0">Bình thường</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td><label>Số lượng trong kho</label></td>
                        <td><input name="quantity_in_stock" type="number" placeholder="Nhập số lượng sản phẩm..." class="medium" /></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><input type="submit" name="submit" Value="Thêm" /></td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>

<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>

<?php 
include_once 'inc/footer.php'; 
?>
