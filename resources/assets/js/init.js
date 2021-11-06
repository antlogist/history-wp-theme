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
      if(currentPdf !== false) {
        BASEOBJECT.pdf.init();
      }
    break;
    case "photoarchivePage":
      if(singleGallery !== false) {
        BASEOBJECT.gallery.init();
      }
  }

})();