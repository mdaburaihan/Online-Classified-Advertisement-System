function myOldPwd() {
    var x = document.getElementById("oldPassword");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
}
function myNewPwd() {
    var x = document.getElementById("newPassword");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
}
function myCnfrmNewPwd() {
    var x = document.getElementById("cnfrmNewPassword");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
}
