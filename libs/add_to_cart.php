<?php
if(isset($_GET["ID"])){
    require_once("db.php");
    $is_added=$db->query("Select * from shopping_cart where product_id={$_GET["ID"]}");
    if($is_added->num_rows==0){
        $prepare=$db->prepare("insert into shopping_cart(product_id,quantity) values(?,?)");
        $prepare->bind_param("ii",...[$_GET["ID"],"1"]);
    }
    else{
        $prepare=$db->prepare("update shopping_cart set quantity=quantity+1 where product_id=?");
        $prepare->bind_param("i",$_GET["ID"]);
    }
    $exec=$prepare->execute();
    if($exec){
        header("Location:../index.php");
    }
    else{
        die($db->error);
    }
}
else{
    die("aradığınız sayfa bulunamadı");
}