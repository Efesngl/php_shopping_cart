<?php
require_once("libs/db.php");
$products = $db->query("
        select p.*,sc.ID as 'sc_ID',sc.quantity from shopping_cart as sc
        inner join products as p on p.ID=sc.product_id
    ");
// echo "<pre>";print_r($products);die();
$cart_sum = $db->query("        
    select sum(p.product_price*sc.quantity) as 'toplam' from shopping_cart as sc
    inner join products as p on p.ID=sc.product_id")->fetch_object();
    $cart_count = $db->query("select count(*) as 'count' from shopping_cart")->fetch_object();
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
                            <th class="text-center">Sepetten Çıkar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($products->num_rows > 0) : while ($row = $products->fetch_object()) :$total=$row->product_price*$row->quantity; ?>
                                <tr>
                                    <td><img src="assets/img/product17.webp" style="width:50px;" alt=""></td>
                                    <td><?php echo $row->product_name; ?></td>
                                    <td><?php echo number_format($row->product_price,2,".",","); ?> TL</td>
                                    <td class="text-center" style="width:150px;">
                                        <a href="libs/quantity.php?ID=<?php echo $row->ID;?>&quantity=<?php echo $row->quantity+1;?>"><i class="fa-solid fa-square-plus fa-lg"></i></a>
                                        <input type="text" class="form-control w-25 d-inline" value="<?php echo $row->quantity; ?>">
                                        <a href="libs/quantity.php?ID=<?php echo $row->ID;?>&quantity=<?php echo $row->quantity-1;?>"><i class="fa-solid fa-square-minus fa-lg"></i></a>
                                    </td>
                                    <td><?php echo number_format($total,2,".",","); ?> TL</td>
                                    <td class="text-center"><a href="libs/delete_from_cart.php?ID=<?php echo $row->ID; ?>" class="btn btn-danger mt-3">Sepetten Çıkar</a></td>
                                </tr>
                            <?php endwhile;endif;?>
                    </tbody>
                    <tfoot class="p-3 bg-dark-subtle">
                        <tr>
                            <td colspan="2" class="text-end">Toplam: <?php echo number_format($cart_sum->toplam, 2, ".", ","); ?> TL</td>
                            <td colspan="4" class="text-end"><a href="libs/checkout.php" class="btn btn-success">Sepeti Onayla</a></td>
                        </tr>
                    </tfoot>
                </table>
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
    <script src="https://kit.fontawesome.com/0d17341adb.js" crossorigin="anonymous"></script>
</body>

</html>