$(document).ready(function (){
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

        let selectBox = pubForm.querySelector('select');

        if (selectBox) {
            selectBox.onchange = function () {
                pubForm.submit();
            }
        }
    }
})

