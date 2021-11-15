export default class Cart {

  updateHeaderCart(items) {
    const headerCart = document.querySelector(".cart-count");
    headerCart.textContent = items;
  }

}
