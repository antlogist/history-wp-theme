import axios from "axios";
import Cart from "../Classes/Cart";

const cart = new Cart();

(function () {
"use strict";

BASEOBJECT.cart.cart = function () {
  const app = new Vue({
    el: "#shoppingCart",
    data: {
      items: [],
      currency: "",
      cartTotal: 0,
      cartTotalVat: 0,
      vat: 0,
      fail: false,
      authenticated: false,
      isFirstLoading: true,
      isLoading: false
    },
    methods: {
      displayItems() {
        this.isLoading = true;
        axios.get(`${themeUrl}/inc/app/Routes/GetCartItems.php`).then (function(response){
          if(response.data.fail) {
            app.fail = true;
            app.message = response.data.fail;
          } else {
            app.items = response.data.items;
            app.cartTotal = response.data.cartTotal;
            app.cartTotalVat = response.data.cartTotalVat;
            app.vat = response.data.vat;
            app.authenticated = response.data.authenticated;
            app.currency = response.data.currency;
          }
          app.isFirstLoading = false;
          app.isLoading = false;
        })
      },
      updateQuantity(product_id, operator) {
        axios.post(`${themeUrl}/inc/app/Routes/UpdateCartQty.php`, JSON.stringify(
          { product_id: product_id, operator: operator }
        )).then(function(resp) {
          app.displayItems();
        });
      },
      removeItem(index) {
        axios.post(`${themeUrl}/inc/app/Routes/RemoveCartItem.php`, JSON.stringify(
          { item_index: index }
        )).then(function(response) {
          console.log(response);
          app.displayItems();
          if(response.data.fail) {
            window.location.reload();
          } else {
            cart.updateHeaderCart(response.data.countItems);
          }
        });
      },
    },
    created: function(){
      this.displayItems();
    }
  })
}

})();