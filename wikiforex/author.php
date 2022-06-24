<?php
get_header();

// the_author_meta('ID');

$author =  get_queried_object();

$name = get_user_option( 'display_name', $author->ID );
$email = get_user_option( 'user_email', $author->ID );
$status = get_field('status_authentication', 'user_'. $author->ID );
$tel = get_field('telephone_number', 'user_'. $author->ID );

if(!is_user_logged_in())
			{
				echo ("<script LANGUAGE='JavaScript'>
				window.alert('กรุณาเข้าสู่ระบบก่อนเข้าใช้งาน');
				window.location.href='". get_home_url() ."/login/';
				</script>");
			}else{
?>
<div class="my_author">
<div class="s-container">
	<div id="primary" class="content-area">
		<main id="main" class="site-main site-author">
			<header class="author-head" id="author_profile_info">
				<div class="header_account">
					<div class="image_account">
						<div class="image">
                            <?php if ( $author->ID ) : ?>
                                <img src="<?php echo esc_url( get_avatar_url( $author->ID ) ); ?>" />
                            <?php endif; ?>
                        </div>
					</div>
					<div class="name_account">
					<h3><?php echo $name;?></h3>
					<p class="tel_author">เบอร์โทรศัพท์: <?php echo $tel;?></p>
					<div class="btn-group">
						<!-- <a href="" class="btn-edit">แก้ไขข้อมูล</a> -->
						<?php if($status !== 'pass'): ?>
						<a href="<?php echo get_home_url() .'/otp/'; ?>" class="btn-logout">ยืนยันตัวตน</a>
						<?php endif; ?>
						<a href="<?php echo wp_logout_url( home_url() . '/login/' ); ?>" class="btn-logout">ออกจากระบบ</a>						
					</div>
					<?php if ($_GET['msg2']): ?>
					<div class="alert alert-success author_info" role="alert">
						<i class="fa fa-check-circle" aria-hidden="true"></i> <?php echo $_GET['msg2']; ?>
					</div>
					<?php endif; ?>
					</div>
					<div class="verified">
					<h3><i class="far fa-check-circle"></i> การยืนยันตัวตน</h3>
					<?php if($status == 'pass'): ?>
						<div class="box-verified">
							<div class="img">
							<img src="/wp-content/uploads/2020/08/safety.png" class="img_verified" alt="Pass">
							</div>
							<div class="pass">
								<p>ได้รับการยืนยันตัวตน</p>
								<span class="text">สามารถใช้งานระบบของเรา</span>
							</div>
						</div>
					<?php else: ?>
						<div class="box-verified box-notpass">
							<div class="img">
							<img src="/wp-content/uploads/2020/08/error.png" class="img_verified" alt="notPass">
							</div>
							<div class="pass notpass">
								<p>ยังไม่ได้ยืนยันตัวตน</p>
								<span class="text">ไม่สามารถใช้งานได้</span>
							</div>
						</div>
					<?php endif; ?>
					<div class="button_add">
                        <a href="/post-disclosure/"><i class="far fa-plus-square"></i> แจ้งเรื่องร้องเรียน</a>
                    </div>
					</div>
				</div>
			</header><!--author-->

			<div id="primary-main" class="main-description-author">
					<div class="main_archive">
					  <?php 
					      $loop = new WP_Query( array(
							'posts_per_page'    => 6,
							'post_type'         => 'disclosure',
							'orderby'           => 'date',
							'order'             => 'DESC',
							'author'			=> $author->ID
						) );
					
						if( ! $loop->have_posts() ) {
							return false;
						}
						?>
						<div class="post_box_author">
							<h3 class="head_author">เรื่องร้องเรียน</h3>
						<div class="post_box">
							<?php
							while( $loop->have_posts() ) {
								$loop->the_post();
								get_template_part( 'template-parts/content','disclosure_card');
							}
							wp_reset_postdata();
							?>
						</div>						
					</div>
					<div class="side-bar">	
						<div class="box-side">
							<h3 class="head_author">มีการร้องเรียนสูงสุดในสัปดาห์นี้</h3>			
							<?php echo do_shortcode( '[ranking_disclosure]' ); ?>
						</div>	
						<div class="box-side">
							<h3 class="head_author">อันดับโบรกเกอร์ที่ดีที่สุด</h3>			
							<?php echo do_shortcode( '[shortcode_ranking]' ); ?>
						</div>
						
					</div>
			</div>
		</main><!-- #main -->
	</div><!-- #primary -->
</div><!--container-->
</div>
<?php } 
get_footer(); ?>
