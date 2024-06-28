/* note: this is for disabling the checkboxes AUTOMATICALLY once you open Pending_Resolve (retain selection from resolve_request UI)
    without clicking the radio buttons for hardware or software */
  
    var checked_name = document.querySelector('input.ict_component:checked').value;
    console.log("two", checked_name);   
  
    /* cannot code with just "getElementsByClassname", only option is to enumerate all ids */
  
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
    }  
   
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
    } 
 
  