import axios from "axios";

(function () {
"use strict";

BASEOBJECT.product.init = function () {
  const app = new Vue({
    el: "#product",
    data: {
      product: {},
      currency: '',
      isFirstLoading: true,
      isLoading: false,
      inCart: ""
    },
    methods: {
      getProduct() {
        const tokenEl = document.querySelector(".custom-token");
        const token = tokenEl.dataset.token;
        axios.post(`${themeUrl}/inc/app/Routes/Product.php`, JSON.stringify(
          { slug: productSlug, token: token } )).then (function(resp){
          if(resp.data.fail) {
            window.location.href = "./";
          } else {
            app.product = resp['data']['data'];
            app.currency = resp['data']['currency']['symbol'];
            app.isFirstLoading = false;
          }
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
      this.getProduct();
    }
  })
}

})();