/**
 * main.js
 *
 * For all custom js codes.
 */
jQuery(document).ready(function($) {  
        $('#otp-send').submit(function() {
            $(".error").html("").hide();
            var number = $("#tel-field").val();
            if (number.length !== 10 || number == null) {
                $(".error").html('เบอร์ของท่านผิดพลาดกรุณากรอกใหม่อีกครั้ง');
                $(".error").show().css('display', 'inline-block');
                return false;
            }
        });

        $('.object_list').click(function(){
            var att_val =  $(this).attr('setid');
             $('.image_security').each(function(){
                if(att_val == $(this).attr('setid')){
              $('.image_security').removeClass('active');
                    $(this).addClass('active');
                }
            })
                return false;
        });

        $('#testing_time').click(function(){
            $(this).toggleClass("rotate"); 
            $('.list_risk_box').toggleClass("rotate"); 
        });

        $('.image_security').click(function(){
            var att_val =  $(this).attr('setid');
             $('.object_list').each(function(){
                if(att_val == $(this).attr('setid')){
              $('.image_security').removeClass('active');
                    $(this).removeClass('active');
                }
            })
                return false;
        });
});
