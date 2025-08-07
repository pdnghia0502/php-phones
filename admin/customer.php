<?php include_once 'inc/header.php';?>
<?php include_once 'inc/sidebar.php';?>
<?php
$filepath = realpath(dirname (__FILE__));
include_once ($filepath. '/../classes/customer.php');
include_once ($filepath. '/../helpers/format.php');
?>
<?php
    if(!isset($_GET['customerid']) || $_GET['customerid']==NULL){
        echo "<script>window.location = 'inbox.php'</script>";
    }
    else{
        $Id = $_GET['customerid'];
    }
    $cs = new customer();
?>
    <div class="grid_10">
        <div class="box round first grid">
            <h2>Sửa tên loại</h2>
            <div class="block copyblock"> 
            <?php
                $get_customer = $cs -> show_customers($Id);
                if($get_customer){
                while($result = $get_customer -> fetch_assoc()){
                    ?>
                    <form action="catadd.php" method="post">
                        <table class="form">				
                        <tr>
                            <td>Tên :</td>                            
                            <td>
                                <input type="text" readonly="readonly" value="<?php echo $result['name']?>" name="cusName" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>Địa chỉ :</td>                        
                            <td>
                                <input type="text" readonly="readonly" value="<?php echo $result['address']?>" name="cusName" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>Điện thoại :</td>                             
                            <td>
                                <input type="text" readonly="readonly" value="<?php echo $result['phone']?>" name="cusName" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>Email :</td>                              
                            <td>
                                <input type="text" readonly="readonly" value="<?php echo $result['email']?>" name="cusName" class="medium" />
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
