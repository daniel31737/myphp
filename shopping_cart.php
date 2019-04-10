<?php include_once('header.php'); ?>
<?php
require_once("Entities/product.class.php");
require_once("Entities/category.class.php");

$cates = Category::list_category();

session_start();

error_reporting(E_ALL);
ini_set('display_errors', '1');

if(isset($_GET["id"])){
    $pro_id = $_GET["id"];

    $was_found = false;
    $i=0;
    if(!isset($_SESSION["cart_items"]) || count($_SESSION["cart_items"]) < 1){
        $_SESSION["cart_items"] = array(0 => array("pro_id" => $pro_id, "quantity" => 1));
    }else{
        foreach($_SESSION["cart_items"] as $item){
            $i++;
            while(list($key,$value) = each($item)){
                if($key=="pro_id" && $value==$pro_id){
                    array_splice($_SESSION["cart_items"], $i-1, 1, array(array("pro_id" => $pro_id, "quantity" => $item["quantity"] + 1))); 
                    $was_found = true;  
                }
            }
        }
        if($was_found == false){
            array_push($_SESSION["cart_items"], array("pro_id" => $pro_id, "quantity" => 1));
        }
    }
    header("location: shopping_cart.php");
}
?>

<!-- Thong tin trang gio hang-->

<div class=""container text-center>
    <div class="col-sm-12">
        <div class="row">
            <div class="col-sm-3">
                <h3>Danh Mục</h3>
                <ul class="list-group">
                    <?php
                    foreach($cates as $item){
                        echo "<li class='list-group-item'><a href=/lab5/list_product.php?cateid=".$item["CateID"].">".$item["CategoryName"]."</a></li>";
                    }?>
                </ul>
            </div>
            <div class="col-sm-9">
                <h3 style="text-align: center">Thông Tin Giỏ Hàng</h3><br>
                <table class="table table-condensed">
                    <thead>
                        <tr>
                            <th>Tên Sản Phẩm</th>
                            <th>Hình Ảnh</th>
                            <th>Số Lượng</th>
                            <th>Đơn Giá</th>
                            <th>Thành Tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $total_monney = 0;
                        if(isset($_SESSION["cart_items"]) && count($_SESSION["cart_items"]) > 0){
                            foreach($_SESSION["cart_items"] as $item){
                                $id = $item["pro_id"];
                                $product = Product::get_product($id);
                                $prod = reset($product);
                                $total_monney += $item["quantity"]*$prod["Price"];
                                echo "<tr><td>".$prod["ProductName"]."<tr><td><img style='width:80px; height: 80px' src=".$prod["Picture"]." /></td><td>".$item["quantity"]."</td><td>".$prod["Price"]."</td><td>".$prod["Price"]."</td></tr>";
                            }
                            echo "<tr> <td colspan=5> <p class='text-right text-danger'>Tổng Tiền: ".$total_monney."</p></td> </tr>";
                            echo "<tr> <td colspan=3> <p class='text-right'><button type='button' class='btn btn-primary'>Tiếp Tục Mua Hàng</button></p></td> <td colspan=2><p class='text-right'><button type='button' id='resetSession' class='btn btn-success'>Thanh Toán</button></p></td></tr>";
                        }else{
                            echo "Không có sản phẩm nào trong giỏ hàng!";
                        }

                        ?>
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include_once('footer.php'); ?>

<script>
    $(document).ready(function(){
        $("#resetSession").click(function(){
            session_destroy();
        });
    });
</script>