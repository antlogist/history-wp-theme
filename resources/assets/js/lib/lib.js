import axios from "axios";
import Cart from "../Classes/Cart";

const cart = new Cart();


(function(){
  "use strict";
  BASEOBJECT.module = {
    addItemToCart: function(id, title, qty, price, vat_price, vat_percent) {
      const tokenEl = document.querySelector(".custom-token");
      const token = tokenEl.dataset.token;
      const url = `${themeUrl}/inc/app/Routes/ShopAddItem.php`;
      axios.post(url, JSON.stringify({
        product_id: id,
        title: title,
        qty: qty,
        price: price,
        vat_price: vat_price,
        vat_percent: vat_percent,
        token: token,
        homeUrl: baseUrl,
        })).then(function(response){
          if(response.data.fail) {
            window.location.reload();
          } else {
            cart.updateHeaderCart(response.data.countItems);
          }
        });
    }
  }
})();