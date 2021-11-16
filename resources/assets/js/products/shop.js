import axios from "axios";

(function () {
"use strict";

BASEOBJECT.shop.shopProducts = function () {
  const app = new Vue({
    el: "#shop",
    data: {
      products: {},
      count: 0,
      loading: false
    },
    methods: {
      getProducts() {
        axios.get(`${themeUrl}/inc/app/Routes/Shop.php`).then (function(resp){
          console.log(resp["data"]["data"]);
          app.products = resp["data"]["data"];
        })
      },
      addToCart(id, title, qty, price, vat_price, vat_percent) {
        BASEOBJECT.module.addItemToCart(id, title, qty, price, vat_price, vat_percent);
      }
    },
    created: function(){
      this.getProducts();
    }
  })
}

})();