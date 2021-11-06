(function(){
  "use strict";

  BASEOBJECT.gallery.init = function() {
    const body = document.querySelector("#photoarchivePage");
    const modal = document.querySelector(".archive-gallery-modal");
    const wrapper = document.querySelector(".gallery-outer-wrapper");
    const imgContainer = document.querySelector(".archive-gallery-img-container");
    wrapper.addEventListener("click", function(e) {
      e.preventDefault();
      const target = e.target;
      if(target.classList.contains("archive-gallery-img")) {
        if(modal.classList.contains("active")) {
          return;
        }

        imgContainer.innerHTML = "";
        const imgUrl = target.dataset.url;
        const htmlEl = `<div class="modal-img-outer-wrapper"><img class="w-100" src="${imgUrl}"></div>`;
        imgContainer.insertAdjacentHTML("afterbegin", htmlEl);

        body.classList.add("active");
        modal.classList.add("active");
      }

      if(target.classList.contains("close-modal-button")) {
        body.classList.remove("active");
        modal.classList.remove("active");
      }
    })
  }

})();