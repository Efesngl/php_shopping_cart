<?php
if(isset($_GET["ID"])){
    require_once("db.php");
    $prepare=$db->prepare("delete from shopping_cart where ID=?");
    $prepare->bind_param("i",$_GET["ID"]);
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