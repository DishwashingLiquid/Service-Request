/* for change password */
function toggle_current() {
    var current_pass = document.getElementById("current_password");
    var new_pass = document.getElementById("new_password");
    var confirm_pass = document.getElementById("confirm_password");

    if(current_pass.type === "password"){
        current_pass.type = "text";
        new_pass.type = "password";
        confirm_pass.type = "password";
    } else {
        current_pass.type = "password";
    }
}

function toggle_new(){
    var new_pass = document.getElementById("new_password");
    var current_pass = document.getElementById("current_password");
    var confirm_pass = document.getElementById("confirm_password");

    if(new_pass.type === "password") {
        new_pass.type = "text";
        current_pass.type = "password";
        confirm_pass.type = "password";
    } else {
        new_pass.type = "password";
    }
}

function toggle_confirm(){
    var confirm_pass = document.getElementById("confirm_password");
    var current_pass = document.getElementById("current_password");
    var new_pass = document.getElementById("new_password");

    if(confirm_pass.type === "password") {
        confirm_pass.type = "text";
        current_pass.type = "password";
        new_pass.type = "password";
    } else {
        confirm_pass.type = "password";
    }
}
/* for login/index */
function toggle_user(){
    var password = document.getElementById("password");

    if(password.type === "password"){
        password.type = "text";
    } else {
        password.type = "password";
    }
}
function toggle_admin(){
    var password = document.getElementById("admin_password");

    if(password.type === "password"){
        password.type = "text";
    } else {
        password.type = "password";
    }
}
function toggle_reception(){
    var password = document.getElementById("reception_password");

    if(password.type === "password"){
        password.type = "text";
    } else {
        password.type = "password";
    }
}
function toggle_superadmin(){
    var password = document.getElementById("superadmin_password");

    if(password.type === "password"){
        password.type = "text";
    } else {
        password.type = "password";
    }
}
/* for add and edit */
function toggle_add(){
    var password = document.getElementById("add_password");

    if(password.type === "password"){
        password.type = "text";
    } else {
        password.type = "password";
    }
}
function toggle_edit(){
    var password = document.getElementById("edit_password");

    if(password.type === "password"){
        password.type = "text";
    } else {
        password.type = "password";
    }
}