console.log("hiii")
let a = document.getElementById('search');
a.addEventListener('blur',function (){

    let form= document.getElementById('form_search');
    if (form && form.__submitting !== true) {
        form.__submitting = true;
        console.log('Form sẽ được submit');
        form.submit();
    }
})
