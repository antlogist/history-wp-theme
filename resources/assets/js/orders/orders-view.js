import axios from "axios";

(function () {
"use strict";

BASEOBJECT.ordersView.actions = function () {
  const app = new Vue({
    el: "#ordersTable",
    data: {
    },
    methods: {
      pay(orderToken) {
        console.log(orderToken);
      },
    }
  })
}

})();