// element references
const navigationContainer = document.querySelector('.navigation');
const navbar = document.querySelector("#siteNavbar");
const body = document.querySelector('body');
const siteNavigation = navbar.querySelector('#navbarNavigation');

$(document).ready(function () {
    if (navbar) {
        const handleScroll = (entries) => {
            const spotIsVisible = entries[0].isIntersecting;
            if (spotIsVisible) {
                navigationContainer.classList.remove("navigation--fixed")
            } else {
                navigationContainer.classList.add("navigation--fixed");
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
        observer.observe(body.children[2]);

        // make the submenus open or close
        if (siteNavigation) {
            let subMenus = siteNavigation.querySelectorAll(':scope > .menu-item-has-children');
            console.log('===== THE SUB MENUS =====');
            // loop through all the nav items with submenus
            subMenus.forEach(subMenu => {
                // get the submenu trigger link
                let triggerBtn = subMenu.querySelector('a');
                // get the actual submenu
                let menu = subMenu.querySelector(':scope > ul.sub-menu');

                // trigger a click event on the trigger link
                triggerBtn.addEventListener('mouseenter', function (e) {
                    // prevent the link from performing the default action
					if(triggerBtn.getAttribute('href').includes('*') || triggerBtn.getAttribute('href').includes("#")) {
						triggerBtn.addEventListener('click', function(event) {
							event.preventDefault();
						});
					}

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

                // go check if a submenu has a second level submenu
                const subMenusLv2 = subMenu.querySelectorAll('.menu-item-has-children');
                if (subMenusLv2) {
                    console.log('===== Submenus of Submenus =====');
                    console.log(subMenusLv2);
                    subMenusLv2.forEach(subMenuLv2 => {
                        // get the submenu's menu
                        let menuLv2 = subMenuLv2.querySelector(':scope > .sub-menu');
                        // get link inside submenuLv2
                        let subMenuLv2Link = subMenuLv2.querySelector(':scope > a');
                        // subMenuLv2.style.backgroundColor = 'red';
                        subMenuLv2.addEventListener('mouseenter', (e) => {
                            if (subMenuLv2Link.getAttribute('href').includes('*') || subMenuLv2Link.getAttribute('href').includes("#")) {
                                subMenuLv2Link.addEventListener('click', function (event) {
                                    event.preventDefault();
                                });
                            }

                            // toggle the submenu opened or closed
                            console.log(menuLv2);
                            menuLv2.classList.toggle('sub-menu--show');
                        });

                        // close a submenu's submenu on mouseleave
                        subMenuLv2.addEventListener('mouseleave', (e) => {
                            console.log('======== TRIGGER THIS ON SUBMENU LV2 MOUSELEAVE ========');
                            console.log(e.target);
                            // alert('User left the level 2 submenu');
                            menuLv2.classList.remove('sub-menu--show');
                        })
                    })
                }
            })
        }

        // open up the searchbar

        //get menu item which contains the searchform from te navmenu
        const menuSBContainer = siteNavigation.querySelector('.menu-item.menu-searchbar');

        if (menuSBContainer) {

            // get searchform
            const menuSearchForm = menuSBContainer.querySelector('.search-form');

            if (menuSearchForm) {

                const menuSearchBtn = menuSearchForm.querySelector('.search-btn');
                const menuSearchField = menuSearchForm.querySelector('.search-field');

                if (menuSearchBtn && menuSearchField) {
                    menuSearchBtn.addEventListener('click', function (e) {
                        if (!menuSearchField.classList.contains('search-field--shown')) {
                            /* prevent searchbutton default event only if the searchbar is not shown.
                            if the searchbar is shown during the event then it will just submit the form */
                            e.preventDefault();

                            menuSearchField.classList.add('search-field--shown');
                        }

                        menuSearchForm.addEventListener('mouseleave', (e) => {
                            menuSearchField.classList.remove('search-field--shown');
                        })
                    })
                }
            }
        }
    }
});