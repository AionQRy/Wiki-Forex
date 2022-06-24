<?php 
/**
 * Template Name: Check Page
 */
get_header();
$userid = get_current_user_id();
$gennaretion = get_field('generate_number', 'user_'. $userid);
$status = get_field('status_authentication' , 'user_'. $userid );
// echo $gennaretion;
// echo '<br>';
// echo $status;
if( is_page_template( 'page-check.php' ) ){
	if( is_user_logged_in() ){
		if($status == 'notpass'){
			echo ("<script LANGUAGE='JavaScript'>
			window.alert('โปรดยืนยันตัวตนก่อนเข้าใช้งาน');
			window.location.href='". get_home_url() ."/otp/';
			</script>");
		}
	}else{
		echo ("<script LANGUAGE='JavaScript'>
		window.alert('กรุณาเข้าสู่ระบบ');
		window.location.href='". get_home_url() ."/login/';
		</script>");
	}
}
 ?>
<div class="container checkpage">
	<div id="primary" class="content-area">
		<main id="main" class="site-main -hide-title">

			<?php while ( have_posts() ) : the_post(); ?>
				
				<?php get_template_part( 'template-parts/content', 'page' ); ?>
			

			<?php endwhile; // End of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

</div><!--container-->
<?php get_footer(); ?>
