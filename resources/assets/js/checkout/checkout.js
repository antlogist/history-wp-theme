import axios from "axios";

(function () {
"use strict";

BASEOBJECT.checkout.init = function () {
  const app = new Vue({
    el: "#checkout",
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
          console.log(response);
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
    },
    created: function(){
      this.displayItems();
    }
  });
}
})();