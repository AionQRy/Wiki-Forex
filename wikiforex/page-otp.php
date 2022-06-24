<?php 
/**
 * Template Name: Page Otp Account
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
		if($_POST['otp-hidden'] !== 'passed'){
			echo ("<script LANGUAGE='JavaScript'>
			window.alert('กรุณากรอกเบอร์โทรศัพท์ของท่าน');
			window.location.href='". get_home_url() ."/otp';
			</script>");
		}
		?>
		<div class="page-register-account">
		<div class="error"></div>	
		<div class="success"></div>
			<div class="s-container">

				<div id="primary" class="content-area">
					<main id="main" class="site-main">
						<div class="box-register">
							<div class="main-register">
								<h2>OTP - Validation</h2>
								<form action="" id="form-confirm-otp" class="form-register form-otp" method="post">
								<!-- NAME FIELD -->
								<div class="form-field">
									<label for="otp-field" class="label--required">โปรดยืนยันรหัส OTP ของคุณ</label>
									<section>
										<i class="fas fa-key"></i>
										<input type="text" name="otp-field" id="otp-field" class="input-otp" placeholder="กรอกรหัส OTP" maxlength="6" required />
									</section>
									<div class="box-sub">
										<p class="text_sub">ระบุรหัสผ่าน OTP ที่ได้รับทาง SMS เพื่อเข้าสู่ระบบ</p>
										<p class="text_sub">สำหรับรหัส OTP จะส่งไปยังหมายเลขติดต่อของคุณ</p>
										<p class="text_sub">รหัส OTP มีอายุการใช้งาน 5 นาที</p>
									</div>	
									<?php
									$author =  wp_get_current_user();
									$user_id = $author->ID;
									$gennaretion = get_field('generate_number', 'user_'. $userid);
									$status = get_field('status_authentication' , 'user_'. $userid );
									$telephone_number = get_field('telephone_number', 'user_'. $userid);
									// echo $_COOKIE['otp_code'];
									// echo '<Br>';
									// echo $telephone_number; 
									// echo '<Br>';
									// echo $gennaretion; ?>
								</div>							
								<div class="box-btn-form">
									<button type="submit" class="btn btn-submit">ตกลง</button>
									<a href="/otp/" class="btn btn-submit">รับรหัสใหม่</a>
									<input type="hidden" name="otp-confirm" value="passed">
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
