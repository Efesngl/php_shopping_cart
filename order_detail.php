<?php
require_once("libs/db.php");
$products = $db->prepare("
        select p.* from order_products as op
        inner join products as p on p.ID=op.product_id
        where op.order_id=?
    ");
$products->bind_param("i", $_GET["ID"]);
$products->execute();
$pr =$products->get_result(); 
$cart_sum = $db->prepare("        
    select total as 'toplam' from orders where ID=?
");
$cart_sum->bind_param("i",$_GET["ID"]);
$cart_sum->execute();
$cs=$cart_sum->get_result()->fetch_object();
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
                    <?php while ($row = $pr->fetch_object()) : ?>
                        <div class="card mb-3">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $row->product_name; ?></h5>
                                <p class="card-text"><?php echo number_format($row->product_price, 2, ".", ","); ?> TL</p>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
            <div class="col-5 bg-secondary-subtle">
                <div class="col-12   p-3">
                    <h3>Sipariş Bilgileri</h3>
                    <br>
                    <h3>Sipariş Toplamı : <span><?php echo number_format($cs->toplam, 2, ".", ","); ?> TL</span></h3>
                </div>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-12 text-center">
                <a href="orders.php" class="btn btn-danger">Geri git</a>
            </div>
        </div>
    </div>


    <script src="assets/js/script.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>