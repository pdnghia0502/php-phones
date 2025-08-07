<?php include_once 'inc/header.php';?>
<?php include_once 'inc/sidebar.php';?>
<?php include_once ("../classes/brand.php")?>
<?php
    if(!isset($_GET['brandId']) || $_GET['brandId']==NULL){
        echo "<script>window.location = 'brandlist.php'</script>";
    }
  else{
        $Id = $_GET['brandId'];
  }
    $brand = new brand();
if ($_SERVER['REQUEST_METHOD']=='POST')
{
    $brandName = $_POST['brandName'];
    $updateBrand = $brand -> update_brand($brandName,$Id);
}
?>
<?php ?>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Sửa thương hiệu</h2>
               <div class="block copyblock"> 
                <?php
                if (isset($updateBrand)){
                    echo $updateBrand;
                }
                ?>
                <?php
                $get_brand_name = $brand -> getbrandbyId($Id);
                if($get_brand_name){
                	while($result = $get_brand_name -> fetch_assoc()){
                ?>
                <form action="" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" value="<?php echo $result['brandName']?>" name="brandName" placeholder="Sửa thương hiệu tại đây..." class="medium" />
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Cập nhật" />
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
	 