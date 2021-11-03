/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./resources/assets/js/Classes/Request.js":
/*!************************************************!*\
  !*** ./resources/assets/js/Classes/Request.js ***!
  \************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* binding */ Request)
/* harmony export */ });
function _slicedToArray(arr, i) { return _arrayWithHoles(arr) || _iterableToArrayLimit(arr, i) || _unsupportedIterableToArray(arr, i) || _nonIterableRest(); }

function _nonIterableRest() { throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }

function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }

function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }

function _iterableToArrayLimit(arr, i) { var _i = arr == null ? null : typeof Symbol !== "undefined" && arr[Symbol.iterator] || arr["@@iterator"]; if (_i == null) return; var _arr = []; var _n = true; var _d = false; var _s, _e; try { for (_i = _i.call(arr); !(_n = (_s = _i.next()).done); _n = true) { _arr.push(_s.value); if (i && _arr.length === i) break; } } catch (err) { _d = true; _e = err; } finally { try { if (!_n && _i["return"] != null) _i["return"](); } finally { if (_d) throw _e; } } return _arr; }

function _arrayWithHoles(arr) { if (Array.isArray(arr)) return arr; }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }

var Request = /*#__PURE__*/function () {
  function Request() {
    _classCallCheck(this, Request);
  }

  _createClass(Request, [{
    key: "get",
    value: //Get
    function get(url, cb) {
      try {
        // xhr object
        var xhr = new XMLHttpRequest(); // xhr open

        xhr.open("GET", url); // xhr load

        xhr.addEventListener("load", function () {
          if (Math.floor(xhr.status / 100) !== 2) {
            cb("Error. Status code ".concat(xhr.status), xhr);
            return;
          } // parse


          var response = JSON.parse(xhr.responseText); // callback

          cb(null, response);
        }); // xhr error

        xhr.addEventListener("error", function () {
          console.log("error");
        }); // xhr send

        xhr.send();
      } catch (error) {
        console.log(error);
      }
    } //Post

  }, {
    key: "post",
    value: function post(url, body, headers, cb) {
      // xhr object
      var xhr = new XMLHttpRequest(); // xhr open

      xhr.open("POST", url); // headers

      if (headers) {
        Object.entries(headers).map(function (_ref) {
          var _ref2 = _slicedToArray(_ref, 2),
              key = _ref2[0],
              value = _ref2[1];

          xhr.setRequestHeader(key, value);
        });
      } // xhr load


      xhr.addEventListener("load", function () {
        if (Math.floor(xhr.status / 100) !== 2) {
          cb("Error. Status code ".concat(xhr.status), xhr);
          return;
        } // parse


        var response = JSON.parse(xhr.responseText); // callback

        cb(null, response);
      }); // xhr error

      xhr.addEventListener("error", function () {
        console.log("error");
      }); // xhr send
      //    console.log(JSON.stringify(body));
      //    xhr.send(JSON.stringify(body));

      xhr.send(body);
    }
  }]);

  return Request;
}();



