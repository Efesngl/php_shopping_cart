<?php
require_once("libs/db.php");
$orders=$db->query("Select * from orders"); 
?>
<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Siparişler</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
</head>

<body class="bg-secondary-subtle">
    <?php require_once("assets/includes/navbar.php"); ?>
    <div class="container">
        <h2 class="text-center"><span class="text-danger"><?php echo $orders->num_rows;?></span> adet siparişiniz var</h2>
        <div class="row justify-content-center mt-5">
            <div class="col-8 p-0">
                <table class="table mb-1 table-bordered border-secondary-subtle table-striped table-hover">
                    <thead>
                        <tr>
                            <th class="text-center">Sipariş numarası</th>
                            <th class="text-center">Sipariş toplamı</th>
                            <th class="text-center">Sipariş detayı</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($orders->num_rows > 0) : while ($row = $orders->fetch_object()) :?>
                                <tr>
                                    <td><?php echo $row->ID;?></td>
                                    <td><?php echo number_format($row->total,2,".",","); ?> TL</td>
                                    <td class="text-center"><a href="order_detail.php?ID=<?php echo $row->ID; ?>" class="btn btn-primary mt-1">Sipariş detayı</a></td>
                                </tr>
                            <?php endwhile;endif;?>
                    </tbody>
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