const previousOpener = document.querySelector('.releases__opener');

$(document).ready(function () {
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

// change max height of the previous versions container on the previous versions page
$(document).ready(function () {
	if ($('.old_software_releases')) {
		let oldSoftwareReleasesInner = $('.old_software_releases .old_software_releases__inner');

		const oldVersions = oldSoftwareReleasesInner.children();

		console.log(oldVersions);

		var maxHeight = Math.max.apply(null, oldVersions.map(function () {
			return $(this).outerHeight();
		}).get());

		oldVersions.each(function(index) {
			$(this).outerHeight(maxHeight);
		});

		oldSoftwareReleasesInner.css('max-height', maxHeight * 3)
		console.log("Highest old version is " + maxHeight + "px");
	}
});