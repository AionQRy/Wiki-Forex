<?php 
/**
 * Template Name: Page Register Account
 */
get_header(); ?>
<?php if (!is_user_logged_in()) { ?>
	<div class="page-register-account">
		<div class="s-container">

			<div id="primary" class="content-area">
				<main id="main" class="site-main">
					<div class="box-register">
						<div class="main-register">
							<h2>สมัครสมาชิก</h2>
							<form action="" class="form-register" method="post">
							<!-- NAME FIELD -->
							<div class="form-field">
								<label for="name-field" class="label--required">ชื่อ</label>
								<section>
									<i class="fas fa-user"></i>
									<input name="name-field" id="name-field" class="input-1" type="text" placeholder="กรอกชื่อ" required />
								</section>
							</div>
							<!-- Lastname FIELD -->
							<div class="form-field">
								<label for="lastname-field" class="label--required">นามสกุล</label>
								<section>
									<i class="fas fa-file-signature"></i>
									<input name="lastname-field" id="lastname-field" class="input-1" type="text" placeholder="กรอกนามสกุล" required />
								</section>
							</div>
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
							<!-- Password FIELD -->
							<div class="form-field">
								<label for="password-repeat-field" class="label--required">ยืนยันรหัสผ่าน</label>
								<section>
									<i class="fas fa-unlock-alt"></i>
									<input name="password-repeat-field" id="password-repeat-field" class="input-1" type="password" placeholder="ยืนยันรหัสผ่านอีกครั้ง" required />
								</section>
							</div>
							<!-- Rule FIELD -->
							<div class="form-field form-check">
								<section>
								    <input name="checkbox-field" id="checkbox-field" class="input-1" type="checkbox" required />
									<label for="checkbox-field" class="label--required">ยอมรับข้อกำหนดของเรา</label>																									
								</section>
								<a href="/นโยบายความเป็นส่วนตัว/">นโยบายความเป็นส่วนตัว และเงื่อนไขการใช้งาน</a>
							</div>
							<div class="box-btn-form">
								<button type="submit" class="btn btn-submit"><i class="fas fa-user-plus"></i> สมัครสมาชิก</button>
								<input type="hidden" name="check-hidden" value="passed">
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
    window.alert('คุณได้เข้าสู่ระบบแล้ว');
    window.location.href='". get_home_url() ."';
    </script>");
} ?>

<?php get_footer(); ?>
