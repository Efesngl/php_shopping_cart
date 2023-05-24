//add product
let addProduct=document.querySelector("#add-product");
addProduct.addEventListener("click",()=>{
    let json={
        product_name:document.querySelector("#product_name").value,
        product_price:document.querySelector("#product_price").value,
        func:"add_product"
    }
    a(JSON.stringify(json),()=>location.href="index.php");
});