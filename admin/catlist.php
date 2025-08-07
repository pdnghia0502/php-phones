<?php include_once 'inc/header.php';?>
<?php include_once 'inc/sidebar.php';?>
<?php include_once ("../classes/category.php");?>
<?php 
$cat = new category();
     if(isset($_GET['delId'])){
        $Id = $_GET['delId'];
        $delCat = $cat -> del_category($Id);
    }
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Danh sách loại sản phẩm</h2>
                <div class="block">
                <?php
                if (isset($delCat)){
                    echo $delCat;
                }
                ?>        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>STT</th>
							<th>Tên loại</th>
							<th>Thao tác</th>
						</tr>
					</thead>
					<tbody>
						<?php
                         $show_cate = $cat -> show_category();
                         	if($show_cate){
                         		$i=0;
                         		while ($result = $show_cate -> fetch_assoc()) {
                         			$i++;
                         		
                         
						?>
						<tr class="odd gradeX">
							<td><?php echo $i ?></td>
							<td><?php echo $result['catName']?></td>
							<td><a href="catedit.php?catId=<?php echo $result ['catId']?>">Sửa</a> || <a onclick = "return confirm('Bạn có thực sự muốn xóa?')"href="?delId=<?php echo $result ['catId']?>">Xóa</a></td>
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
<?php include_once 'inc/footer.php';?>

