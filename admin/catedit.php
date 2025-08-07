<?php include_once 'inc/header.php';?>
<?php include_once 'inc/sidebar.php';?>
<?php include_once ("../classes/category.php")?>
<?php
if(!isset($_GET['catId']) || $_GET['catId']==NULL){
    echo "<script>window.location = 'catlist.php'</script>";
}
else{
    $Id = $_GET['catId'];
}
$cat = new category();
if ($_SERVER['REQUEST_METHOD']=='POST')
{
    $catName = $_POST['catName'];
    $updateCat = $cat -> update_category($catName,$Id);
}
?>


        <div class="grid_10">
            <div class="box round first grid">
                <h2>Sửa tên loại</h2>
               <div class="block copyblock"> 
                <?php
                if (isset($updateCat)){
                    echo $updateCat;
                }
                ?>
                <?php
                $get_cat_name = $cat -> getcatbyId($Id);
                if($get_cat_name){
                	while($result = $get_cat_name -> fetch_assoc()){

                	
               
                ?>
                 <form action="catedit.php?catId=<?php echo $result['catId']; ?>" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" value="<?php echo $result['catName']?>" name="catName" placeholder="Sửa loại sản phẩm tại đây..." class="medium" />
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Sửa" />
                            </td>
                        </tr>
                    </table>
                    </form>
                    <?php
                } 
            }
                    ?>
                </div>
            </div>
        </div>
<?php include_once 'inc/footer.php';?>
