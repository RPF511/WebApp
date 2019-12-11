window.onload = function() {
    $("b_xml").onclick=function(){
    	    //construct a Prototype Ajax.request object
    }
    $("b_json").onclick=function(){
    	    //construct a Prototype Ajax.request object
    }
};

function getCheckedRadio(radio_button){
	for (var i = 0; i < radio_button.length; i++) {
		if(radio_button[i].checked){
			return radio_button[i].value;
		}
	}
	return undefined;
}

function showBooks_XML(ajax) {
	alert(ajax.responseText);
}

function showBooks_JSON(ajax) {
	alert(ajax.responseText);
}

function ajaxFailed(ajax, exception) {
	var errorMessage = "Error making Ajax request:\n\n";
	if (exception) {
		errorMessage += "Exception: " + exception.message;
	} else {
		errorMessage += "Server status:\n" + ajax.status + " " + ajax.statusText + 
		                "\n\nServer response text:\n" + ajax.responseText;
	}
	alert(errorMessage);
}
