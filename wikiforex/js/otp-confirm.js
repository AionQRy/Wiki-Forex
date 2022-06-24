/**
 * otp-confirm.js
 *
 * For all custom js codes.
 */
jQuery(document).ready(function($) {  
  
    $('#form-confirm-otp').submit(function(e) {
        event.preventDefault();
        $(".error").html("").hide();
        var number = $("#otp-field").val();
        if (number.length !== 6 || number == null) {
            $(".error").html('กรุณากรอกรหัสยืนยันให้ครบ 6 ตัว');
            $(".error").show().css('display', 'inline-block');
            return false;
        }else{
            var form = "#form-confirm-otp";
            $(".error").html("").hide();
            $(".success").html("").hide();
            var data = {
                'action': 'otp_confirm',
                'posts': otp_confirm_params.posts,
                'page' : otp_confirm_params.current_page
            };
                jQuery.ajax({
                    url : otp_confirm_params.ajaxurl + "?action=otp_confirm",
                    data: jQuery(form).serialize(),
                    type:'POST',
                    success:function(data){					
                        if( data ) {		
	
                        result = jQuery.parseJSON( data );
                            //console.log(result.type);
                            //console.log(result.url); 
                            if( result.type == 'success' ){
                                $(".success").show().html(result.message).css('display', 'block');
                                $(".success").show();
                                setTimeout(() => {
                                    url = result.url;
                                    $( location ).attr("href", url);
                                }, 2700);
                            }else{
                                $(".error").show().html(result.message).css('display', 'block');
                                $(".error").show(); 
                            }	                         										  						
                        }else{
                            $(".error").show().html('มีข้อผิดพลาดกรุณากรอกใหม่อีกครั้ง');
                        }				
                    },
                    error : function(data) {
                        alert('error');
                        return false;
                    }
                });	
        }
    });

    

});
