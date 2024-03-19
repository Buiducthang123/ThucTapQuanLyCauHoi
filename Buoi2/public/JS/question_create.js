console.log("fiugfiugf");
function assignValueToRadio() {
    setValue('OptionA','RadioOptionA')
    setValue('OptionB','RadioOptionB')
    setValue('OptionC','RadioOptionC')
    setValue('OptionD','RadioOptionD')
}
function setValue(inputText,inputRadio) {
    var inputValue = document.getElementById(inputText).value;
    var radio = document.getElementById(inputRadio);
    radio.value = inputValue;
    console.log(inputValue);
    console.log("Giá trị của ô radio: " + radio.value);
}

function checkRadio() {
    var optionA = document.getElementById('RadioOptionA');
    var optionB = document.getElementById('RadioOptionB');
    var optionC = document.getElementById('RadioOptionC');
    var optionD = document.getElementById('RadioOptionD');

    if (optionA.checked) {
        console.log("Option A is selected");
    } else if (optionB.checked) {
        console.log("Option B is selected");
    } else if (optionC.checked) {
        console.log("Option C is selected");
    }
    else if (optionD.checked) {
        console.log("Option D is selected");
    }

    else {
        console.log("No option is selected");
    }
}

