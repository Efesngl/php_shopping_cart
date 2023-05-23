<?php
$db=new mysqli("localhost","root","","shopping_cart");
if($db->connect_error){
    die("database bağlantı hatası");
}