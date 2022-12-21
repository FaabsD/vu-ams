const { AmsWPRest } = require('./ams-classes');

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

        let optGroups = $(this).children();
        let options = [];

        // put all options in an array

        console.log('===== LOOPING THROUGH EVERY OPTGROUP =====');

        optGroups.each(function () {
            let currentOptions = $(this).children();

            currentOptions.each(function () {
                options.push($(this).val())
            });
        });

        console.log('===== ALL AVAILABLE OPTIONS =====');
        console.log(options);

        let selectTags = []
        selectedTags.forEach(tag => {
            selectTags.push(tag.id);
        });
        console.log(selectTags);

        console.log(selectedTags);
        // create a new AmsWPRest instance
        const publicationsRest = new AmsWPRest('publication', 100);

        console.log('===== GONNA MAKE MULTIPLE REST API CALLS FROM HERE =====');

        publicationsRest.makeMultipleRestCalls().then(publications => {
            let tagsChecker = (arr, target) => target.every(v => arr.includes(v));
            if (typeof publications === 'object') {
                let postTags = [];

                publications.forEach(pub => {
                    let tags = pub.acf.tags;

                    if (tags !== "") {
                        console.log(tags);
                        postTags = postTags.concat(tags.split(', '));
                        console.log(postTags)
                    }
                });

                if (postTags && typeof postTags === "object") {
                    let tagOccurrences = [];
                    // alert("postTags exists and is of type: " + typeof postTags);

                    options.forEach((option, index) => {
                        let count = 0;
                        let target = option;
                        for (postTag of postTags) {
                            if (postTag.toLowerCase() === target.toLowerCase()) {
                                count++
                            }
                        }
                        tagOccurrences[option] = count;
                        $(this).find(`option[value="${option}"]`).text(option + ": " + count);
                        console.log($(this));
                        $(this).select2({
                            placeholder: "Select or type Tags"
                        })

                        console.log(tagOccurrences);
                    })
                }
            }

        }).catch(error => {
            console.warn(error);
        })
    })

    $('#multiSelect').trigger('change');
})

