import axios from "axios";

(function () {
"use strict";

BASEOBJECT.shop.shopProducts = function () {
  const app = new Vue({
    el: "#shop",
    data: {
      products: {},
      count: 0,
      isLoading: true,
      inCart: ""
    },
    methods: {
      getProducts() {
        axios.get(`${themeUrl}/inc/app/Routes/Shop.php`).then (function(resp){
          console.log(resp["data"]["data"]);
          app.products = resp["data"]["data"];
          app.isLoading = false;
        })
      },
      addToCart(id, title, qty, price, vat_price, vat_percent) {
        BASEOBJECT.module.addItemToCart(id, title, qty, price, vat_price, vat_percent);
        app.inCart = id;
        setTimeout(function() {
          app.inCart = "";
        }, 750)
      }
    },
    created: function(){
      this.getProducts();
    }
  })
}

})();