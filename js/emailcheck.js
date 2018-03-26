<script> 
function emailcheck(the_form, the_field, the_value) {

var exclude=/[^@\-\.\w]|^[_@\.\-]|[\._\-]{2}|[@\.]{2}|(@)[^@]*\1/;
var check=/@[\w\-]+\./;
var checkend=/\.[a-zA-Z]{2,3}$/;

	if(((the_value.search(exclude) != -1)||(the_value.search(check)) == -1)||(the_value.search(checkend) == -1)){ //alert("Incorrect email address!");
		 return false;	    
	}
	else {  // alert("Email address format OK!");
	    return true;
	}
}
</script>