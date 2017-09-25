


/*=============================================================
    Authour URI: www.binarytheme.com
    License: Commons Attribution 3.0

    http://creativecommons.org/licenses/by/3.0/

    100% To use For Personal And Commercial Use.
    IN EXCHANGE JUST GIVE US CREDITS AND TELL YOUR FRIENDS ABOUT US
   
    ========================================================  */
$("#btn-edit").on("click",function(){
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
            return false;
            window.reload
        },
        error : function() {
            console.log('error');
            return false;
        }

   });
});

$("#btn-update").on("click",function(){
   var user_id = $(this).data('id');
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

            $('input[name=user_id]').val(arr['user_id']);
            //$('#update_user_modal').show();
            //$('#modalContent').show().html(data);
            return false;
            window.reload
        },
        error : function() {
            console.log('error');
            return false;
        }

   });
});

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
