<?php
require_once("libs/db.php");
$products = $db->prepare("
        select p.*,op.quantity from order_products as op
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

<body class="bg-secondary-subtle">
    <?php require_once("assets/includes/navbar.php"); ?>
    <div class="container">
        <h2 class="text-center">Sepetinizde <span class="text-danger"><?php echo $cart_count->count;?></span> adet ürün var</h2>
        <div class="row justify-content-center mt-5">
            <div class="col-8 p-0">
                <table class="table mb-1 table-bordered border-secondary-subtle table-striped table-hover">
                    <thead>
                        <tr>
                            <th class="text-center">Ürün resmi</th>
                            <th class="text-center">Ürün adı</th>
                            <th class="text-center">Ürün fiyatı</th>
                            <th class="text-center">Ürün adedi</th>
                            <th class="text-center">Toplam</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($pr->num_rows > 0) : while ($row = $pr->fetch_object()) :$total=$row->product_price*$row->quantity; ?>
                                <tr>
                                    <td><img src="assets/img/product17.webp" style="width:50px;" alt=""></td>
                                    <td><?php echo $row->product_name; ?></td>
                                    <td><?php echo number_format($row->product_price,2,".",","); ?> TL</td>
                                    <td class="text-center" style="width:150px;"><?php echo $row->quantity;?></td>
                                    <td><?php echo number_format($total,2,".",","); ?> TL</td>
                                </tr>
                            <?php endwhile;endif;?>
                    </tbody>
                    <tfoot class="p-3 bg-dark-subtle">
                        <tr>
                            <td colspan="5" class="text-end">Sipariş toplam: <?php echo number_format($cs->toplam, 2, ".", ","); ?> TL</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-6 text-center">
            <a href="orders.php" class="btn btn-primary">Geri Git</a>
        </div>
        <div class="col-6 text-center">
            <a href="index.php" class="btn btn-danger">Ana sayfaya dön</a>
        </div>
    </div>
    </div>


    <script src="assets/js/script.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/0d17341adb.js" crossorigin="anonymous"></script>
</body>

</html>