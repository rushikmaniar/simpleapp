$(document).ready(function(){
var page = 0;
if(page == 0){
	$.ajax({
		url : 'login/index.php',
		datatype: 'html',
		success : function(data){ 
			//console.log(data);
			$("body").html(data);
		},
		error : (function() {
			console.log(data);
			//document.write(data);
		})
	});
}

});

//on click not member
function not_member(){
	
	page = 1;
	$.ajax({
	url : 'login/signup.php',
	datatype: 'html',
	success : function(data){ 
		//console.log(data);
		$("body").html(data);
	},
	error : (function() {
		console.log(data);
		alert("sdfsd");
		return false;
		//document.write(data);
	})
});
return false;
};