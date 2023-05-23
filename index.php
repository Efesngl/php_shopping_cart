<?php
require_once("libs/db.php");
$products = $db->query("select * from products");
$cart_count=$db->query("select count(*) as 'count' from shopping_cart")->fetch_object();
$order_count=$db->query("select count(*) as 'count' from orders")->fetch_object();
?>
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
    <div class="container">
        <h2 class="text-center">Ürünler</h2>
        <div class="row justify-content-center">
            <?php while ($row = $products->fetch_object()) : ?>
                <div class="card justify-content-between p-3" style="width: 18rem;">
                    <img src="assets/img/product17.webp" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $row->product_name ?></h5>
                        <p class="card-text"><?php echo number_format($row->product_price, 2, ".", ","); ?> TL</p>
                    </div>
                    <div class="row justify-content-between text-center">
                        <div class="col-6">
                            <a href="libs/add_to_cart.php?ID=<?php echo $row->ID;?>" class="btn btn-primary">Sepete Ekle</a>
                        </div>
                        <div class="col-6">
                            <a href="libs/delete_product.php?ID=<?php echo $row->ID;?>" class="btn btn-danger">Ürünü sil</a>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
        <div class="row">
            <div class="col-4 text-center">
                <a href="add_product.php" class="mt-3 btn btn-success">Ürün ekle</a>
            </div>
            <div class="col-4 text-center">
                <a href="cart.php" class="mt-3 btn btn-primary">Sepet (<?php echo $cart_count->count;?>)</a>
            </div>
            <div class="col-4 text-center">
                <a href="orders.php" class="mt-3 btn btn-secondary">Siparişler (<?php echo $order_count->count;?>)</a>
            </div>
        </div>
    </div>


    <script src="assets/js/script.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>