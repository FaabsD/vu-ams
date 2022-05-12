const tabContainer = document.querySelector('.learn-more__hard-software');

if (tabContainer) {
        const hardWare = tabContainer.querySelector('.hardware');
        const softWare = tabContainer.querySelector('.software');
        const tabs = tabContainer.querySelectorAll('.tabs .tabs__tab');

        if (tabs) {
                tabs.forEach(function (tab) {
                   tab.addEventListener('click', function (e) {
                           e.preventDefault();
                           console.log(e.target.dataset.tabFor);

                           if (e.target.dataset.tabFor == "Hardware") {
                                   console.log('Go to Hardware Tab');
                                   // Hide Hardware tab & unhide Software tab
                                   hardWare.classList.remove('tab--hidden');
                                   softWare.classList.add('tab--hidden');
                                   // change button active state

                                   let otherBtn = e.target.nextElementSibling;
                                   e.target.classList.add('tabs__tab--active');
                                   otherBtn.classList.remove('tabs__tab--active');

                           } else if (e.target.dataset.tabFor =="Software") {
                                   console.log('Go to Software Tab');
                                   softWare.classList.remove('tab--hidden');
                                   hardWare.classList.add('tab--hidden');

                                   let otherBtn = e.target.previousElementSibling;
                                   otherBtn.classList.remove('tabs__tab--active');
                                   e.target.classList.add('tabs__tab--active');
                           }


                   })
                });
        }

        softWare.classList.add('tab--hidden');
}