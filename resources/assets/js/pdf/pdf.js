(function(){
  "use strict";

  BASEOBJECT.pdf.init = function() {

    const url = currentPdf;

    const pdfjsLib = window['pdfjs-dist/build/pdf'];

    pdfjsLib.GlobalWorkerOptions.workerSrc = `${themeUrl}/dist/js/pdf-legacy/pdf.worker.js`;

    let pdfDoc = null;
    let pageNum = 1;
    let pageRendering = false;
    let pageNumPending = null;
    let scale = 0.8;
    const canvas = document.getElementById('pdf-canvas');
    const ctx = canvas.getContext('2d');

    function renderPage(num) {
      pageRendering = true;
      pdfDoc.getPage(num).then(function(page) {
        const viewport = page.getViewport({scale: scale});

        canvas.height = viewport.height;
        canvas.width = viewport.width;

        const renderContext = {
          canvasContext: ctx,
          viewport: viewport
        };

        const renderTask = page.render(renderContext);

        renderTask.promise.then(function() {
          pageRendering = false;
          if (pageNumPending !== null) {

            renderPage(pageNumPending);
            pageNumPending = null;
          }
        });
      });

      document.getElementById('page_num').textContent = num;
    }

    function queueRenderPage(num) {
      if (pageRendering) {
        pageNumPending = num;
      } else {
        renderPage(num);
      }
    }

    function onPrevPage() {
      if (pageNum <= 1) {
        return;
      }
      pageNum--;
      queueRenderPage(pageNum);
    }

    document.getElementById("pdfSection").addEventListener('click', function(e) {
      const target = e.target;

      if (target.classList.contains('prev-pdf')) {
        e.preventDefault();
        onPrevPage();
      }

      if (target.classList.contains('next-pdf')) {
        e.preventDefault();
        onNextPage();
      }

    });

    function onNextPage() {
      if (pageNum >= pdfDoc.numPages) {
        return;
      }
      pageNum++;
      queueRenderPage(pageNum);
    }

    pdfjsLib.getDocument(url).promise.then(function(pdfDoc_) {
      pdfDoc = pdfDoc_;
      document.getElementById('page_count').textContent = pdfDoc.numPages;

      renderPage(pageNum);
    });
  }

})();

