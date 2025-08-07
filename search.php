<?php
include_once("inc/header.php");
include_once("inc/search_filter.php");
?>
<div class="main">
    <div class="content">
        <div class="content_top">
            <div class="heading">
                <h3>Tất cả sản phẩm tìm được</h3>
            </div>
            <div class="clear"></div>
        </div>
        <div class="section group">
            <?php
            $keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';
            if (empty($keyword)) {
                echo "<p>Vui lòng nhập từ khóa tìm kiếm.</p>";
            } else {
                $product = new product();
                $results = $product->searchProduct($keyword);
                if ($results && $results->num_rows > 0) {
                    while ($result_all = $results->fetch_assoc()) {
                        ?>
                        <div class="grid_1_of_4 images_1_of_4">
                            <a href="details.php?proId=<?php echo $result_all['productId'] ?>"><img src="admin/uploads/<?php echo $result_all['image'] ?>" alt="" /></a>
                            <h2><?php echo $result_all['productName'] ?></h2>
                            <p><span class="price"><?php echo number_format($result_all['price'], 0, ',', '.') . " VND" ?></span></p>
                            <div class="button"><span><a href="details.php?proId=<?php echo $result_all['productId'] ?>" class="details">Chi tiết</a></span></div>
                        </div>
                        <?php
                    }
                } else {
                    echo "<p>Không tìm thấy sản phẩm với từ khóa '$keyword'.</p>";
                }
            }
            ?>
        </div>
    </div>
</div>

<?php
include_once("inc/footer.php");
?>