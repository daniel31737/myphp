<?php
    include_once("header.php");
?>
<?php
    require_once("entities/category.class.php");    
    require_once("entities/product.class.php");

    if(!isset($_GET["cateid"])){
        $prods = Product::list_product();
    }
    else{
        $cateid = $_GET["cateid"];
        $prods =  Product::list_product_by_cateid($cateid);
    }
    $cates = Category::list_category();
?>
    <div class="navbar navbar-default navbar-static-top" role="navigation">
    <ul class="menu">
        <div class="container">
            <div class="container-header">
                <a class="navbar-brand" href="/lab5/list_product.php">Danh sách sản phẩm</a>
                <a class="navbar-brand" href="/lab5/add_product.php">Thêm sản phẩm</a>
            </div>
        </div>   
    </div>
    <div class="container text-center">
        <div class="row">
        <div class="col-sm-3 panel panel-heading">
            <a href="/lab5/list_product.php"><h3 class="panel-heading">Danh mục</h3></a>
                <ul class="list-group">
                    <?php foreach($cates as $item){ 
                      echo "<li class='list-group-item'><a href='/lab5/list_product.php?cateid=".$item["CateID"]."'>".$item["CategoryName"]."</a></li>";
                     } 
                     ?>
                </ul>
        </div>
        <div class="col-sm-9">
            <h3 class="product-shop">Sản phẩm cửa hàng</h3><br>
            <div class="row">
            <?php 
                foreach($prods as $item){
            ?>
                <div class="col-sm-4">
                    <img src="<?php echo $item["Picture"]; ?>" class="img-responsive" style="width:100%; height:250px;" alt="Image">
                    <a href="/lab5/product_detail.php?id=<?php echo $item["ProductID"]; ?> "><p class="text-danger"><?php echo $item["ProductName"]; ?></p></a>
                    <p class="text-info"><?php echo $item["Price"]; ?></p>
                    <p>
                        <button type="button" class="btn btn-primary" onclick="location.href='/lab5/shopping_cart.php?id=<?php echo $item["ProductID"]; ?>'" >Mua hàng</button>
                    </p>
                </div>
                <?php } ?>
            </div>      
        </div>
        </div>
    </div>    
   <?php
    include_once("footer.php");
    ?>