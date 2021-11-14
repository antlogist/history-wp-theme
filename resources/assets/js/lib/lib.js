import axios from "axios";

(function(){
  "use strict";
  BASEOBJECT.module = {
    addItemToCart: function(id, title, qty) {
      const tokenEl = document.querySelector(".custom-token");
      const token = tokenEl.dataset.token;
      const url = `${themeUrl}/inc/app/Routes/ShopAddItem.php`;
      axios.post(url, JSON.stringify({
        product_id: id,
        title: title,
        qty: qty,
        token: token,
        homeUrl: baseUrl,
        })).then(function(resp){
          console.log(resp);
          window.location.reload();
        });
    }
  }
})();