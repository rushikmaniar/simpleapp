<?php
$con = mysqli_connect('localhost', 'root', '', 'bca');
?>
<!DOCTYPE html>
<html>
<head>
    <title>JSON</title>
</head>
<script src="jquery.min.js"></script>
<script type="text/javascript">

    function myfunc() {
        var name = $("#name").val();
        var password = $("#password").val();
        //alert(name+password);
        //var dataString = 'name1:'+ name + ',' + 'password1:'+ password ;
        if (name == '' || password == '') {
            alert("Please Fill All Fields");
            return false;
        }
        else {
            $.ajax({
                dataType: "json",
                type: 'post',
                url: "sample1.php",
                data: {
                    name1: name,
                    password1: password
                },
                cache: false,
                /*success: function(data){
                $("div").text(data);
                },*/
                success: function (data) {
                    var str = JSON.stringify(data);
                    //var arr = JSON.parse(str);
                    console.log(str);
                },
                error: function () {
                    //$("#p").html('Password Username is Wrong');
                    //$("#result").addClass('msg_error');
                    // $("#result").fadeIn(1500);
                    console.log(data);
                }

            });
            return false;
        }
    }


</script>
<body>
<form method="post" onsubmit="return myfunc()">
    name
    <input type="text" name="name" id="name">
    password
    <input type="text" name="password" id="password">
    <input type="submit" id="submit">
</form>
<div id="p"></div>
<table id="userTable">

</table>
</body>
</html>