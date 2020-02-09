var passCheck = /^([0-9]{4,4})(2020)$/gm;

function validate() {

    alert("validating...");
    passCheckF();

}

function passCheckF() {

    var pass = document.getElementById('form4').value;
    var pCheck = passCheck.test(pass);

    if (pCheck) {
        alert("Password is Valid");
    } else {
        alert("Password is Invalid");
    }
}