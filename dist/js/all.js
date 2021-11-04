(()=>{var t,e={323:()=>{!function(){"use strict";window.BASEOBJECT={nav:{},pdf:{}}}()},627:()=>{!function(){"use strict";switch(BASEOBJECT.nav.init(),BASEOBJECT.nav.initFooter(),BASEOBJECT.nav.toggleButton(),document.body.id){case"frontPage":BASEOBJECT.pdf.init();break;case"newsletterPage":!1!==currentPdf&&BASEOBJECT.pdf.init()}}()},410:()=>{"use strict";function t(t,n){return function(t){if(Array.isArray(t))return t}(t)||function(t,e){var n=null==t?null:"undefined"!=typeof Symbol&&t[Symbol.iterator]||t["@@iterator"];if(null==n)return;var r,a,o=[],i=!0,c=!1;try{for(n=n.call(t);!(i=(r=n.next()).done)&&(o.push(r.value),!e||o.length!==e);i=!0);}catch(t){c=!0,a=t}finally{try{i||null==n.return||n.return()}finally{if(c)throw a}}return o}(t,n)||function(t,n){if(!t)return;if("string"==typeof t)return e(t,n);var r=Object.prototype.toString.call(t).slice(8,-1);"Object"===r&&t.constructor&&(r=t.constructor.name);if("Map"===r||"Set"===r)return Array.from(t);if("Arguments"===r||/^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(r))return e(t,n)}(t,n)||function(){throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")}()}function e(t,e){(null==e||e>t.length)&&(e=t.length);for(var n=0,r=new Array(e);n<e;n++)r[n]=t[n];return r}function n(t,e){for(var n=0;n<e.length;n++){var r=e[n];r.enumerable=r.enumerable||!1,r.configurable=!0,"value"in r&&(r.writable=!0),Object.defineProperty(t,r.key,r)}}var r=function(){function e(){!function(t,e){if(!(t instanceof e))throw new TypeError("Cannot call a class as a function")}(this,e)}var r,a,o;return r=e,(a=[{key:"get",value:function(t,e){try{var n=new XMLHttpRequest;n.open("GET",t),n.addEventListener("load",(function(){if(2===Math.floor(n.status/100)){var t=JSON.parse(n.responseText);e(null,t)}else e("Error. Status code ".concat(n.status),n)})),n.addEventListener("error",(function(){console.log("error")})),n.send()}catch(t){console.log(t)}}},{key:"post",value:function(e,n,r,a){var o=new XMLHttpRequest;o.open("POST",e),r&&Object.entries(r).map((function(e){var n=t(e,2),r=n[0],a=n[1];o.setRequestHeader(r,a)})),o.addEventListener("load",(function(){if(2===Math.floor(o.status/100)){var t=JSON.parse(o.responseText);a(null,t)}else a("Error. Status code ".concat(o.status),o)})),o.addEventListener("error",(function(){console.log("error")})),o.send(n)}}])&&n(r.prototype,a),o&&n(r,o),e}();function a(t){return function(t){if(Array.isArray(t))return o(t)}(t)||function(t){if("undefined"!=typeof Symbol&&null!=t[Symbol.iterator]||null!=t["@@iterator"])return Array.from(t)}(t)||function(t,e){if(!t)return;if("string"==typeof t)return o(t,e);var n=Object.prototype.toString.call(t).slice(8,-1);"Object"===n&&t.constructor&&(n=t.constructor.name);if("Map"===n||"Set"===n)return Array.from(t);if("Arguments"===n||/^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n))return o(t,e)}(t)||function(){throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")}()}function o(t,e){(null==e||e>t.length)&&(e=t.length);for(var n=0,r=new Array(e);n<e;n++)r[n]=t[n];return r}BASEOBJECT.nav.initFooter=function(){var t=document.querySelector("#footerMenu");(new r).get("".concat(baseUrl,"/wp-json/menus/v1/footer-menu"),(function(e,n){if(e)console.log(e);else{var r=n.length;n.map((function(e,n){var a='<a href="'.concat(e.url,'">').concat(e.title,"</a> ").concat(n!==r-1?" | ":"");t.insertAdjacentHTML("beforeEnd",a)}))}}))},BASEOBJECT.nav.init=function(){var t=document.getElementById("navMainWrapper");(new r).get("".concat(baseUrl,"/wp-json/menus/v1/menu"),(function(e,n){if(e)console.log(e);else{var r=window.location.href,o=document.createElement("ul");o.classList.add("nav-ul-main"),o.id="navMainUl";var i={};n.map((function(t){if(parseInt(t.menu_item_parent))!i[t.menu_item_parent]&&(i[t.menu_item_parent]=[]),i[t.menu_item_parent].push({id:t.ID,parentId:t.menu_item_parent,url:t.url,title:t.title});else{var e='\n            <li data-id="'.concat(t.ID,'" class="li-nav">\n              <a href="').concat(t.url,'" data-id="').concat(t.ID,'" class="').concat(r===t.url?"current ":"",'nav-link text-uppercase">').concat(t.title,"</a>\n            </li>\n          ");o.insertAdjacentHTML("beforeEnd",e)}})),t.insertAdjacentElement("afterBegin",o),t.classList.remove("opacity-0"),t.classList.add("opacity-100"),0!==Object.keys(i).length&&a(document.getElementsByClassName("li-nav")).map((function(t){var e=t.dataset.id;for(var n in i)n===e&&(t.classList.add("parent"),t.children[0].classList.add("parent-link"),c(t))}))}function c(t){var e=document.createDocumentFragment(),n=document.createElement("ul");n.classList.add("ul-nav-child"),n.dataset.id=t.dataset.id,i[t.dataset.id].map((function(t){var e='\n          <li data-id="'.concat(t.id,'" class="li-nav-child">\n            <a href="').concat(t.url,'" class="').concat(r===t.url?"current ":"",'text-uppercase">').concat(t.title,"</a>\n          </li>\n        ");n.insertAdjacentHTML("beforeEnd",e)})),e.appendChild(n),t.appendChild(e)}})),t.addEventListener("click",(function(t){var e=t.target;if(a(document.querySelectorAll(".ul-nav-child")).map((function(t){t.dataset.id!==e.dataset.id&&t.classList.remove("show")})),e.classList.contains("parent-link")){t.preventDefault();var n=e.nextElementSibling;!1===n.classList.contains("show")?n.classList.add("show"):n.classList.remove("show")}}))},BASEOBJECT.nav.toggleButton=function(){var t=document.getElementById("navToggleButton"),e=document.getElementById("navMainWrapper"),n=document.body;new r,t.addEventListener("click",(function(r){r.preventDefault(),!0===e.classList.contains("active")?(e.classList.remove("active"),t.classList.remove("active"),n.classList.remove("active")):(e.classList.add("active"),t.classList.add("active"),n.classList.add("active"))}))}},695:()=>{!function(){"use strict";BASEOBJECT.pdf.init=function(){var t=currentPdf,e=window["pdfjs-dist/build/pdf"];e.GlobalWorkerOptions.workerSrc="".concat(themeUrl,"/dist/js/pdf-legacy/pdf.worker.js");var n=null,r=1,a=!1,o=null,i=document.getElementById("pdf-canvas"),c=i.getContext("2d");function s(t){a=!0,n.getPage(t).then((function(t){var e=t.getViewport({scale:.8});i.height=e.height,i.width=e.width;var n={canvasContext:c,viewport:e};t.render(n).promise.then((function(){a=!1,null!==o&&(s(o),o=null)}))})),document.getElementById("page_num").textContent=t}function l(t){a?o=t:s(t)}document.getElementById("pdfSection").addEventListener("click",(function(t){var e=t.target;e.classList.contains("prev-pdf")&&(t.preventDefault(),r<=1||l(--r)),e.classList.contains("next-pdf")&&(t.preventDefault(),function(){if(r>=n.numPages)return;l(++r)}())})),e.getDocument(t).promise.then((function(t){n=t,document.getElementById("page_count").textContent=n.numPages,s(r)}))}}()},687:()=>{}},n={};function r(t){var a=n[t];if(void 0!==a)return a.exports;var o=n[t]={exports:{}};return e[t](o,o.exports,r),o.exports}r.m=e,t=[],r.O=(e,n,a,o)=>{if(!n){var i=1/0;for(u=0;u<t.length;u++){for(var[n,a,o]=t[u],c=!0,s=0;s<n.length;s++)(!1&o||i>=o)&&Object.keys(r.O).every((t=>r.O[t](n[s])))?n.splice(s--,1):(c=!1,o<i&&(i=o));if(c){t.splice(u--,1);var l=a();void 0!==l&&(e=l)}}return e}o=o||0;for(var u=t.length;u>0&&t[u-1][2]>o;u--)t[u]=t[u-1];t[u]=[n,a,o]},r.o=(t,e)=>Object.prototype.hasOwnProperty.call(t,e),(()=>{var t={741:0,963:0};r.O.j=e=>0===t[e];var e=(e,n)=>{var a,o,[i,c,s]=n,l=0;if(i.some((e=>0!==t[e]))){for(a in c)r.o(c,a)&&(r.m[a]=c[a]);if(s)var u=s(r)}for(e&&e(n);l<i.length;l++)o=i[l],r.o(t,o)&&t[o]&&t[o][0](),t[i[l]]=0;return r.O(u)},n=self.webpackChunkhistory_society_theme=self.webpackChunkhistory_society_theme||[];n.forEach(e.bind(null,0)),n.push=e.bind(null,n.push.bind(n))})(),r.O(void 0,[963],(()=>r(323))),r.O(void 0,[963],(()=>r(410))),r.O(void 0,[963],(()=>r(695))),r.O(void 0,[963],(()=>r(627)));var a=r.O(void 0,[963],(()=>r(687)));a=r.O(a)})();