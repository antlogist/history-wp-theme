(function () {
  "use strict";

  BASEOBJECT.module.messageRemove();
  BASEOBJECT.nav.init();
  BASEOBJECT.nav.initFooter();
  BASEOBJECT.nav.toggleButton();
//  BASEOBJECT.buttons.init();

  const body = document.body;
  switch (body.id) {
    case "newsletterPage":
      if(currentPdf !== false && isMobile) {
        BASEOBJECT.pdf.init();
      }
    break;
    case "willPage":
      if(currentPdf !== false && isMobile) {
        BASEOBJECT.pdf.init();
      }
    break;
    case "historyPage":
      if(currentPdf !== false && isMobile) {
        BASEOBJECT.pdf.init();
      }
    break;
    case "photoarchivePage":
      if(singleGallery !== false) {
        BASEOBJECT.gallery.init();
      }
      break;
    case "profilePage":
      BASEOBJECT.profile.copyBillingDetails();
      break;
    case "shopPage":
      BASEOBJECT.shop.shopProducts();
      break;
    case "productPage":
      BASEOBJECT.product.init();
      break;
    case "cartPage":
      BASEOBJECT.cart.cart();
      break;
    case "checkoutPage":
      BASEOBJECT.checkout.init();
      BASEOBJECT.profile.copyBillingDetails();
      break;
    case "ordersPage":
      BASEOBJECT.ordersView.actions();
      break;
  }

})();