/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/define property getters */
/******/ 	(() => {
/******/ 		// define getter functions for harmony exports
/******/ 		__webpack_require__.d = (exports, definition) => {
/******/ 			for(var key in definition) {
/******/ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 				}
/******/ 			}
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/************************************************************************/
var __webpack_exports__ = {};
// This entry need to be wrapped in an IIFE because it need to be isolated against other entry modules.
(() => {
/*!*******************************************!*\
  !*** ./resources/assets/js/baseObject.js ***!
  \*******************************************/
(function () {
  "use strict";

  window.BASEOBJECT = {
    nav: {},
    pdf: {}
  };
})();
})();

// This entry need to be wrapped in an IIFE because it need to be in strict mode.
(() => {
"use strict";
var __webpack_exports__ = {};
/*!****************************************!*\
  !*** ./resources/assets/js/nav/nav.js ***!
  \****************************************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _Classes_Request_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../Classes/Request.js */ "./resources/assets/js/Classes/Request.js");
function _toConsumableArray(arr) { return _arrayWithoutHoles(arr) || _iterableToArray(arr) || _unsupportedIterableToArray(arr) || _nonIterableSpread(); }

function _nonIterableSpread() { throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }

function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }

function _iterableToArray(iter) { if (typeof Symbol !== "undefined" && iter[Symbol.iterator] != null || iter["@@iterator"] != null) return Array.from(iter); }

function _arrayWithoutHoles(arr) { if (Array.isArray(arr)) return _arrayLikeToArray(arr); }

function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }



(function () {
  "use strict";

  BASEOBJECT.nav.initFooter = function () {
    var footerMenuEl = document.querySelector("#footerMenu");
    var request = new _Classes_Request_js__WEBPACK_IMPORTED_MODULE_0__["default"]();
    request.get("".concat(baseUrl, "/wp-json/menus/v1/footer-menu"), function (err, resp) {
      if (err) {
        console.log(err);
        return;
      }

      var length = resp.length;
      resp.map(function (item, index) {
        var navItem = "<a href=\"".concat(item.url, "\">").concat(item.title, "</a> ").concat(index !== length - 1 ? " | " : "");
        footerMenuEl.insertAdjacentHTML("beforeEnd", navItem);
      });
    });
  };

  BASEOBJECT.nav.init = function () {
    var navMainWrapper = document.getElementById("navMainWrapper");
    var request = new _Classes_Request_js__WEBPACK_IMPORTED_MODULE_0__["default"]();
    request.get("".concat(baseUrl, "/wp-json/menus/v1/menu"), function (err, resp) {
      if (err) {
        console.log(err);
        return;
      }

      var currentLocation = window.location.href;
      var ul = document.createElement("ul");
      ul.classList.add("nav-ul-main");
      ul.id = "navMainUl";
      var children = {};
      resp.map(function (item) {
        if (!parseInt(item.menu_item_parent)) {
          var navItem = "\n            <li data-id=\"".concat(item.ID, "\" class=\"li-nav\">\n              <a href=\"").concat(item.url, "\" data-id=\"").concat(item.ID, "\" class=\"").concat(currentLocation === item.url ? "current " : '', "nav-link text-uppercase\">").concat(item.title, "</a>\n            </li>\n          ");
          ul.insertAdjacentHTML("beforeEnd", navItem);
        } else {
          children[item.menu_item_parent] ? "" : children[item.menu_item_parent] = [];
          children[item.menu_item_parent].push({
            id: item.ID,
            parentId: item.menu_item_parent,
            url: item.url,
            title: item.title
          });
        }
      });
      navMainWrapper.insertAdjacentElement("afterBegin", ul); //Remove opacity from wrapper

      navMainWrapper.classList.remove("opacity-0");
      navMainWrapper.classList.add("opacity-100");

      if (Object.keys(children).length !== 0) {
        var lis = document.getElementsByClassName("li-nav");

        _toConsumableArray(lis).map(function (li) {
          var id = li.dataset.id;

          for (var child in children) {
            if (child === id) {
              li.classList.add("parent");
              var a = li.children;
              a[0].classList.add("parent-link");
              submenuRender(li);
            }
          }
        });
      } //Submenu template


      function submenuRender(el) {
        var fragment = document.createDocumentFragment();
        var ul = document.createElement("ul");
        ul.classList.add("ul-nav-child");
        ul.dataset.id = el.dataset.id;
        children[el.dataset.id].map(function (item) {
          var navItemChild = "\n          <li data-id=\"".concat(item.id, "\" class=\"li-nav-child\">\n            <a href=\"").concat(item.url, "\" class=\"").concat(currentLocation === item.url ? "current " : '', "text-uppercase\">").concat(item.title, "</a>\n          </li>\n        ");
          ul.insertAdjacentHTML("beforeEnd", navItemChild);
        });
        fragment.appendChild(ul);
        el.appendChild(fragment);
      }
    });
    navMainWrapper.addEventListener("click", function (e) {
      var el = e.target;
      var submenus = document.querySelectorAll(".ul-nav-child");

      _toConsumableArray(submenus).map(function (submenu) {
        if (submenu.dataset.id !== el.dataset.id) {
          submenu.classList.remove("show");
        }
      }); //Parent link click


      if (el.classList.contains("parent-link")) {
        e.preventDefault();
        var submenu = el.nextElementSibling;

        switch (submenu.classList.contains("show")) {
          case false:
            submenu.classList.add("show");
            break;

          default:
            submenu.classList.remove("show");
        }
      }
    });
  };

  BASEOBJECT.nav.toggleButton = function () {
    var button = document.getElementById("navToggleButton");
    var navMain = document.getElementById("navMainWrapper");
    var body = document.body;
    var request = new _Classes_Request_js__WEBPACK_IMPORTED_MODULE_0__["default"]();
    button.addEventListener("click", function (e) {
      e.preventDefault();

      switch (navMain.classList.contains("active")) {
        case true:
          navMain.classList.remove("active");
          button.classList.remove("active");
          body.classList.remove("active");
          break;

        default:
          navMain.classList.add("active");
          button.classList.add("active");
          body.classList.add("active");
      }
    });
  };
})();
})();

// This entry need to be wrapped in an IIFE because it need to be isolated against other entry modules.
(() => {
/*!****************************************!*\
  !*** ./resources/assets/js/pdf/pdf.js ***!
  \****************************************/
(function () {
  "use strict";

  BASEOBJECT.pdf.init = function () {
    var url = currentPdf;
    var pdfjsLib = window['pdfjs-dist/build/pdf'];
    pdfjsLib.GlobalWorkerOptions.workerSrc = "".concat(themeUrl, "/dist/js/pdf-legacy/pdf.worker.js");
    var pdfDoc = null;
    var pageNum = 1;
    var pageRendering = false;
    var pageNumPending = null;
    var scale = 0.8;
    var canvas = document.getElementById('pdf-canvas');
    var ctx = canvas.getContext('2d');

    function renderPage(num) {
      pageRendering = true;
      pdfDoc.getPage(num).then(function (page) {
        var viewport = page.getViewport({
          scale: scale
        });
        canvas.height = viewport.height;
        canvas.width = viewport.width;
        var renderContext = {
          canvasContext: ctx,
          viewport: viewport
        };
        var renderTask = page.render(renderContext);
        renderTask.promise.then(function () {
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

    document.getElementById("pdfSection").addEventListener('click', function (e) {
      var target = e.target;

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

    pdfjsLib.getDocument(url).promise.then(function (pdfDoc_) {
      pdfDoc = pdfDoc_;
      document.getElementById('page_count').textContent = pdfDoc.numPages;
      renderPage(pageNum);
    });
  };
})();
})();

// This entry need to be wrapped in an IIFE because it need to be isolated against other entry modules.
(() => {
/*!*************************************!*\
  !*** ./resources/assets/js/init.js ***!
  \*************************************/
(function () {
  "use strict";

  BASEOBJECT.nav.init();
  BASEOBJECT.nav.initFooter();
  BASEOBJECT.nav.toggleButton(); //  BASEOBJECT.buttons.init();

  var body = document.body;

  switch (body.id) {
    case "frontPage":
      BASEOBJECT.pdf.init();
  }
})();
})();

/******/ })()
;