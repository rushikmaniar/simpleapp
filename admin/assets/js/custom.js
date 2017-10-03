


/*=============================================================
    Authour URI: www.binarytheme.com
    License: Commons Attribution 3.0

    http://creativecommons.org/licenses/by/3.0/

    100% To use For Personal And Commercial Use.
    IN EXCHANGE JUST GIVE US CREDITS AND TELL YOUR FRIENDS ABOUT US
   
    ========================================================  */
    var arr1;
$(".btn-edit").on("click",function(){
   //alert("called");
   var user_id = $(this).val();
   //alert(user_id);
   $.ajax({
        cache : false,
        dataType:'JSON',
        type : 'POST',
        url : 'update_user.php',
        data : { user_id : user_id},
        success : function(data)
        {
            var str = JSON.stringify(data);
            var gender = 1;
            var arr = JSON.parse(str);
            arr1 = arr;
            console.log(arr);
            if(arr['user_gender'] == 0){
               $('#gender_female').attr('checked', 'checked');
            }else{
                $('#gender_male').attr('checked', 'checked');
            }
            $('input[name=user_firstname]').val(arr['user_firstname']);
            $('input[name=user_lastname]').val(arr['user_lastname']);
           // $('input[name=user_gender]').val(gender);
            $('input[name=user_age]').val(arr['user_age']);
            $('input[name=user_dob]').val(arr['user_dob']);
            $('input[name=user_phone]').val(arr['user_phone']);
            $('input[name=user_city]').val(arr['user_city']);
            $('input[name=user_state]').val(arr['user_state']);
            $('input[name=user_country]').val(arr['user_country']);
            $('input[name=user_email]').val(arr['user_email']);
            $('input[name=user_username]').val(arr['user_username']);
            $('button[name=update_profile]').data('id', arr['user_id']);
            $('input[name=user_id]').val(arr['user_id']);
            //$('#update_user_modal').show();
            //$('#modalContent').show().html(data);
        },
        error : function() {
            console.log('error');
            return false;
        }

   });
});


$(".btn-view-user").on("click",function(){
   //alert("called");
   var user_id = $(this).val();
   //alert(user_id);
   $.ajax({
        cache : false,
        dataType:'JSON',
        type : 'POST',
        url : 'update_user.php',
        data : { user_id : user_id},
        success : function(data)
        {
            var str = JSON.stringify(data);
            var gender = 1;
            var arr = JSON.parse(str);
            arr1 = arr;
            console.log(arr['user_pic']);
            $('.view-user td[name=user_pic]').html('<img src=\'../user/uploads/profile/images/'+ arr["img_name"] +'\' alt=\'image not found\'>');
            $('.view-user td[name=user_firstname]').html(arr['user_firstname']);
            $('.view-user td[name=user_lastname]').html(arr['user_lastname']);
           
            if(arr['user_gender'] == 0){
               $('.view-user td[name=user_gender]').html("Female");
            }else{
                $('.view-user td[name=user_gender]').html("Male");
            }
            $('.view-user td[name=user_age]').html(arr['user_age']);
            $('.view-user td[name=user_dob]').html(arr['user_dob']);
            $('.view-user td[name=user_phone]').html(arr['user_phone']);
            $('.view-user td[name=user_city]').html(arr['user_city']);
            $('.view-user td[name=user_state]').html(arr['user_state']);
            $('.view-user td[name=user_country]').html(arr['user_country']);
            $('.view-user td[name=user_email]').html(arr['user_email']);
            $('.view-user td[name=user_username]').html(arr['user_username']);
            $('.view-user td[name=user_type]').html(arr['user_username']);
        //    $('.view-user td[name=user_id]').html(arr['user_id']);
            //$('#update_user_modal').show();
            //$('#modalContent').show().html(data);
        },
        error : function() {
            console.log('error');
            return false;
        }

   });
});

$(".btn_delete").on("click",function(){
    //alert("called");
    var c;
    if(c = confirm("are u sure ?")){
    var user_id = $(this).val();
   // alert(user_id); 
     $.ajax({
        cache : false,
        dataType:'text',
        type : 'POST',
        url : 'user_delete.php',
        data : { user_id : user_id},
        success : function(data)
        {
          console.log('delete success');
         // alert("delete success");
          location.reload();
            
        },
        error : function() {
            console.log('error');
            return false;
        }

   });
 }else{
    return false;
 }
});
/*$("#btn_update").on("click",function(){
    //alert("called");
   var user_id = $(this).data('id');
  // alert(user_id);
   $.ajax({
        cache : false,
        dataType:'JSON',
        type : 'POST',
        url : 'get_user.php',
        data : { user_id : user_id},
        success : function(data)
        {
            var str = JSON.stringify(data);
            var gender = 1;
            var arr = JSON.parse(str);
            console.log(data);
          
            $('.row_'+user_id+'[name=user_firstname]').text('Hi');
            $('.row_'+user_id+'[name=user_firstname]').html(arr1['user_firstname']);
            $('.row_'+user_id+'[name=user_lastname]').html(arr1['user_lastname']);
           // $('input[name=user_gender]').val(gender);
            $('.row_'+user_id+'[name=user_age]').html(arr1['user_age']);
            $('.row_'+user_id+'[name=user_dob]').html(arr1['user_dob']);
            $('.row_'+user_id+'[name=user_phone]').html(arr1['user_phone']);
            $('.row_'+user_id+'[name=user_city]').html(arr1['user_city']);
            $('.row_'+user_id+'[name=user_state]').html(arr1['user_state']);
            $('.row_'+user_id+'[name=user_country]').html(arr1['user_country']);
            $('.row_'+user_id+'[name=user_email]').html(arr1['user_email']);
            $('.row_'+user_id+'[name=user_username]').html(arr1['user_username']);
           // $('button[name=update_profile]').data('id', arr1['user_id']);
          //  $('.'+user_id+'[name=user_id]').html(arr['user_id']);
            //$('#update_user_modal').show();
            //$('#modalContent').show().html(data);
            
            return false;
            
        },
        error : function() {
            console.log('error');
            return false;
        }

   });
});*/

(function ($) {
    "use strict";
    var mainApp = {

        main_fun: function () {
           
            /*====================================
              LOAD APPROPRIATE MENU BAR
           ======================================*/
            $(window).bind("load resize", function () {
                if ($(this).width() < 768) {
                    $('div.sidebar-collapse').addClass('collapse')
                } else {
                    $('div.sidebar-collapse').removeClass('collapse')
                }
            });

          
     
        },

        initialization: function () {
            mainApp.main_fun();

        }

    }
    // Initializing ///

    $(document).ready(function () {
        mainApp.main_fun();
    });

}(jQuery));
