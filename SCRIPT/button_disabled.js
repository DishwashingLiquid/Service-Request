/* function for edit and delete disable functions */
function call_action(select_id) { 
    checker = document.getElementsByClassName(select_id);   
    console.log("hello", checked_one)
    var checked_one = Array.prototype.slice.call(checker).some(x => x.checked); /* implode the nodelist */ 
    var check_count = document.querySelectorAll('input.select_id:checked').length 
    
    console.log(check_count); /* to check how many checkboxes is tick */

document.getElementById("delete_button").style.display = "none";
if (checked_one) {
    document.getElementById("delete_button").style.display = "inline-block";
    } 
document.getElementById("edit_button").style.display = "none";
if (check_count == 1) {
    document.getElementById("edit_button").style.display = "inline-block";
    } 
}
/* function for selecting all checkboxes */
function call_all(select_all) {  
    var checker_too = document.querySelectorAll('input.select_all:checked').length; 
    var to_checked = document.getElementsByName("select_id[]");  
    
    if(checker_too === 1){
        for (let i = 0; i < to_checked.length; i++) {
         to_checked[i].checked = true;
        }
    } else {
        for (let i = 0; i < to_checked.length; i++) {
            to_checked[i].checked = false;
       }
    }
    
    var checked_one = Array.prototype.slice.call(to_checked).some(x => x.checked); /* implode the nodelist */ 
        document.getElementById("delete_button").style.display = "none";
        document.getElementById("edit_button").style.display = "none";
    if (checked_one) {
        document.getElementById("delete_button").style.display = "inline-block";
        document.getElementById("edit_button").style.display = "none";
        }  

}
