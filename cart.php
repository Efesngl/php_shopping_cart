<?php
require_once("libs/db.php");
$products = $db->query("
        select p.*,sc.ID as 'sc_ID' from shopping_cart as sc
        inner join products as p on p.ID=sc.product_id
    ");
$cart_sum = $db->query("        
    select sum(p.product_price) as 'toplam' from shopping_cart as sc
    inner join products as p on p.ID=sc.product_id")->fetch_object();
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
        <h2 class="text-center">Sepet</h2>
        <div class="row justify-content-evenly mt-5">
            <div class="col-6 bg-secondary-subtle">
                <div class="col-12 p-3">
                    <h3>Sepetteki ürünler</h3>
                    <?php while ($row = $products->fetch_object()) : ?>
                        <div class="card mb-3">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $row->product_name; ?></h5>
                                <p class="card-text"><?php echo number_format($row->product_price, 2, ".", ","); ?> TL</p>
                                <a href="libs/delete_from_cart.php?ID=<?php echo $row->sc_ID; ?>" class="btn btn-danger">Sepetten kaldır</a>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
            <div class="col-5 bg-secondary-subtle">
                <div class="col-12   p-3">
                <h3>Sepet Bilgileri</h3>
                <br>
                <h3>Sepet Toplamı : <span><?php echo number_format($cart_sum->toplam, 2, ".", ","); ?> TL</span></h3>
                <a href="libs/checkout.php?total=<?php echo $cart_sum->toplam;?>" class="btn btn-success">Sepeti onayla</a>
                </div>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-12 text-center">
                <a href="index.php" class="btn btn-danger">Ana sayfaya dön</a>
            </div>
        </div>
    </div>


    <script src="assets/js/script.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>