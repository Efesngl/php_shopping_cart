<!DOCTYPE html>
<html lang="tr">

<head>
    <?php require_once("assets/includes/head.php");?>
</head>

<body>
<?php require_once("assets/includes/navbar.php");?>
    <div class="container">
        <h2 class="text-center">Ürün Ekle</h2>
        <div class="row justify-content-center">
            <div class="col-6 ">
                    <label class="mt-3" for="product_name">Ürün adı</label>
                    <input type="text" placeholder="ürün ismi" id="product_name" name="product_name" class="form-control">
                    <label class="mt-3" for="product_price">Ürün fiyatı</label>
                    <input type="text" placeholder="ürün fiyatı" id="product_price" name="product_price" class="form-control">
                    <div class="row text-center mt-3">
                        <div class="col-12">
                            <button type="submit" id="add-product" class="btn btn-success">Ekle</button>
                        </div>
                    </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 text-center">
                <a href="index.php" class="btn btn-danger mt-3">Geri git</a>
            </div>
        </div>
    </div>



    <script src="assets/js/add_product.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>