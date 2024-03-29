// Usage: https://github.com/Grsmto/simplebar
import SimpleBar from "simplebar";

const initialize = () => {
    initializeSimplebar();
    initializeSidebarCollapse();
};

const initializeSimplebar = () => {
    const simplebarElement = document.getElementsByClassName("js-simplebar")[0];

    if (simplebarElement) {
        const simplebarInstance = new SimpleBar(
            document.getElementsByClassName("js-simplebar")[0]
        );

        /* Recalculate simplebar on sidebar dropdown toggle */
        const sidebarDropdowns = document.querySelectorAll(
            ".js-sidebar [data-bs-parent]"
        );

        sidebarDropdowns.forEach((link) => {
            link.addEventListener("shown.bs.collapse", () => {
                simplebarInstance.recalculate();
            });
            link.addEventListener("hidden.bs.collapse", () => {
                simplebarInstance.recalculate();
            });
        });
    }
};

const initializeSidebarCollapse = () => {
    const sidebarElement = document.getElementsByClassName("js-sidebar")[0];
    const sidebarToggleElement =
        document.getElementsByClassName("js-sidebar-toggle")[0];

    if (sidebarElement && sidebarToggleElement) {
        sidebarToggleElement.addEventListener("click", () => {
            sidebarElement.classList.toggle("collapsed");

            sidebarElement.addEventListener("transitionend", () => {
                window.dispatchEvent(new Event("resize"));
            });
        });
    }
};

const dropdownLinks = document.querySelectorAll(".sidebar-dropdown a");
dropdownLinks.forEach(function (link) {
    link.addEventListener("click", function () {
        var parentLi = this.parentElement;
        var dropdown = parentLi.querySelector(".collapse");

        if (dropdown) {
            dropdown.classList.toggle("show");

            dropdownLinks.forEach(function (otherLink) {
                if (otherLink !== link) {
                    var otherParentLi = otherLink.parentElement;
                    var otherDropdown =
                        otherParentLi.querySelector(".collapse");
                    if (otherDropdown) {
                        otherDropdown.classList.remove("show");
                    }
                }
            });
        }
    });
});

// Wait until page is loaded
document.addEventListener("DOMContentLoaded", () => initialize());
