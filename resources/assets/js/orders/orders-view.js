import axios from "axios";

(function () {
"use strict";

BASEOBJECT.ordersView.actions = function () {
  const app = new Vue({
    el: "#ordersContainer",
    data: {
      isLoading: false
    },
    methods: {
      pay(orderToken) {
        console.log(orderToken);
      },
      cancel(orderToken) {
        this.isLoading = true;
        axios.post(`${themeUrl}/inc/app/Routes/CancelOrder.php`, JSON.stringify({
          order_token: orderToken,
          token: token,
          home_url: baseUrl
        })).then(function(resp) {

          if(resp.data.status.success === true) {
            const status = document.querySelector(`#status${orderToken}`);
            status.textContent = "canceled";

            const payButton = document.querySelector(`#payButton${orderToken}`);
            payButton.remove();

            const cancelButton = document.querySelector(`#cancelButton${orderToken}`);
            cancelButton.remove();
          }

          app.isLoading = false;
        });
      }
    }
  })
}

})();