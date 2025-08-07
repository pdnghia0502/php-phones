<?php
include_once ("inc/header.php");
include_once ("inc/search_filter.php");
include_once ("inc/slider.php");
?>
<div class="main">
    <div class="content">
    	<div class="content_top">
		<div class="heading">
    		<h3>Sản phẩm nổi bật</h3>
		</div>
    	<div class="clear"></div>
    	</div>
	      	<div class="section group">
	      	<?php
             	$product_featured = $product->getproduct_featured();
             	if($product_featured){
               	while($result = $product_featured->fetch_assoc()){
	      		?>
				<div class="grid_1_of_4 images_1_of_4">
					<a href="details.php?proId=<?php echo $result['productId'] ?>"><img src="admin/uploads/<?php echo $result['image'] ?>" alt="" /></a>
					<h2><?php echo $result['productName'] ?></h2>
					<p><span class="price"><?php echo number_format($result['price'], 0, ',', '.') . " VND"; ?></span></p>
					<div class="button"><span><a href="details.php?proId=<?php echo $result['productId'] ?>" class="details">Chi tiết</a></span></div>
				</div>
				<?php
				}
            }
			?>
		</div>
			<div class="heading1">
				<h3><a href="feaproducts.php" class="highlight-button">Tất cả sản phẩm nổi bật</a></h3>
			</div>
			<div class="content_bottom">
    			<div class="heading">
    				<h3><a class="highlightbutton">Sản phẩm mới nhất</a></h3>
				</div>
    			<div class="clear"></div>
    		</div>
			<div class="section group">
				<?php
             		$product_new = $product->getproduct_new();
             		if($product_new){
               			while($result_new = $product_new->fetch_assoc()){
	      			?>
						<div class="grid_1_of_4 images_1_of_4">
						<a href="details.php?proId=<?php echo $result_new['productId'] ?>"><img src="admin/uploads/<?php echo $result_new['image'] ?>" alt="" /></a>
						<h2><?php echo $result_new['productName'] ?></h2>
						<p><span class="price"><?php echo number_format($result_new['price'], 0, ',', '.') . " VND"; ?></span></p>
					<div class="button"><span><a href="details.php?proId=<?php echo $result_new['productId'] ?>" class="details">Chi tiết</a></span></div>
				</div>
				<?php
				}
            }
			?>
		</div>
    </div>
</div>
<?php
include_once("inc/footer.php");
?>