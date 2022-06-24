<?php 
/**
 * Template Name: Page Validation Account
 */
get_header(); 
$userid = get_current_user_id();
$gennaretion = get_field('generate_number', 'user_'. $userid);
$status = get_field('status_authentication' , 'user_'. $userid );

?>
<?php if (is_user_logged_in()) {
	if($status == 'pass'){
		echo ("<script LANGUAGE='JavaScript'>
		window.alert('คุณได้ยืนยันตัวตนแล้ว');
		window.location.href='". get_home_url() ."';
		</script>");
	}else{
		?>
			<div class="page-register-account">
		<div class="s-container">

			<div id="primary" class="content-area">
				<main id="main" class="site-main">
					<div class="box-register">
						<div class="main-register">
							<h2>OTP - Number Phone</h2>
							<form action="/otp-code/" id="otp-send" class="form-register form-otp" method="post">
							<!-- NAME FIELD -->
							<div class="form-field">
								<label for="tel-field" class="label--required">กรอกเบอร์โทรศัพท์ของท่าน</label>
								<section>
									<i class="fas fa-mobile-alt"></i>
									<input name="tel-field" id="tel-field" class="input-otp" type="text" placeholder="0805558888" required />
								</section>
								<div class="error"></div>
							</div>							
							<div class="box-btn-form">
								<button type="submit" class="btn btn-submit"><i class="fab fa-telegram-plane"></i> รับรหัส OTP</button>
								<input type="hidden" name="otp-hidden" value="passed">
							</div>							
							</form>								
						</div>
					</div>

				</main><!-- #main -->
			</div><!-- #primary -->
	</div><!--container-->

</div>
		<?php
	}
?>
<?php }else{	
	echo ("<script LANGUAGE='JavaScript'>
    window.alert('กรุณาเข้าสู่ระบบ');
    window.location.href='". get_home_url() ."/login/';
    </script>");
} ?>

<?php get_footer(); ?>
