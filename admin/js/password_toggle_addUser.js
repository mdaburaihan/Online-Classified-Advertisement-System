function myPwd() {
    var x = document.getElementById("myPassword");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
}
function myCPwd() {
    var x = document.getElementById("myConfirmPwd");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
}