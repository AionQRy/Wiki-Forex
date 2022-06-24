<?php 
/**
 * Template Name: Page Login Account
 */
get_header(); ?>
<?php if (!is_user_logged_in()) { 

		if(isset($_POST['check-login']) && $_POST['check-login'] == 'passed') {
			if($_REQUEST['redirect']) {
				$current_url = $_REQUEST['redirect'];
			} else {
				global $wp;
				$current_url = home_url(add_query_arg(array(),$wp->request));
			}

			//We shall SQL escape all inputs
			$email = $wpdb->escape($_REQUEST['email-field']);
			$password = $wpdb->escape($_REQUEST['password-field']);
			$remember = $wpdb->escape($_REQUEST['rememberme']);

			if($remember) $remember = "true";
			else $remember = "false";
			$login_data = array();
			$login_data['user_login'] = $email;
			$login_data['user_password'] = $password;
			$login_data['remember'] = $remember;
			$user_verify = wp_signon( $login_data, false );
			//wp_signon is a wordpress function which authenticates a user. It accepts user info parameters as an array.
			if (! is_wp_error($user_verify) ) {
				$_SESSION['hi'] = $email;
				echo "<script type='text/javascript'>window.location='". $current_url ."?hi=welcome_back'</script>";
			}else{
				echo ("<script LANGUAGE='JavaScript'>
				window.alert('อีเมลหรือรหัสผ่านของท่านไม่ถูกต้อง');
				window.location.href='". $current_url ."';
				</script>");
			}
		}		
  ?>
	<div class="page-register-account page-login-account">
		<div class="s-container">

			<div id="primary" class="content-area">
				<main id="main" class="site-main">
					<div class="box-register box-login">
						<div class="main-register main-login">
							<h2>เข้าสู่ระบบ</h2>
							<form action="" class="form-register form-login" method="post">
							<!-- Email FIELD -->
							<div class="form-field">
								<label for="email-field" class="label--required">อีเมล</label>
								<section>
									<i class="fas fa-envelope"></i>
									<input name="email-field" id="email-field" class="input-1" type="text" placeholder="Example@example.com" required />
								</section>
							</div>
							<!-- Password FIELD -->
							<div class="form-field">
								<label for="password-field" class="label--required">รหัสผ่าน</label>
								<section>
									<i class="fas fa-unlock-alt"></i>
									<input name="password-field" id="password-field" class="input-1" type="password" placeholder="กรอกรหัสผ่านของท่าน" required />
								</section>
							</div>
							<!-- Remember FIELD -->
							<div class="form-field form-check">
								<section>
								    <input name="rememberme" id="checkbox-field" class="input-1" type="checkbox"/>
									<label for="rememberme" class="label--required">จดจำผู้ใช้</label>																									
								</section>								
							</div>
							<div class="box-btn-form">					
								<?php echo do_shortcode( '[nextend_social_login provider="facebook"]' );?>
								<?php echo do_shortcode( '[nextend_social_login provider="google"]' );?>
								<button type="submit" class="btn btn-submit"><i class="fas fa-sign-in-alt"></i> เข้าสู่ระบบ</button>
								<input type="hidden" name="check-login" value="passed">
							</div>							
							</form>
						</div>
					</div>

				</main><!-- #main -->
			</div><!-- #primary -->
	</div><!--container-->

</div>
<?php }else{	
	echo ("<script LANGUAGE='JavaScript'>
    window.location.href='". get_home_url() ."';
    </script>");
} ?>

<?php get_footer(); ?>
