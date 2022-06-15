const previousOpener = document.querySelector('.releases__opener');

$(document).ready(function() {
    if (previousOpener) {
        console.log('prevous releases opener found');
        const releasesOpener = previousOpener.querySelector('.opener-btn');
        const prevReleases = document.querySelector('.releases__previous');
        if (releasesOpener && prevReleases) {

            releasesOpener.addEventListener('click', e => {
                e.preventDefault();
                prevReleases.classList.toggle('releases__previous--closed')
                if (!prevReleases.classList.contains('releases__previous--closed')) {
                    releasesOpener.classList.add('opener-btn--rotated');
                } else {
                    releasesOpener.classList.remove('opener-btn--rotated');
                }
            })
        }
    }
})