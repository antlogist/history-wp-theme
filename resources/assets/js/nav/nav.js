import Request from "../Classes/Request.js";

(function () {
  "use strict";

  BASEOBJECT.nav.initFooter = function () {
    const footerMenuEl = document.querySelector("#footerMenu");
    const request = new Request();

    request.get(`${baseUrl}/wp-json/menus/v1/footer-menu`, (err, resp) => {
      if (err) {
        console.log(err);
        return;
      }

      const length = resp.length;

      resp.map((item, index) => {
        const navItem = `<a href="${item.url}">${item.title}</a> ${index !== length - 1 ? " | " : ""}`;
        footerMenuEl.insertAdjacentHTML("beforeEnd", navItem);
      });
    });
  }

  BASEOBJECT.nav.init = function () {
    const navMain = document.getElementById("navMain");
    const searchLink = `${baseUrl}?s=`;

    const searchNav = `
    <li class="li-nav" id="searchNav">
      <a href="${searchLink}" class="nav-link text-uppercase">
        <span class="dashicons dashicons-search"></span>
      </a>
    </li>
  `;

    navMain.insertAdjacentHTML("beforeEnd", searchNav);

    const navMainWrapper = document.getElementById("navMainWrapper");
    const request = new Request();

    request.get(`${baseUrl}/wp-json/menus/v1/menu`, (err, resp) => {
      if (err) {
        console.log(err);
        return;
      }

      const currentLocation = window.location.href;

      const ul = document.createElement("ul");
      ul.classList.add("nav-ul-main");
      ul.id = "navMainUl";


      const searchNavItem = `
        <li class="li-nav" id="searchLiNav">
          <a href="${searchLink}" class="nav-link text-uppercase">
            <span class="dashicons dashicons-search"></span>
          </a>
        </li>
      `;

      ul.insertAdjacentHTML("beforeEnd", searchNavItem);

      const children = {};

      resp.map((item) => {

        if (!parseInt(item.menu_item_parent)) {
          const navItem = `
            <li data-id="${item.ID}" class="li-nav">
              <a href="${item.url}" data-id="${item.ID}" class="${currentLocation === item.url ? "current " : ''}nav-link text-uppercase">${item.title}</a>
            </li>
          `;
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
      })

      navMainWrapper.insertAdjacentElement("afterBegin", ul);

      //Remove opacity from wrapper
      navMainWrapper.classList.remove("opacity-0");
      navMainWrapper.classList.add("opacity-100");

      if (Object.keys(children).length !== 0) {
        const lis = document.getElementsByClassName("li-nav");

        [...lis].map((li) => {
          const id = li.dataset.id;
          for (const child in children) {
            if (child === id) {
              li.classList.add("parent");
              const a = li.children;
              a[0].classList.add("parent-link");
              submenuRender(li);
            }
          }
        })
      }

      //Submenu template
      function submenuRender(el) {
        const fragment = document.createDocumentFragment();
        const ul = document.createElement("ul");
        ul.classList.add("ul-nav-child");
        ul.dataset.id = el.dataset.id

        children[el.dataset.id].map((item) => {
          const navItemChild = `
          <li data-id="${item.id}" class="li-nav-child">
            <a href="${item.url}" class="${currentLocation === item.url ? "current " : ''}text-uppercase">${item.title}</a>
          </li>
        `;
          ul.insertAdjacentHTML("beforeEnd", navItemChild);
        })
        fragment.appendChild(ul);
        el.appendChild(fragment);
      }
    });


    navMainWrapper.addEventListener("click", function (e) {
      const el = e.target;

      const submenus = document.querySelectorAll(".ul-nav-child");
      [...submenus].map((submenu) => {
        if (submenu.dataset.id !== el.dataset.id) {
          submenu.classList.remove("show");
        }
      })

      //Parent link click
      if (el.classList.contains("parent-link")) {
        e.preventDefault();
        const submenu = el.nextElementSibling;
        switch (submenu.classList.contains("show")) {
          case false:
            submenu.classList.add("show");
            break;
          default:
            submenu.classList.remove("show");
        }
      }
    });

  }

  BASEOBJECT.nav.toggleButton = function () {
    const button = document.getElementById("navToggleButton");
    const navMain = document.getElementById("navMainWrapper");
    const body = document.body;
    const request = new Request();

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
  }
})();