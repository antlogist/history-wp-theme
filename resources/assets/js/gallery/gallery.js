(function(){
  "use strict";

  BASEOBJECT.gallery.init = function() {
    const body = document.querySelector("#photoarchivePage");
    const modal = document.querySelector(".archive-gallery-modal");
    const wrapper = document.querySelector(".gallery-outer-wrapper");
    const imgContainer = document.querySelector(".archive-gallery-img-container");
    const imgAll = wrapper.querySelectorAll("img");

    const imgArr = [];

    [...imgAll].map((item) => {
      const url = item.dataset.url;
      imgArr.push(url);
    });

    const imgArrLength = imgArr.length;

    let currImgIndex;

    wrapper.addEventListener("click", function(e) {
      e.preventDefault();
      const target = e.target;
      const currentTarget = e.currentTarget;
      if(target.classList.contains("archive-gallery-img")) {
        if(modal.classList.contains("active")) {
          return;
        }

        imgContainer.innerHTML = "";
        const imgUrl = target.dataset.url;
        const imgIndex = target.dataset.index;

        currImgIndex = imgIndex;

        const htmlEl = `<div class="modal-img-outer-wrapper"><img class="w-100 modal-img" src="${imgUrl}"></div>`;
        imgContainer.insertAdjacentHTML("afterbegin", htmlEl);

        body.classList.add("active");
        modal.classList.add("active");
      }

      if(target.classList.contains("close-modal-button")) {
        body.classList.remove("active");
        modal.classList.remove("active");
      }

      const modalImgEl = document.querySelector(".modal-img");

      //Left
      if(target.classList.contains("left-button") || target.parentElement.classList.contains("left-button")) {

        if (currImgIndex == 0 ) {
          currImgIndex = imgArrLength;
        }

        modalImgEl.src = imgArr[--currImgIndex];
      }

      //Right
      if(target.classList.contains("right-button") || target.parentElement.classList.contains("right-button")) {

        if (currImgIndex == imgArrLength - 1 ) {
          currImgIndex = -1;
        }

        modalImgEl.src = imgArr[++currImgIndex];
      }

    });


    document.onkeydown = checkKey;

    function checkKey(e) {

        e = e || window.event;

        const modalImgEl = document.querySelector(".modal-img");

        if(imgArrLength < 2) {
          return;
        }

        //left arrow
        if (e.keyCode == "37") {
          if (currImgIndex == 0 ) {
            currImgIndex = imgArrLength;
          }
          modalImgEl.src = imgArr[--currImgIndex];
        }
        //right arrow
        else if (e.keyCode == "39") {
          if (currImgIndex == imgArrLength - 1 ) {
            currImgIndex = -1;
          }

          modalImgEl.src = imgArr[++currImgIndex];
        }
    }
  }

})();