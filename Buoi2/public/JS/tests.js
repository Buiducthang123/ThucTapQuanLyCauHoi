function editText(id) {
    var inputElement = document.getElementById(id);

    if (inputElement) {
        inputElement.disabled = false;
        inputElement.focus();
        inputElement.addEventListener('blur', function () {
            var form = document.getElementById('form_edit_text');
            if (form && form.__submitting !== true) {
                form.__submitting = true;
                console.log('Form sẽ được submit');
                form.submit();
            }
        });
    } else {
        console.error("Không tìm thấy phần tử với id: " + id);
    }
}

let a = document.getElementById('search');
a.addEventListener('blur', function () {

    let form = document.getElementById('form_search');
    if (form && form.__submitting !== true) {
        form.__submitting = true;
        console.log('Form sẽ được submit');
        form.submit();
    }
})



