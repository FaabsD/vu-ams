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

            for (let i = 2; i <= totalPages; i++) {
                fetch(restUrl + `&page=${i}`)
                    .then((response) => {
                        return response.json();
                    })
                    .then((moreResults) => {
                        allResults.concat(moreResults);
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

$(document).ready(function (){
    select2 = require('select2');
    const pubForm = document.getElementById('pubForm');
    if (pubForm) {
        console.log(pubForm);

        let inputFields = pubForm.querySelectorAll('input');

        inputFields.forEach((input) => {
            input.addEventListener('keyup', function (e) {
                if(e.key === "Enter") {
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
        console.log(selectedTags);

        console.log('retrieve all publications');
        console.log(allPostsFromRest('publication', 100));
    })
})

