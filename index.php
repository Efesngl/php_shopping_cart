<?php
require_once("lib/db.php");
$products = $db->query("select * from products");

?>
<!DOCTYPE html>
<html lang="tr">

<head>
    <?php require_once("assets/includes/head.php"); ?>
</head>

<body>
    <?php require_once("assets/includes/navbar.php"); ?>
    <div class="container">
        <h2 class="text-center">Ürünler</h2>
        <div class="row mt-1 mb-5 justify-content-center">
            <?php while ($row = $products->fetch_object()) : ?>
                <div class="card m-2 justify-content-between p-3" style="width: 18rem;">
                    <img src="assets/img/product17.webp" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $row->product_name ?></h5>
                        <p class="card-text"><?php echo number_format($row->product_price, 2, ".", ","); ?> TL</p>
                    </div>
                    <div class="row justify-content-between text-center">
                        <div class="col-6">
                            <button data-product_id="<?php echo $row->ID ?>" id="add-to-cart" class="btn btn-primary">Sepete Ekle</button>
                        </div>
                        <div class="col-6">
                            <button data-product_id="<?php echo $row->ID ?>" id="delete-product" class="btn btn-danger">Ürünü sil</button>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>

    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/index.js"></script>
</body>

</html>