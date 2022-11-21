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
})

