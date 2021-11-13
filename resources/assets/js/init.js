(function () {
  "use strict";

  BASEOBJECT.nav.init();
  BASEOBJECT.nav.initFooter();
  BASEOBJECT.nav.toggleButton();
//  BASEOBJECT.buttons.init();

  const body = document.body;
  switch (body.id) {
    case "frontPage":
      BASEOBJECT.pdf.init();
    break;
    case "newsletterPage":
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
  }

})();