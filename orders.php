<?php
require_once("libs/db.php");
$orders=$db->query("select * from orders");
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
<?php require_once("assets/includes/navbar.php");?>
    <div class="container">
        <h2 class="text-center">Siparişler</h2> 
        <div class="row justify-content-evenly bg-secondary-subtle mt-5">
            <div class="col-12 p-2">
                <div class="col-12 p-3">
                <?php while ($row = $orders->fetch_object()) : ?>
                        <div class="card mb-3">
                            <div class="card-body">
                                <h5 class="card-title">Sipariş numarası :<?php echo $row->ID; ?></h5>
                                <p class="card-text">Toplam :<?php echo number_format($row->total, 2, ".", ","); ?> TL</p>
                                <a href="order_detail.php?ID=<?php echo $row->ID; ?>" class="btn btn-primary">Detay</a>
                            </div>
                        </div>
                    <?php endwhile; ?>
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