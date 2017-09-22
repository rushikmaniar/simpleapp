<?php 
	$con = mysqli_connect('localhost','root','','bca');
 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<title>JSON</title>
 </head>
 <script src="jquery.min.js"></script>
 <script type="text/javascript">
$(document).ready(function(){
$("#submit").click(function(){
var name = $("#name").val();
//var email = $("#email").val();
var password = $("#password").val();
//var contact = $("#contact").val();
// Returns successful data submission message when the entered information is stored in database.
var dataString = 'name1='+ name + 'password1='+ password ;
if(name==''||password=='')
{
alert("Please Fill All Fields");
}
else
{
// AJAX Code To Submit Form.
	$.ajax({
	datatype: "JSON",
	type: 'get',
	url: "sample1.php",
	data: dataString,
	cache: false,
	/*success: function(data){
	$("div").text(data);
	},*/
	success: function(response){
            var len = response.length;
            for(var i=0; i<len; i++){
                var id = response[i].id;
                var firstname = response[i].firstname;
                var lastname = response[i].lastname;
                var type = response[i].type;

                var tr_str = "<tr>" +
                    "<td align='center'>" + (i+1) + "</td>" +
                    "<td align='center'>" + firstname + "</td>" +
                    "<td align='center'>" + lastname + "</td>" +
                    "<td align='center'>" + type + "</td>" +
                    "</tr>";

                $("#userTable").append(tr_str);
            }
         }
});
}
});
});


 	
 </script>
 <body>
 <form method="post">
 	name
 	<input type="text" name="name" id="name">
 	password
 	<input type="text" name="password" id="password">
 	<input type="submit" id="submit">
 </form>
 <div></div>
 <table id="userTable">
 	
 </table>
 </body>
 </html>