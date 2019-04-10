<?php include_once("header.php"); ?>
<?php
    require_once("entities/product.class.php");
    require_once("entities/category.class.php");

    if(isset($_POST["btnsubmit"])){

        $productName = $_POST["txtName"];
        $cateID = $_POST["txtCateID"];
        $price = $_POST["txtprice"];
        $quantity = $_POST["txtquantity"];
        $description = $_POST["txtdesc"];
        $picture = $_FILES["txtpic"];

        $newProduct = new Product($productName, $cateID, $price, $quantity, $description, $picture);

        $result = $newProduct->save();
        if(!$result)
        {
            header("Location: add_product.php?failure");
        }
        else {
            header("Location: add_product.php?inserted");
        }
    }
?>
<?php
    if(isset($_GET["inserted"])){
        echo "<h2>Them san pham thanh cong</h2>";
    }
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
<form method="post" enctype="multipart/form-data" class="form-horizontal">
    <div class="form-group">
        <div class="lbltitle">
            <lable class="control-label col-sm-2">Tên sản phẩm</lable>
        </div>

        <div class="lblinput">
            <input class="col-sm-6" type="text" name="txtName" value="<?php echo isset($_POST["txtName"]) ? $_POST["txtName"] : "" ; ?>" />
        </div>
    </div>


    <div class="form-group">
        <div class="lbltitle" >
            <lable class="control-label col-sm-5">Mô tả sản phẩm</lable>
        </div>
        <div class="lblinput">
            <textarea class="col-sm-6" id="comment" cols="5" rows="5" value="<?php echo isset($_POST["txtdesc"]) ? $_POST["txtdesc"] : "" ; ?>" ></textarea>
        </div>    
    </div>

    <div class="form-group">
        <div class="lbltitle">
            <lable class="control-label col-sm-5">Số lượng sản phẩm</lable>
        </div>

        <div class="lblinput">
            <input class="col-sm-6" type="text" name="txtquantity" value="<?php echo isset($_POST["txtquantity"]) ? $_POST["txtquantity"] : "" ; ?>" />
        </div>
    </div>

    <div class="form-group">
        <div class="lbltitle">
            <lable class="control-label col-sm-5">Chọn loại sản phẩm</lable>
        </div>
        <div class="">
             <select name="txtCateID" class="col-sm-6">
                <option value="" selected>--Chọn loại--</option>
                <?php 
                $cates = Category::list_category();
                foreach ($cates as $item){
                    echo "<option value=".$item["CateID"].">".$item["CategoryName"]."</option>";
                 }
                ?>
            </select> 
        </div>
    </div>

    <div class="form-group">
        <div class="lbltitle">
            <lable class="control-label col-sm-5">Giá bán</lable>
        </div>

        <div class="lblinput">
            <input class="col-sm-6" type="text" name="txtprice" value="<?php echo isset($_POST["txtprice"]) ? $_POST["txtprice"] : "" ; ?>" />
        </div>
    </div>

    <div cclass="form-group">
        <div class="lbltitle">
            <lable class="control-label col-sm-5">Đường dẫn hình</lable>
        </div>

        <div class="lblinput">
            <input class="col-sm-6" type="file" id="txtpic" name="txtpic" accept=".PNG,.GIF,.JPG"  />
        </div>
    </div>

    <div class="form-group">
        <div class="lblinput">
            <input type="submit" name="btnsubmit" value="Thêm sản phẩm" class="btn btn-primary" />
        </div> 
    </div>
</form>
<?php include_once("footer.php"); ?>