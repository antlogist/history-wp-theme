jQuery(function($){
  $('body').on('click', '.upload_pdf_button', function(e){
      e.preventDefault();
      pdf_uploader = wp.media({
          title: 'PDF',
          button: {
              text: 'Use this PDF'
          },
          library: {
            type: ['application/pdf']
          }
      }).on('select', function() {
          var attachment = pdf_uploader.state().get('selection').first().toJSON();
          $('#custom_pdf').val(attachment.url);

          renderPdf(attachment.url);
      })
      .open();
  });
});

function renderPdf(url) {
  const pdfViewer = document.querySelector("#pdfViewer");
  pdfViewer.data = url;
  console.log(url);
}
