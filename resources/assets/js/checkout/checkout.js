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
      cartTotalShipping: 0,
      cartTotalVat: 0,
      vat: 0,
      fail: false,
      authenticated: false,
      isFirstLoading: true,
      isProductsLoading: true,
      isShippingLoading: true,
      isLoading: true,
      shippingTypes: []
    },
    methods: {
      displayItems() {
        this.isLoading = true;
        this.isProductsLoading = true;
        this.isShippingLoading = true;

        const shippingCountry = document.querySelector("#shippingCountry").value;
        const shippingZipcode = document.querySelector("#shippingZipcode").value;


        function getCartItems() {
          return axios.get(`${themeUrl}/inc/app/Routes/GetCartItems.php`).then (function(response){
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
            app.isProductsLoading = false;
          });
        }

        function getShippingTypes() {
          return axios.post(`${themeUrl}/inc/app/Routes/GetShippingType.php`, JSON.stringify(
            {
              "country": shippingCountry,
              "post_code": shippingZipcode,
              "items": app.items
            }
          )).then(function(resp) {
            app.shippingTypes = resp.data;
            app.isShippingLoading = false;
          });
        }

        const display = async() => {
          await getCartItems();
          await getShippingTypes();

          app.isFirstLoading = false;
          app.isLoading = false;
          console.log(app.shippingTypes);
        }

        display();

      },
      updateShipping(shipping) {
        this.isLoading = true;

        axios.post(`${themeUrl}/inc/app/Routes/UpdateShippingType.php`, JSON.stringify({
          shipping_type: shipping.type_id,
          shipping_code: shipping.code,
          shipping_price: shipping.price,
          shipping_name: shipping.name,
        })).then(function(resp) {
          console.log(resp);
          app.cartTotalShipping = resp["data"];
          app.isLoading = false;
        });

      },
      placeOrder() {

        this.isLoading = true;

        const data = {};

        const profileForm = document.querySelector("#profileInfo").elements;
        [...profileForm].map((item) => {
          data[item.name] = item.value;
        });

        // data.checkboxes = [];
        // const checkboxItems = document.querySelector("#checkboxesForm").elements;
        // [...checkboxItems].map(({name, value}) => {
        //   data.checkboxes.push({
        //     [name]: value
        //   })
        // });

        axios.post(`${themeUrl}/inc/app/Routes/Checkout.php`, JSON.stringify(
          data
        )).then(function(resp) {
          console.log(resp);
          app.isLoading = false;
        });

      }
    },
    created: function(){
      this.displayItems();
    },
    mounted() {
      const shippingCountry = document.querySelector("#shippingCountry");
      const shippingZipcode = document.querySelector("#shippingZipcode");
      const shippingTypes = document.querySelector("#shippingTypes");

      shippingCountry.addEventListener("change", function(e) {
        app.displayItems();
      });

      shippingZipcode.addEventListener("change", function(e) {
        app.displayItems();
      });

      shippingTypes.addEventListener("click", function(e) {
        const target = e.target;
        if(target.classList.contains("form-check-input")) {
          const shipping_id = target.value;
          // console.log(app.shippingTypes);
          app.shippingTypes.map((shipping)=>{
            if(shipping.type_id == shipping_id) {
              app.updateShipping(shipping);
            }
          })
        }
      })

    }
  });
}
})();