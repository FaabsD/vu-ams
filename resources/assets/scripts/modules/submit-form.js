const { AmsWPRest } = require('./ams-classes');
function allPostsFromRest(postType, perPage = 10) {
    const restUrl = `/wp-json/wp/v2/${postType}/?per_page=${perPage}`;
    let totalPages = 0;
    let allResults = [];

    // return "trolololololol";

    fetch(restUrl)
        .then((response) => {
            if (response.ok) {
                totalPages = response.headers.get('X-WP-TotalPages');
                console.log(response);
                return response.json();
            }
            throw new Error(`Failed to fetch posts of type ${postType} from built-in WordPress API`);
        })
        .then((json) => {
            allResults = json;

            console.log(allResults);

            for (let i = 2; i <= totalPages; i++) {
                console.log(totalPages);
                console.log('===== new rest URL =====');
                console.log(restUrl + `&page=${i}`);
                fetch(restUrl + `&page=${i}`)
                    .then((response) => {
                        console.log(response.ok);
                        return response.json();
                    })
                    .then((moreResults) => {
                        console.log(`===== EXTRA RESULTS (${i}) =====`);
                        console.log(moreResults);
                        allResults.concat(moreResults);
                        console.log('===== NEW results Array =====');
                        console.log(allResults);
                    });
            }

            return allResults;
        })
        .catch((error) => {
            // just in case fetching the locations from the built-in WordPress API fails
            // open a alert to show the visitor that the locations fetching failed

            alert(`Something went wrong while loading in posts of type ${postType} try refreshing the page or check the console tab from the inspector by right clicking and selecting inspect`);
            console.error('Something went wrong while fetching locations', error);
        });
}

$(document).ready(function () {
    select2 = require('select2');
    const pubForm = document.getElementById('pubForm');
    if (pubForm) {
        console.log(pubForm);

        let inputFields = pubForm.querySelectorAll('input');

        inputFields.forEach((input) => {
            input.addEventListener('keyup', function (e) {
                if (e.key === "Enter") {
                    pubForm.submit();
                }
            })
        });

        let selectBox = pubForm.querySelector('#date');

        if (selectBox) {
            selectBox.onchange = function () {
                pubForm.submit();
            }
        }
    }

    const paginationCell = document.querySelector('.pagination-cell');

    if (paginationCell) {
        if (window.innerWidth <= 414) {
            paginationCell.colSpan = 3;
        }
    }

    $('#multiSelect').select2({
        placeholder: "Select or type Tags",
    });

    $('#multiSelect').on('change', function (e) {
        let selectedTags = $(this).select2('data');
        let selectTags = []
        selectedTags.forEach(tag => {
            selectTags.push(tag.text);
        });
        console.log(selectTags);
        let pubsCountBySelectedTags = 0;

        console.log(selectedTags);
        // create a new AmsWPRest instance
        const publicationsRest = new AmsWPRest('publication', 100);
        let chain = [];

        publicationsRest.makeRestCall().then(postObjects => {
            // make new API calls
            for (let i = 1; i <= publicationsRest.totalPagesCount; i++) {
                console.log(publicationsRest.totalPagesCount);
                console.log(i)
                chain.push(publicationsRest.makeRestCall(i));
                console.log(chain);
            }

            Promise.allSettled(chain).then(results => {
                results.forEach(result => {
                    publicationsRest.setAllResults(result.value);

                    console.log('===== All publication results =====');
                    console.log(publicationsRest.allPostResults);
                });
                // loop through all the retrieved publication objects
                if (typeof publicationsRest.allPostResults === "object") {
                    publicationsRest.allPostResults.forEach(publication => {
                        // console.log(publication.acf);
                        if (publication.acf.tags !== "") {
                            // console.log(publication.acf.tags);
                            // turn tags string into an Array
                            let pubTagsToArray = publication.acf.tags.split(', ');
                            // console.log(pubTagsToArray);

                            // check if selected tags are present in the publication object
                            let tagsChecker = (arr, target) => target.every(v => arr.includes(v));

                            console.log(tagsChecker(selectTags, pubTagsToArray));

                            if (tagsChecker(selectTags, pubTagsToArray)) {
                                pubsCountBySelectedTags + 1;

                                console.log(`Count of publications containing the selected tags: ${pubsCountBySelectedTags}`);
                            }
                        }
                    })
                }
            }).catch(error => {
                alert('Oops something went wrong fetching all publications from built-in REST API try to reload or check console for more information');
                console.log(error);
            })
        }).catch(error => {
            alert('Oops something went wrong fetching all publications from built-in REST API try to reload or check console for more information');
            console.log(error);
        })

    })
})

