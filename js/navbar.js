import { pollSelectedQuery } from "./utils/find.js";
let navbarRef, elementToWatch;

window.onload = () => {
    pollSelectedQuery("._navbar", () => {
        navbarRef = document.querySelector("._navbar");
    })
}


window.onscroll = () => {
    if (!elementToWatch) return;
    if (isInViewport(elementToWatch)) {
        setNavbarInvisible();
    } else {
        setNavbarVisible();
    }
}

export function setNavbarInvisible() {

    pollSelectedQuery("._navbar", () => {
        if (navbarRef.classList.contains("__navbar-hide-bg")) return;

        navbarRef.classList.remove("__navbar-show-bg");
        navbarRef.classList.remove("__navbar-text-dark-bg");
        navbarRef.classList.add("__navbar-text-light-bg");
        navbarRef.classList.add("__navbar-hide-bg");
    });
}

export function setNavbarVisible() {
    pollSelectedQuery("._navbar", () => {
        if (navbarRef.classList.contains("__navbar-show-bg")) return;

        navbarRef.classList.remove("__navbar-hide-bg");
        navbarRef.classList.remove("__navbar-text-light-bg");
        navbarRef.classList.add("__navbar-text-dark-bg");
        navbarRef.classList.add("__navbar-show-bg");
    })
}

export function setNavbarSticky() {
    pollSelectedQuery("._navbar", () => {
        navbarRef.classList.add("__navbar-stick");
    })
}

export function watchElement(element) {
    pollSelectedQuery(element, () => {
        elementToWatch = document.querySelector(element);
    })
}



function isInViewport(element) {
    if (!element) return;
    const rect = element.getBoundingClientRect();
    return (
        rect.top >= 0 &&
        rect.left >= 0 &&
        rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
        rect.right <= (window.innerWidth || document.documentElement.clientWidth)
    );
}


