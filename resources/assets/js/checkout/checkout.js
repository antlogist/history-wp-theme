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
          app.cartTotalShipping = resp["data"];
          app.isLoading = false;
        });

      },
      placeOrder() {

        this.isLoading = true;

        let data = {};

        const profileForm = document.querySelector("#profileInfo").elements;

        let emptyFields = [];

        [...profileForm].map((item) => {
          if(!item.value && item.name !== "billing_company" && item.name !== "delivery_company") {
            const id = item.id;
            const label = document.querySelector(`label[for=${id}]`);
            label.style.color = "red";
            item.style.borderColor = "red";
            console.log(label);
            emptyFields.push("item.id");
          }
          data[item.name] = item.value;
        });


        if(emptyFields.length > 0) {
          app.isLoading = false;
          return;
        }

        //Checkboxes
        data.checkboxes = {};
        const checkboxItems = document.querySelector("#checkboxesForm").elements;
        [...checkboxItems].map(({name, value, checked}) => {
          if(checked) {
            data.checkboxes[name] = value;
          }
        });

        //Terms and conditions
        if (!data.checkboxes.Accept_terms_and_conditions) {
          const checkbox = document.querySelector(`input[name=Accept_terms_and_conditions]`);
          const id = checkbox.id;
          const label = document.querySelector(`label[for=${id}]`);
          label.style.color = "red";
          app.isLoading = false;
          return;
        }

        axios.post(`${themeUrl}/inc/app/Routes/Checkout.php`, JSON.stringify(
          data
        )).then(function(resp) {
          if(resp.data.fail) {
            app.fail = true;
            app.message = resp.data.fail;
            window.location.reload();
          }

          window.location.assign(baseUrl + '/view-order/');

          // app.isLoading = false;
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