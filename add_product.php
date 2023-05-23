<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sepet</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
</head>

<body>
<?php require_once("assets/includes/navbar.php");?>
    <div class="container">
        <h2 class="text-center">Ürün Ekle</h2>
        <div class="row justify-content-center">
            <div class="col-6 ">
                <form action="libs/add_products.php" method="post">
                    <label class="mt-3" for="product_name">Ürün adı</label>
                    <input type="text" placeholder="ürün ismi" name="product_name" class="form-control">
                    <label class="mt-3" for="product_price">Ürün fiyatı</label>
                    <input type="text" placeholder="ürün fiyatı" name="product_price" class="form-control">
                    <div class="row text-center mt-3">
                        <div class="col-12">
                            <button type="submit" class="btn btn-success">Ekle</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-12 text-center">
                <a href="index.php" class="btn btn-danger mt-3">Geri git</a>
            </div>
        </div>
    </div>


    <script src="assets/js/script.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>