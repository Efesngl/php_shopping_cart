<?php
if(isset($_GET["ID"]) && isset($_GET["quantity"])){
    require_once("db.php");
    if($_GET["quantity"]!=0){
        $prepare=$db->prepare("update shopping_cart set quantity=? where product_id=?");
        $prepare->bind_param("ii",...[$_GET["quantity"],$_GET["ID"]]);
    }
    else{
        $prepare=$db->prepare("delete from shopping_cart where product_id=?");
        $prepare->bind_param("i",$_GET["ID"]);
    }
    $exec=$prepare->execute();
    if($exec){
        header("Location:../cart.php");
    }
    else{
        die($db->error);
    }
}
else{
    die("aradığınız sayfa bulunamadı");
}