<?php
require_once("db.php");
$cart_sum = $db->query("        
    select sum(p.product_price) as 'toplam' from shopping_cart as sc
    inner join products as p on p.ID=sc.product_id")->fetch_object();
$products = $db->query("
        select p.*,sc.ID as 'sc_ID' from shopping_cart as sc
        inner join products as p on p.ID=sc.product_id
    ");
$prepare = $db->prepare("insert into orders(total) values(?)");
$prepare->bind_param("d", $cart_sum->toplam);
$exec = $prepare->execute();
if ($exec) {
    $order_id=$db->insert_id;
    while($row=$products->fetch_object()){
        $data=[
            "1"=>$db->insert_id,
            "2"=>$row->ID
        ];
        $product_prepare=$db->prepare("insert into order_products(order_id,product_id) values(?,?)");
        $product_prepare->bind_param("ii",...$data);
        $product_exec=$product_prepare->execute();
        if(!$product_exec){
            die($db->error);
        }
    }
    $db->query("delete from shopping_cart");
    header("Location:../index.php");
} else {
    die($db->error);
}
