import axios from "axios";

(function () {
"use strict";

BASEOBJECT.shop.shopProducts = function () {
  const app = new Vue({
    el: "#shop",
    data: {
      products: {},
      membershipProducts: {},
      count: 0,
      isLoading: true,
      inCart: "",
      currency: "",
      membershipIds: ["75"]
    },
    methods: {
      getProducts() {
        axios.get(`${themeUrl}/inc/app/Routes/Shop.php`).then (function(resp){

          const productsExceptMembership = resp["data"]["data"].filter(item => !app.membershipIds.includes(item["cat_id"]));
          const productsIncludingMembership = resp["data"]["data"].filter(item => app.membershipIds.includes(item["cat_id"]));

          // app.products = resp["data"]["data"];
          app.products = productsExceptMembership;
          app.membershipProducts = productsIncludingMembership;
          app.currency = resp['data']['currency']['symbol'];
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