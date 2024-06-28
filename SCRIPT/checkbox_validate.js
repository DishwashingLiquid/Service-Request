/* for ict_component_spec checkboxes disbaled functions */ 
function call_component() {
    var checker_comp = document.getElementsByName("ict_component"); 
    var checked_one = Array.prototype.slice.call(checker_comp).some(x => x.checked); 
    var checked_name = document.querySelector('input.ict_component:checked').value; 
    var check_counter = document.querySelectorAll('input[type="checkbox"]:checked').length 
      
    /* cannot code with just "getElementsByClassname", only option is to enumerate all ids */
 
    document.getElementById('dmas').disabled = true;
    document.getElementById('dms').disabled = true;
    document.getElementById('ehr').disabled = true;
    document.getElementById('engas').disabled = true; 
    document.getElementById('his').disabled = true; 
    document.getElementById('hris').disabled = true; 
    document.getElementById('lis').disabled = true; 
    document.getElementById('mms').disabled = true; 
    document.getElementById('pacs').disabled = true; 
    document.getElementById('pis').disabled = true; 
    document.getElementById('qmeup').disabled = true;  
    document.getElementById('ris').disabled = true; 
    document.getElementById('website').disabled = true; 
    document.getElementById('fb_page').disabled = true; 
    document.getElementById('others_software').disabled = true; 
    document.getElementById('others_software_spec').disabled = true;  
    document.getElementById('others_software_spec').value = '';  
    if(checked_name === "Software") {
        document.getElementById('dmas').disabled = false;
        document.getElementById('dms').disabled = false;
        document.getElementById('ehr').disabled = false;
        document.getElementById('engas').disabled = false; 
        document.getElementById('his').disabled = false; 
        document.getElementById('hris').disabled = false; 
        document.getElementById('lis').disabled = false; 
        document.getElementById('mms').disabled = false; 
        document.getElementById('pacs').disabled = false; 
        document.getElementById('pis').disabled = false; 
        document.getElementById('qmeup').disabled = false;  
        document.getElementById('ris').disabled = false; 
        document.getElementById('website').disabled = false; 
        document.getElementById('fb_page').disabled = false; 
        document.getElementById('others_software').disabled = false; 
        /* unchecked all options for hardware */ 
        document.getElementById('desktop').checked = false;
        document.getElementById('input').checked = false;
        document.getElementById('output').checked = false; 
        document.getElementById('device').checked = false; 
        document.getElementById('storage').checked = false; 
        document.getElementById('printer').checked = false; 
        document.getElementById('internet').checked = false; 
        document.getElementById('install').checked = false; 
        document.getElementById('preventive').checked = false;  
        document.getElementById('support').checked = false;  
        document.getElementById('others_hardware').checked = false; 
    }  
    document.getElementById('desktop').disabled = true;
    document.getElementById('input').disabled = true;
    document.getElementById('output').disabled = true; 
    document.getElementById('device').disabled = true; 
    document.getElementById('storage').disabled = true; 
    document.getElementById('printer').disabled = true; 
    document.getElementById('internet').disabled = true; 
    document.getElementById('install').disabled = true; 
    document.getElementById('preventive').disabled = true; 
    document.getElementById('support').disabled = true; 
    document.getElementById('others_hardware').disabled = true;  
    document.getElementById('others_hardware_spec').disabled = true;  
    document.getElementById('others_hardware_spec').value = '';  
    if(checked_name === "Hardware"){ 
        document.getElementById('desktop').disabled = false;
        document.getElementById('input').disabled = false;
        document.getElementById('output').disabled = false; 
        document.getElementById('device').disabled = false; 
        document.getElementById('storage').disabled = false; 
        document.getElementById('printer').disabled = false; 
        document.getElementById('internet').disabled = false; 
        document.getElementById('install').disabled = false; 
        document.getElementById('preventive').disabled = false; 
        document.getElementById('support').disabled = false; 
        document.getElementById('others_hardware').disabled = false;  
        /* unchecked all options on software */
        document.getElementById('dmas').checked = false;
        document.getElementById('dms').checked = false;
        document.getElementById('ehr').checked = false;
        document.getElementById('engas').checked = false; 
        document.getElementById('his').checked = false; 
        document.getElementById('hris').checked = false; 
        document.getElementById('lis').checked = false; 
        document.getElementById('mms').checked = false; 
        document.getElementById('pacs').checked = false; 
        document.getElementById('pis').checked = false; 
        document.getElementById('qmeup').checked = false;  
        document.getElementById('ris').checked = false; 
        document.getElementById('website').checked = false; 
        document.getElementById('fb_page').checked = false; 
        document.getElementById('others_software').checked = false;   
    }
}
/* making the others input enabled when !empty */
    var others_input_hard = document.querySelector('input#others_hardware_spec').value;  
    var others_input_soft = document.querySelector('input#others_software_spec').value;  
    
    if(others_input_hard != 0){
        document.getElementById('others_hardware_spec').disabled = false;
    }
    if(others_input_soft != 0){
        document.getElementById('others_software_spec').disabled = false;
    }


/* function for enabling the input field by checking the others checkbox */
function call_others(){
    /* input field HARDWARE */
    var checker_hardware = document.getElementsByName("others_hardware"); 
    var checked_hardware = Array.prototype.slice.call(checker_hardware).some(x => x.checked); 
  
    document.getElementById('others_hardware_spec').disabled = true;
    if(checked_hardware){
        document.getElementById('others_hardware_spec').disabled = false; 
        document.getElementById('others_hardware_spec').value = ''; 
    } else {
        document.getElementById('others_hardware_spec').value = '';
    }
    /* input field SOFTWARE */
    var checker_software = document.getElementsByName("others_software");
    var checked_software = Array.prototype.slice.call(checker_software).some(x => x.checked);

    document.getElementById('others_software_spec').disabled = true;
    if(checked_software){
        document.getElementById('others_software_spec').disabled = false;
        document.getElementById('others_software_spec').value = '';
    } else {
        document.getElementById('others_software_spec').value = '';
    }
}

/* function for requiring atleast one hardware specification checkbox */
function call_hard(req_hard) {
    el_hard = document.getElementsByClassName(req_hard);   
          
    var checked_one_hard = false; //at least one req is checked
    for (i = 0; i < el_hard.length; i++) {
        if (el_hard[i].checked === true) {
            checked_one_hard = true;
        } 
    } 
    if (checked_one_hard === true) {
        for (i = 0; i < el_hard.length; i++) {
        el_hard[i].required = false;
        }
    } else {
        for (i = 0; i < el_hard.length; i++) {
        el_hard[i].required = true;
        }
    }
} 

/* function for requiring atleast one software specification checkbox */
function call_soft(req_soft) {
    el_soft = document.getElementsByClassName(req_soft);

    var checked_one_soft = false; //at least one req is checked
    for (i = 0; i < el_soft.length; i++) {
        if (el_soft[i].checked === true) {
            checked_one_soft = true;    
        }  
    } 
    if (checked_one_soft === true) {
        for (i = 0; i < el_soft.length; i++) {
        el_soft[i].required = false; 
        }
    } else {
        for (i = 0; i < el_soft.length; i++) {
        el_soft[i].required = true; 
        }
    }
}
  