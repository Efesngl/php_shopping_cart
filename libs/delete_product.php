<?php
if(isset($_GET["ID"])){
    require_once("db.php");
    $prepare=$db->prepare("delete from products where ID=?");
    $prepare->bind_param("i",$_GET["ID"]);
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