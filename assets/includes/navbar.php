<?php 
    require_once("lib/db.php");
    $cart_count = $db->query("select count(*) as 'count' from shopping_cart")->fetch_object();
    $order_count = $db->query("select count(*) as 'count' from orders")->fetch_object();
?>
<nav class="navbar navbar-expand-lg bg-body-tertiary mb-5">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Alışveriş sepeti</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" data-link="index.php" aria-current="page" href="index.php">Ürünler</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-link="add_product.php" href="add_product.php">Ürün Ekle</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-link="orders.php" href="orders.php">Siparişler (<?php echo $order_count->count;?>)</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-link="cart.php" href="cart.php">Sepet (<?php echo $cart_count->count;?>)</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>