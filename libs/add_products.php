<?php
if(isset($_POST["product_name"]) && isset($_POST["product_price"])){
    require_once("db.php");
    $prepare=$db->prepare("insert into products(product_name,product_price) values(?,?)");
    $data=[
        "1"=>$_POST["product_name"],
        "2"=>$_POST["product_price"]
    ];
    $prepare->bind_param("sd",...$data);
    $exec=$prepare->execute();
    if($exec){
        header("Location:../index.php");
    }
    else{
        die($db->error);
    }
}
else{
    die("aradığınız sayfa bulunamamıştır");
}