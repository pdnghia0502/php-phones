<?php
include_once("inc/header.php");
include_once("inc/search_filter.php");

$catId = isset($_GET['catId']) ? $_GET['catId'] : '';
$memory = isset($_GET['memory']) ? $_GET['memory'] : '';
$series = isset($_GET['series']) ? $_GET['series'] : '';

$sp_tungtrang = 12;
$current_page = isset($_GET['trang']) ? $_GET['trang'] : 1;
$start_from = ($current_page - 1) * $sp_tungtrang;

$product = new product();
$product_count = $product->get_product_count_by_category_memory_and_series($catId, $memory, $series);
$products = $product->get_products_by_category_memory_and_series_with_pagination($catId, $memory, $series, $start_from, $sp_tungtrang);
?>
<div class="main">
    <div class="content">
        <?php
        $name_cat = $cat->get_name_by_cat($catId);
        if ($name_cat) {
            while ($result_name = $name_cat->fetch_assoc()) {
            ?>
                <div class="content_top">
                    <div class="heading">
                        <h3>Kiểu loại: <?php echo $result_name['catName'] ?></h3>
                    </div>
                    <div class="clear"></div>
                </div>
            <?php
            }
        }
        ?>
        <div class="section group">
            <?php
            if ($products && $products->num_rows > 0) {
                while ($result = $products->fetch_assoc()) {
                    $extractedMemory = $product->extract_memory_from_name($result['productName']);
                    if ($memory && $extractedMemory !== $memory) {
                        continue;
                    }
                    ?>
                    <div class="grid_1_of_4 images_1_of_4">
                        <a href="details.php?proId=<?php echo $result['productId'] ?>"><img src="admin/uploads/<?php echo $result['image'] ?>" alt="" /></a>
                        <h2><?php echo $result['productName'] ?></h2>
                        <p><span class="price"><?php echo number_format($result['price'], 0, ',', '.') . ' VND' ?></span></p>
                        <div class="button"><span><a href="details.php?proId=<?php echo $result['productId'] ?>" class="details">Chi Tiết</a></span></div>
                    </div>
                    <?php
                }
            } else {
                echo 'Loại sản phẩm chưa có hàng';
            }
            ?>
        </div>
        <style>
            .pagination {
                margin-top: 10px;
                text-align: center;
            }
            .pagination a {
                display: inline-block;
                padding: 5px 10px;
                margin: 0 5px;
                background-color: #f2f2f2;
                border: 1px solid #ccc;
                color: #333;
                text-decoration: none;
                border-radius: 3px;
            }
            .pagination a:hover {
                background-color: #ddd;
            }
            .pagination a.active {
                background-color: #007bff;
                color: #fff;
            }
        </style>
        <div class="pagination">
            <?php
            $product_button = ceil($product_count / $sp_tungtrang);
            $query_string = http_build_query([
                'catId' => $catId,
                'memory' => $memory,
                'series' => $series
            ]);
            for ($i = 1; $i <= $product_button; $i++) {
                $active_class = ($i == $current_page) ? 'active' : '';
                echo '<a href="productbycat.php?' . $query_string . '&trang=' . $i . '" class="' . $active_class . '">' . $i . '</a>';
            }
            ?>
        </div>

    </div>
</div>

<?php
include_once("inc/footer.php");
?>
