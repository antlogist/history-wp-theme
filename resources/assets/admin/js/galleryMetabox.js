jQuery(function($){
  $('body').on('click', '.upload_gallery_button', function(e){
      e.preventDefault();
      gallery_uploader = wp.media({
          title: 'Photo Archives',
          button: {
              text: 'Use this Images'
          },
          multiple: true,
          library: {
            type: ['image']
          }
      }).on('select', function() {
          const attachment = gallery_uploader.state().get('selection').toJSON();
          let attachmentVal = [];

          if(Array.isArray(attachment)) {
            attachment.map((image) => {
              const obj = {
                url: image.url,
                title: image.title,
                description: image.description
              }
              attachmentVal.push(obj);
            })
          }

          let inputVal = [];

          if ($('#custom_gallery').val()) {
            inputVal =  JSON.parse($('#custom_gallery').val());
          }

          const val = inputVal.concat(attachmentVal);

          $('#custom_gallery').val(JSON.stringify(val));

          renderPhotoArchive(val);

      }).open();
  });
});

function renderPhotoArchive(val) {

  let ul = document.querySelector("#photoArchiveUl");
  ul.innerHTML = '';

  val.map((item, index) => {
    const template = `
      <li id="photoArchiveLi${index}" aria-label="post-item" class="attachment">
        <div class="buttons-wrapper" style="margin: 0.25rem;">
          <button data-index="${index}" onclick="deletePhotoArchive(event)" class="button button-small button-delete">x</button>
        </div>
        <div class="attachment-preview type-image portrait">
          <div class="thumbnail">
            <div class="centered">
              <img src="${item.url}" alt="" draggable="false">
            </div>
          </div>
        </div>
      </li>
    `;

    ul.insertAdjacentHTML("afterbegin", template);
  });
}

function deletePhotoArchive(e) {

  e.preventDefault();
  const target = e.target;
  const index = target.dataset.index;

  const galleryInput = document.querySelector("#custom_gallery");
  const galleryInputVal = JSON.parse(galleryInput.value);
  galleryInputVal.splice(index, 1);

  galleryInput.value = JSON.stringify(galleryInputVal);

  renderPhotoArchive(galleryInputVal);

}