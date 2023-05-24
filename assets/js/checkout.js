let removeFromCart=document.querySelectorAll("#remove-from-cart");
removeFromCart.forEach(elem=>{
    elem.addEventListener("click",()=>{
        let json=JSON.stringify({
            ID:elem.dataset.product_id,
            func:"remove_from_cart"
        })
        a(json,()=>location.reload());
    })
})
let inc=document.querySelectorAll(".inc")
inc.forEach(elem=>{
    elem.addEventListener("click",()=>{
        let json=JSON.stringify({
            ID:elem.dataset.product_id,
            quantity:parseInt(elem.nextElementSibling.value)+1,
            func:"quantity"
        })
        a(json,()=>location.reload());
    })
})
let desc=document.querySelectorAll(".desc")
desc.forEach(elem=>{
    elem.addEventListener("click",()=>{
        let json=JSON.stringify({
            ID:elem.dataset.product_id,
            quantity:parseInt(elem.previousElementSibling.value)-1,
            func:"quantity"
        })
        a(json,()=>location.reload());
    })
})

let checkout=document.querySelector("#checkout");
checkout.addEventListener("click",()=>{
    let json=JSON.stringify({
        func:"checkout"
    })
    a(json,()=>location.href="index.php")
})