(function () {
  "use strict";

  BASEOBJECT.profile.copyBillingDetails = function () {
    const body = document.querySelector("#profilePage");
    const billingEls = document.querySelectorAll(".billing-input");
    const shippingEls = document.querySelectorAll(".shipping-input");

    body.addEventListener('click', function(e) {
      const el = e.target;
      if(el.classList.contains("copy-billing")) {
        e.preventDefault();
        [...billingEls].map((input, index) => {
          shippingEls[index].value = input.value;
        })
      }

    })
  }

})();
