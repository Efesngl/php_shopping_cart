<?php
require_once("lib/db.php");
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
    <?php require_once("assets/includes/head.php"); ?>
</head>

<body class="bg-secondary-subtle">
    <?php require_once("assets/includes/navbar.php"); ?>
    <div class="container">
        <h2 class="text-center">Sepetinizde <span class="text-danger"><?php echo $cart_count->count; ?></span> adet ürün var</h2>
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
                        <?php if ($products->num_rows > 0) : while ($row = $products->fetch_object()) : $total = $row->product_price * $row->quantity; ?>
                                <tr>
                                    <td><img src="assets/img/product17.webp" style="width:50px;" alt=""></td>
                                    <td><?php echo $row->product_name; ?></td>
                                    <td><?php echo number_format($row->product_price, 2, ".", ","); ?> TL</td>
                                    <td class="text-center" style="width:150px;">
                                        <button class="btn text-success inc" data-product_id="<?php echo $row->ID;?>" ><i class="fa-solid fa-square-plus fa-lg"></i></button>
                                        <input disabled type="text" class="form-control w-25 d-inline" value="<?php echo $row->quantity; ?>">
                                        <button class="btn text-danger desc" data-product_id="<?php echo $row->ID;?>" ><i class="fa-solid fa-square-minus fa-lg"></i></button>
                                    </td>
                                    <td><?php echo number_format($total, 2, ".", ","); ?> TL</td>
                                    <td class="text-center"><button data-product_id="<?php echo $row->ID;?>" id="remove-from-cart" class="btn btn-danger mt-3">Sepetten Çıkar</button></td>
                                </tr>
                        <?php endwhile;
                        endif; ?>
                    </tbody>
                    <tfoot class="p-3 bg-dark-subtle">
                        <tr>
                            <td colspan="2" class="text-end">Toplam: <?php echo number_format($cart_sum->toplam, 2, ".", ","); ?> TL</td>
                            <td colspan="4" class="text-end"><button id="checkout" class="btn btn-success">Sepeti Onayla</button></td>
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


    <script src="assets/js/checkout.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/0d17341adb.js" crossorigin="anonymous"></script>
</body>

</html>