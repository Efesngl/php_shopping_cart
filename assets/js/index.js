let addToCart = document.querySelectorAll("#add-to-cart");
addToCart.forEach((elem) => {
  elem.addEventListener("click", () => {
    let json = JSON.stringify({
      ID: elem.dataset.product_id,
      func: "add_to_chart",
    });
    a(json, () => location.reload());
  });
});
let deleteProduct = document.querySelectorAll("#delete-product");
deleteProduct.forEach((elem) => {
  elem.addEventListener("click", () => {
    let json = JSON.stringify({
      ID: elem.dataset.product_id,
      func: "delete_product",
    });
    a(json, () => location.reload());
  });
});