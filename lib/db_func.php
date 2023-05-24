<?php
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $json=json_decode(file_get_contents("php://input"),true);
    $json["func"]($json);
}
function add_to_chart($json)
{
    if (isset($json["ID"])) {
        require_once("db.php");
        $is_added = $db->query("Select * from shopping_cart where product_id={$json["ID"]}");
        if ($is_added->num_rows == 0) {
            $prepare = $db->prepare("insert into shopping_cart(product_id,quantity) values(?,?)");
            $prepare->bind_param("ii", ...[$json["ID"], "1"]);
        } else {
            $prepare = $db->prepare("update shopping_cart set quantity=quantity+1 where product_id=?");
            $prepare->bind_param("i", $json["ID"]);
        }
        $exec = $prepare->execute();
        if ($exec) {
            header("Location:../index.php");
        } else {
            die($db->error);
        }
    } else {
        die("aradığınız sayfa bulunamadı");
    }
}
function remove_from_cart($json)
{
    if (isset($json["ID"])) {
        require_once("db.php");
        $prepare = $db->prepare("delete from shopping_cart where product_id=?");
        $prepare->bind_param("i", $json["ID"]);
        $exec = $prepare->execute();
        if ($exec) {
            header("Location:../cart.php");
        } else {
            die($db->error);
        }
    } else {
        die("aradığınız sayfa bulunamadı");
    }
}
function add_product($json)
{
    if (isset($json["product_name"]) && isset($json["product_price"])) {
        require_once("db.php");
        $prepare = $db->prepare("insert into products(product_name,product_price) values(?,?)");
        $data = [
            "1" => $json["product_name"],
            "2" => $json["product_price"]
        ];
        $prepare->bind_param("sd", ...$data);
        $exec = $prepare->execute();
        if ($exec) {
            echo true;
        } else {
            die($db->error);
        }
    } else {
        die("aradığınız sayfa bulunamamıştır");
    }
}
function delete_product($json)
{
    if (isset($json["ID"])) {
        require_once("db.php");
        $prepare = $db->prepare("delete from products where ID=?");
        $prepare->bind_param("i", $json["ID"]);
        $exec = $prepare->execute();
        if ($exec) {
            echo true;
        } else {
            die($db->error);
        }
    } else {
        die("aradığınız sayfa bulunamadı");
    }
}
function quantity($json)
{
    if (isset($json["ID"]) && isset($json["quantity"])) {
        require_once("db.php");
        if ($json["quantity"] != 0) {
            $prepare = $db->prepare("update shopping_cart set quantity=? where product_id=?");
            $prepare->bind_param("ii", ...[$json["quantity"], $json["ID"]]);
        } else {
            $prepare = $db->prepare("delete from shopping_cart where product_id=?");
            $prepare->bind_param("i", $json["ID"]);
        }
        $exec = $prepare->execute();
        if ($exec) {
            echo true;
        } else {
            die($db->error);
        }
    } else {
        die("aradığınız sayfa bulunamadı");
    }
}
function checkout($json)
{
    require_once("db.php");
    $cart_sum = $db->query("        
    select sum(p.product_price*sc.quantity) as 'toplam' from shopping_cart as sc
    inner join products as p on p.ID=sc.product_id")->fetch_object();
    $products = $db->query("
        select p.*,sc.quantity from shopping_cart as sc
        inner join products as p on p.ID=sc.product_id
    ");
    $prepare = $db->prepare("insert into orders(total) values(?)");
    $prepare->bind_param("d", $cart_sum->toplam);
    $exec = $prepare->execute();
    if ($exec) {
        $data = ["1" => $db->insert_id];
        while ($row = $products->fetch_object()) {
            $data["2"] = $row->ID;
            $data["3"] = $row->quantity;
            $product_prepare = $db->prepare("insert into order_products(order_id,product_id,quantity) values(?,?,?)");
            $product_prepare->bind_param("iii", ...$data);
            $product_exec = $product_prepare->execute();
            if (!$product_exec) {
                die($db->error);
            }
        }
        $db->query("delete from shopping_cart");
        header("Location:../index.php");
    } else {
        die($db->error);
    }
}
