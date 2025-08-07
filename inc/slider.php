<div class="header_bottom">
		<div class="header_bottom_left">
			<div class="section group">
				<?php
				$getLastestiPhone = $product -> getLastestiPhone();{
					if($getLastestiPhone)
				    while($resultiphone = $getLastestiPhone->fetch_assoc()){
				?>
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						 <a href="details.php?proId=<?php echo $resultiphone['productId'] ?>"> <img src="admin/uploads/<?php echo $resultiphone['image'] ?>" alt="" /></a>
					</div>
				    <div class="text list_2_of_1">
						<h2>iPhone</h2>
						<p><?php echo $resultiphone['productName'] ?></p>
						<div class="button"><span><a href="details.php?proId=<?php echo $resultiphone['productId'] ?>">Mua ngay</a></span></div>
				   </div>
			   </div>
			   <?php
			}
                }

			   ?>	
			   	<?php
				$getLastestiPad = $product -> getLastestiPad();{
					if($getLastestiPad)
				    while($resultipad = $getLastestiPad->fetch_assoc()){
				?>	
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						  <a href="details.php?proId=<?php echo $resultipad['productId'] ?>"><img src="admin/uploads/<?php echo $resultipad['image'] ?>" alt="" /></a>
					</div>
					<div class="text list_2_of_1">
						  <h2>iPad</h2>
						  <p><?php echo $resultipad['productName'] ?></p>
						  <div class="button"><span><a href="details.php?proId=<?php echo $resultipad['productId'] ?>">Mua ngay</a></span></div>
					</div>
				</div>
				<?php 
			}
                }

			   ?>
			</div>
			<div class="section group">
				<?php
				    $getLastestMacBook = $product -> getLastestMacBook();{
					if($getLastestMacBook)
				    while($resultmacbook = $getLastestMacBook->fetch_assoc()){
				?>
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						 <a href="details.php?proId=<?php echo $resultmacbook['productId'] ?>"> <img src="admin/uploads/<?php echo $resultmacbook['image'] ?>" alt="" /></a>
					</div>
				    <div class="text list_2_of_1">
						<h2>MacBook</h2>
						<p><?php echo $resultmacbook['productName'] ?></p>
						<div class="button"><span><a href="details.php?proId=<?php echo $resultmacbook['productId'] ?>">Mua ngay</a></span></div>
				   </div>
			   </div>	
			   		<?php 
			}
                }

			   ?>
			   <?php
				    $getLastestAirPods = $product -> getLastestAirPods();{
					if($getLastestAirPods)
				    while($resultairpods = $getLastestAirPods->fetch_assoc()){
				?>
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						  <a href="details.php?proId=<?php echo $resultairpods['productId'] ?>"><img src="admin/uploads/<?php echo $resultairpods['image'] ?>" alt="" /></a>
					</div>
					<div class="text list_2_of_1">
						  <h2>AirPods</h2>
						  <p><?php echo $resultairpods['productName'] ?></p>
						  <div class="button"><span><a href="details.php?proId=<?php echo $resultairpods['productId'] ?>">Mua ngay</a></span></div>
					</div>
				</div>
				<?php 
			}
                }

			   ?>	
			
			</div>
		  <div class="clear"></div>
		</div>
			 <div class="header_bottom_right_images">
             
			<section class="slider">
				  <div class="flexslider">
					<ul class="slides">
						<li><img src="images/14prm.jpg" alt=""/></li>
						<li><img src="images/Banner1.png" alt=""/></li>
						<li><img src="images/ipad11.jpg" alt=""/></li>
						<li><img src="images/Banner4.png" alt=""/></li>
				    </ul>
				  </div>
	      </section>
	    </div>
	  <div class="clear"></div>
	</div>	