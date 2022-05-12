// element references
const navbar = document.querySelector("#siteNavbar");
const body = document.querySelector('body');
const siteNavigation = navbar.querySelector('#navbarNavigation');

$(document).ready(function () {
    if (navbar) {
        const handleScroll = (entries) => {
            const spotIsVisible = entries[0].isIntersecting;
            if (spotIsVisible) {
                navbar.classList.remove("navbar--fixed")
            } else {
                navbar.classList.add("navbar--fixed");
                console.log('scrollposition');
                console.log(window.scrollY);
            }
        };
        const options = {
            root: null,
            rootMargin: "0px",
            threshhold: 1.0,
        };
// initialize and start the observer.
        const observer = new IntersectionObserver(handleScroll, options);
        observer.observe(body.children[1]);

        // make the submenus open or close
        if (siteNavigation) {
            let subMenus = siteNavigation.querySelectorAll('.menu-item-has-children');
            // loop through all the nav items with submenus
            subMenus.forEach(subMenu => {
                // get the submenu trigger link
                let triggerBtn = subMenu.querySelector('a');
                // get the actual submenu
                let menu = subMenu.querySelector('ul.sub-menu');

                // trigger a click event on the trigger link
                triggerBtn.addEventListener('click', function (e) {
                    // prevent the link from performing the default action
                    e.preventDefault();

                    // for closing other open sub-menus
                    let openSubmenus = document.querySelectorAll('.sub-menu--show');
                    // go close other submenus if the are any open
                    if (openSubmenus) {
                        // loop through al open sub menus
                        openSubmenus.forEach(openSubmenu => {
                            // close any submenu that is not the current clicked open
                            if (openSubmenu !== menu) {
                                openSubmenu.classList.remove('sub-menu--show');
                            }
                        })
                    }
                    // toggle the submenu opened or closed
                    menu.classList.toggle('sub-menu--show');
                });

                // trigger an event when the mouse cursor leaves the submenu
                menu.addEventListener('mouseleave', function (e) {
                    // close the submenu on mouseleave
                    menu.classList.remove('sub-menu--show');
                })
            })
        }
    }
});