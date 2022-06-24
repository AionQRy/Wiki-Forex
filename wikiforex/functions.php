<?php
/**
 * Override seed_setup()
 */
/*
function fruit_setup() {
	add_theme_support( 'custom-logo', array(
		'width'       => 200,
		'height'      => 200,
		'flex-width' => true,
		) );
}
add_action( 'after_setup_theme', 'fruit_setup', 11);
*/



/**
 * Enqueue scripts and styles.
 */
function fruit_scripts() {

	wp_dequeue_style( 'seed-style');

	wp_enqueue_style( 'wiki-theme-css', get_stylesheet_uri() );
	wp_enqueue_script( 'wiki-theme-js', get_stylesheet_directory_uri() . '/js/main.js', array(), '2020-1', true );

}
add_action( 'wp_enqueue_scripts', 'fruit_scripts' , 20 );

function add_font_ai(){
	wp_enqueue_style( 'ai-catamaran-font-style', get_stylesheet_directory_uri() . '/vendor/fonts/catamaran/stylesheet.css', true );
	wp_enqueue_style( 'ai-sarabun-font-style', get_stylesheet_directory_uri() . '/vendor/fonts/sarabun/stylesheet.css', true );
    // wp_enqueue_style( 'ai-kanit-font-style', get_stylesheet_directory_uri() . '/vendor/fonts/kanit/stylesheet.css', true );
}
add_action( 'wp_enqueue_scripts', 'add_font_ai' );

function get_excerpt($limit, $source = null){

    $excerpt = $source == "content" ? get_the_content() : get_the_excerpt();
    $excerpt = preg_replace(" (\[.*?\])",'',$excerpt);
    $excerpt = strip_shortcodes($excerpt);
    $excerpt = strip_tags($excerpt);
    $excerpt = substr($excerpt, 0, $limit);
    $excerpt = substr($excerpt, 0, strripos($excerpt, " "));
    $excerpt = trim(preg_replace( '/\s+/', ' ', $excerpt));
    return $excerpt;
}

add_filter( 'wp_list_categories', 'replace_current_cat_css_class' );

function replace_current_cat_css_class( $html ) {
    return str_replace( 'current-cat', 'active', $html );
}

function register_shortcodes() {
	add_shortcode( 'search_broker', 'search_broker' );
	add_shortcode( 'search_broker_two', 'search_broker_two' );
	add_shortcode( 'brokerpost', 'shortcode_broker_post' );
	add_shortcode( 'post_recent', 'singlepost_recent' );
	add_shortcode( 'feature_one', 'feature_broker_one' );
	add_shortcode( 'feature_list', 'feature_broker_list' );
	add_shortcode( 'relation_post', 'relationship_post' );
	add_shortcode( 'post_tab', 'post_tab' );
	add_shortcode( 'recent_post_home', 'recent_post_home' );
	add_shortcode( 'menu_header_user', 'menu_header_user' );
	add_shortcode( 'shortcode_ranking', 'shortcode_ranking' );
	add_shortcode( 'ranking_disclosure', 'shortcode_ranking_disclosure' );
	add_shortcode( 'redirect_page', 'redirect_page' );
}
add_action( 'init', 'register_shortcodes' );

function redirect_page(){
	ob_start();
	  echo get_home_url() . '/disclosure/';
	  $myvariablex = ob_get_clean();
	  return $myvariablex;
}

function search_broker(){
	ob_start();
		//[search_broker type="search_broker" posts="-1" id="10"]
		// define attributes and their defaults
		$count_posts = wp_count_posts( 'broker' )->publish;
		$term = get_term( 34, 'broker_category' );//for example uncategorized category		
	?>
	<div class="box_manage">
		<div class="search_count">
			<h3><?php echo $count_posts; ?></h3>
			<p>รายชื่อโบรกเกอร์</p>
		</div>
		<div class="search_count">
			<p>ร่วมมือกับหน่วยงานกำกับดูแล</p>
			<h3><?php echo $term->count; ?></h3>
		</div>
	</div>
	<div class="search_main two_broker home_search_box">
	<form method="post" class="search-container" action="<?php echo home_url( '/search-result/' ); ?>">
		<input type="text" name="keywords" id="search-bar" placeholder="ค้นหา โบร์กเกอร์ที่คุณต้องการ">
		<input type="hidden" name="s-object" value="passed">
		<button type="submit"><i class="fas fa-search"></i></button>
	</form>
	  <div id="data_box">
		  <ul id="datafetch" class="box_result_search"></ul>
	  </div>
	</div>
	<?php
	  $myvariablex = ob_get_clean();
	  return $myvariablex;
}

function search_broker_two(){
	ob_start();
		//[search_broker type="search_broker" posts="-1" id="10"]
		// define attributes and their defaults
	?>
	<div class="search_main two_broker">
	<form method="post" class="search-container" action="<?php echo home_url( '/search-result/' ); ?>">
		<input type="text" name="keywords" id="search-bar" placeholder="ค้นหา โบร์กเกอร์ที่คุณต้องการ">
		<input type="hidden" name="s-object" value="passed">
		<button type="submit"><i class="fas fa-search"></i></button>
	</form>
	  <div id="data_box">
		  <ul id="datafetch" class="box_result_search"></ul>
	  </div>
	</div>
	<?php
	  $myvariablex = ob_get_clean();
	  return $myvariablex;
}

function shortcode_broker_post( $atts ) {
	ob_start();
    global $wp_query,
        $post;

    $atts = shortcode_atts( array(
		'numberpost' => ''
        // 'line' => ''
    ), $atts );

    $loop = new WP_Query( array(
        'posts_per_page'    => sanitize_title( $atts['numberpost'] ),
        'post_type'         => 'broker',
        'orderby'           => 'menu_order title',
        'order'             => 'ASC'
        // 'tax_query'         => array( array(
        //     'taxonomy'  => 'broker_category',
        //     'field'     => 'slug',
        //     'terms'     => array( sanitize_title( $atts['line'] ) )
        // ) )
    ) );

    if( ! $loop->have_posts() ) {
        return false;
    }
	?>
	<div class="recent-broker_list">
	<?php
    while( $loop->have_posts() ) {
		$loop->the_post();
        get_template_part( 'template-parts/content','broker_list');
    }
	wp_reset_postdata();
	?>
	</div>
	<?php
	$myvariablex = ob_get_clean();
	return $myvariablex;
}

function singlepost_recent( $atts ) {
	ob_start();
    global $wp_query,
        $post;

    $atts = shortcode_atts( array(
		'numberpost' => ''
    ), $atts );

    $loop = new WP_Query( array(
        'posts_per_page'    => sanitize_title( $atts['numberpost'] ),
        'post_type'         => 'post',
        'orderby'           => 'date',
        'order'             => 'DESC'
    ) );

    if( ! $loop->have_posts() ) {
        return false;
    }
	?>
	<div class="recent-post_list">
	<?php
    while( $loop->have_posts() ) {
        $loop->the_post();
        get_template_part( 'template-parts/content','post_recent');
    }
	wp_reset_postdata();
	?>
	</div>
	<?php
	$myvariablex = ob_get_clean();
	return $myvariablex;
}

function feature_broker_one( $atts ) {
	ob_start();
    global $wp_query,
        $post;

    $atts = shortcode_atts( array(
		'numberpost' => ''
    ), $atts );

    $loop = new WP_Query( array(
        'posts_per_page'    => sanitize_title( $atts['numberpost'] ),
        'post_type'         => 'broker',
        'orderby'           => 'date',
		'order'             => 'DESC',
		'meta_query' => array(
			array(
				'key'     => 'broker_feature',
				'value'   =>  'yes',
				'compare' => 'LIKE',
			),
		)
    ) );

    if( ! $loop->have_posts() ) {
        return false;
    }
	?>
	<div class="feature_broker">
	<?php
    while( $loop->have_posts() ) {
        $loop->the_post();
        get_template_part( 'template-parts/content','broker_list');
    }
	wp_reset_postdata();
	?>
	</div>
	<?php
	$myvariablex = ob_get_clean();
	return $myvariablex;
}

function feature_broker_list( $atts ) {
	ob_start();
    global $wp_query,
        $post;

    $atts = shortcode_atts( array(
		'numberpost' => ''
    ), $atts );

    $loop = new WP_Query( array(
        'posts_per_page'    => sanitize_title( $atts['numberpost'] ),
        'post_type'         => 'broker',
        'orderby'           => 'date',
		'order'             => 'DESC',
		'meta_query' => array(
			array(
				'key'     => 'broker_feature',
				'value'   =>  'yes',
				'compare' => 'LIKE',
			),
		)
    ) );

    if( ! $loop->have_posts() ) {
        return false;
    }
	?>
	<div class="recent-broker_list feature_broker_list">
	<?php
    while( $loop->have_posts() ) {
        $loop->the_post();
        get_template_part( 'template-parts/content','broker_list');
    }
	wp_reset_postdata();
	?>
	</div>
	<?php
	$myvariablex = ob_get_clean();
	return $myvariablex;
}

function post_tab( $atts ) {
	ob_start();
    global $wp_query,
        $post;

    $atts = shortcode_atts( array(
		'numberpost' => '',
		'catpost' => ''
    ), $atts );

    $loop = new WP_Query( array(
        'posts_per_page'    => sanitize_title( $atts['numberpost'] ),
        'post_type'         => 'post',
        'orderby'           => 'date',
		'order'             => 'DESC',
		'tax_query'         => array( array(
            'taxonomy'  => 'category',
            'field'     => 'slug',
            'terms'     => array( sanitize_title( $atts['catpost'] ) )
        ) )
    ) );

    if( ! $loop->have_posts() ) {
        return false;
    }
	?>
	<div class="post_by_category">
	<?php
    while( $loop->have_posts() ) {
        $loop->the_post();
        get_template_part( 'template-parts/content','post_home');
    }
	wp_reset_postdata();
	?>
	</div>
	<?php
	$myvariablex = ob_get_clean();
	return $myvariablex;
}

/*ranking broker*/
function shortcode_ranking( $atts ) {
	ob_start();
	$featured_posts = get_field('ranking_broker', 'option');
	if( $featured_posts ):
	$i = 1; ?>
	<div class="box-rank">
		<ul>
		<?php foreach( $featured_posts as $featured_post ):
			$permalink = get_permalink( $featured_post->ID );
			$title = get_the_title( $featured_post->ID );
			$icon_broker = get_field( 'icon_broker', $featured_post->ID );
			?>
			<li>
				<?php
				 if ( $icon_broker ) {
					 echo '<a href="'. esc_url( $permalink ) .'">';
					 echo '<img src="' . $icon_broker['url']
					 . '" alt="' . $icon_broker['alt'] . '" />';
					 echo '</a>';
				 }else{
					 echo '<a href="'. esc_url( $permalink ) .'">';
			 		 echo '<img src="' . get_stylesheet_directory_uri()
					 . '/images/thumbnail-default.jpg" />';
					 echo '</a>';
				 }
				?>
				<a href="<?php echo esc_url( $permalink ); ?>"><?php echo esc_html( $title ); ?></a>
				<span class="number_rank"><?php echo $i++; ?></span>
			</li>
		<?php endforeach; ?>
		</ul>
	</div>
	<?php endif;
	$myvariablex = ob_get_clean();
	return $myvariablex;
}
/*end*/

/*ranking disclosure*/
function shortcode_ranking_disclosure( $atts ) {
	ob_start();
	$featured_posts = get_field('ranking_disclosure', 'option');
	if( $featured_posts ):
	$i = 1; ?>
	<div class="box-rank">
		<ul>
		<?php foreach( $featured_posts as $featured_post ):
			$permalink = get_permalink( $featured_post->ID );
			$title = get_the_title( $featured_post->ID );
			$icon_broker = get_field( 'icon_broker', $featured_post->ID );
			?>
			<li>
				<?php
				 if ( $icon_broker ) {
					 echo '<a href="'. esc_url( $permalink ) .'">';
					 echo '<img src="' . $icon_broker['url']
					 . '" alt="' . $icon_broker['alt'] . '" />';
					 echo '</a>';
				 }else{
					 echo '<a href="'. esc_url( $permalink ) .'">';
			 		 echo '<img src="' . get_stylesheet_directory_uri()
					 . '/images/thumbnail-default.jpg" />';
					 echo '</a>';
				 }
				?>
				<a href="<?php echo esc_url( $permalink ); ?>"><?php echo esc_html( $title ); ?></a>
				<span class="number_rank"><?php echo $i++; ?></span>
			</li>
		<?php endforeach; ?>
		</ul>
	</div>
	<?php endif;
	$myvariablex = ob_get_clean();
	return $myvariablex;
}
/*end*/

function recent_post_home( $atts ) {
	ob_start();
    global $wp_query,
        $post;

    $atts = shortcode_atts( array(
		'numberpost' => ''
    ), $atts );

    $loop = new WP_Query( array(
        'posts_per_page'    => sanitize_title( $atts['numberpost'] ),
        'post_type'         => 'post',
        'orderby'           => 'date',
		'order'             => 'DESC'
    ) );

    if( ! $loop->have_posts() ) {
        return false;
    }
	?>
	<div class="post_by_category">
	<?php
    while( $loop->have_posts() ) {
        $loop->the_post();
        get_template_part( 'template-parts/content','post_home');
    }
	wp_reset_postdata();
	?>
	</div>
	<?php
	$myvariablex = ob_get_clean();
	return $myvariablex;
}

function relationship_post() {
	ob_start();
    global $wp_query,
        $post;

		$postsxxx = get_field('relationship_post', get_the_ID() );

		if( $postsxxx ): ?>
			<ul>
			<?php foreach( $postsxxx as $p ): // variable must NOT be called $post (IMPORTANT) ?>
				<li>
					<a href="<?php echo get_permalink( $p->ID ); ?>"><?php echo get_the_title( $p->ID ); ?></a>
					<span>Custom field from $post: <?php the_field('author', $p->ID); ?></span>
				</li>
			<?php endforeach; ?>
			</ul>
		<?php endif; ?>
	<?php
	$myvariablex = ob_get_clean();
	return $myvariablex;
}
/*register*/
function register_account(){
	$err = '';
  	$success = '';

  	global $wpdb, $PasswordHash, $current_user, $user_ID;

  if(isset($_POST['check-hidden']) && $_POST['check-hidden'] == 'passed' ) {
	if($_REQUEST['redirect']) {
		$current_url = $_REQUEST['redirect'];
	} else {
		$current_url = home_url(add_query_arg(array(),$wp->request));
	}

  	$pwd1 = $wpdb->escape(trim($_POST['password-field']));
  	$pwd2 = $wpdb->escape(trim($_POST['password-repeat-field']));
  	$first_name = $wpdb->escape(trim($_POST['name']));
  	$last_name = $wpdb->escape(trim($_POST['last-name']));
  	$email = $wpdb->escape(trim($_POST['email-field']));

  // 	if( $email == "" || $pwd1 == "" || $pwd2 == "" || $username == "" || $first_name == "" || $last_name == "") {
  	if( $email == "" || $pwd1 == "" || $pwd2 == "" || $first_name == "" || $last_name == "") {
  		$err1 = 'กรุณากรอกข้อมูลให้ครบถ้วน';
      ?>
      <script type="text/javascript">
       alert("<?php echo $err1;?>");
       window.location ='<?php echo $current_url;?>';
      </script>
  <?php
  	} else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  		$err2 = 'อีเมลไม่ถูกต้อง';
      ?>
      <script type="text/javascript">
       alert("<?php echo $err2;?>");
       window.location ='<?php echo $current_url;?>';
      </script>
  <?php
  	} else if(email_exists($email) ) {
  		$err3 = 'อีเมลถูกใช้แล้ว';
      ?>
      <script type="text/javascript">
       alert("<?php echo $err3;?>");
       window.location ='<?php echo $current_url;?>';
      </script>
  <?php
  	} else if($pwd1 <> $pwd2 ){
  		$err4 = 'รหัสผ่านไม่เหมือนกันกรุณาลองใหม่อีกครั้ง';
      ?>
      <script type="text/javascript">
       alert("<?php echo $err4;?>");
       window.location ='<?php echo $current_url;?>';
      </script>
  <?php
  	} else {
		$object_user = array ( //default wordpress wp_users
			'first_name' => apply_filters('pre_user_first_name', $first_name),
			'last_name' => apply_filters('pre_user_last_name', $last_name),
		    'user_pass' => apply_filters('pre_user_user_pass', $pwd1),
		    'user_login' => apply_filters('pre_user_user_login', $email),
			'user_email' => apply_filters('pre_user_user_email', $email),
			'remember' => true,
			'role' => 'subscriber' );
  		$user_id = wp_insert_user($object_user);

  		if( is_wp_error($user_id) ) {
  			$errss = 'ไม่สำเร็จกรุณาลองใหม่อีกครั้ง';
        ?>
        <script type="text/javascript">
         alert("<?php echo $errss;?>");
         window.location ='<?php echo $current_url;?>';
        </script>
        <?php
  		} else {
        $sawaddee = 'คุณได้สมัครสมาชิกเรียบร้อยแล้ว';
        ?>
        <script type="text/javascript">
         alert("<?php echo $sawaddee;?>");
         window.location ='/index.php';
        </script>
        <?php
		update_field( 'field_5f2399877f296', 'notpass', 'user_'.$user_id );
    		}
			do_action('user_register', $user_id);
		}
		// $user = wp_signon( $object_user , false );
		// 	$objectID = $user->ID;

		// 	wp_set_current_user( $objectID, $email );
		// 	wp_set_auth_cookie( $objectID, true , false );

		// 	do_action('wp_login', $email);

	}
}
add_action( 'init', 'register_account' );

function auto_login_new_user( $user_id ) {
	wp_set_auth_cookie( $user_id, false, is_ssl() );
  }
  add_action( 'user_register', 'auto_login_new_user' );
/*Header Menu User*/
function menu_header_user() {
	ob_start();
    global $wp_query,
        $post;
		$userID = get_current_user_id();
		$name = get_user_option( 'user_firstname', $userID );
		if( is_user_logged_in() ): ?>
		<div class="box-account">
			<a href="<?php echo get_author_posts_url( $userID ); ?>">
				<div class="author_name">
					<div class="image_account">
						<div class="image">
							<?php if ( $userID ) : ?>
								<img src="<?php echo esc_url( get_avatar_url( $userID ) ); ?>" />
							<?php endif; ?>
						</div>
					</div>
					<div class="name_account">
						<h3><?php echo $name;?></h3>
					</div>
				</div>
			</a>
			<div class="box_menu_account">
				<ul class="menu_setting">
					<li>
						<span><span class="title_setting">ตั้งค่า</span><i class="fas fa-cogs"></i></span>
						<ul class="sub-menu">
							<li><a href="<?php echo get_author_posts_url( $userID ); ?>">ตั้งค่าข้อมูลผู้ใช้</a></li>
							<li><a href="<?php echo wp_logout_url( home_url() . '/login/' ); ?>">ออกจากระบบ</a></li>
						</ul>
					</li>
				</ul>
			</div>
		</div>
		<?php endif; ?>
	<?php
	$myvariablex = ob_get_clean();
	return $myvariablex;
}

/* check page id */
function send_otp(){
	if(isset($_POST['otp-hidden']) && $_POST['otp-hidden'] == 'passed' ) {
		
		$newtel = $_POST['tel-field'];   
		if(!empty($newtel)){
			include("sms.class.php");

			$err = '';
			$success = '';

			global $wpdb, $PasswordHash, $current_user;
			$author =  wp_get_current_user();
			$user_id = $author->ID;	           
			// WP_User_Query arguments
			$args = array (
				'role__in' => array('subscriber'),
				'order' => 'ASC',
				// 'search' => '*'.esc_attr( $search_term ).'*',
			);			
			// Create the WP_User_Query object
			$wp_user_query = new WP_User_Query($args);		
			// Get the results
			$authors = $wp_user_query->get_results();
				foreach ($authors as $authorx)
				{            
					// echo 'tel:'.$telephone;	             
					// get all the user's data
					$author_info = get_userdata($authorx->ID);
					$telephone = get_field('telephone_number', 'user_'.$authorx->ID);

					if($newtel == $telephone){
						echo ("<script LANGUAGE='JavaScript'>
								window.alert('เบอร์ของท่านถูกใช้ในการยืนยันแล้ว กรุณากรอกใหม่อีกครั้ง');
								window.location.href='". get_home_url() ."/otp/';
								</script>");			
					break;			
					}	
				
					if ( $newtel != $telephone) {
						$gennaretion = get_field('generate_number', 'user_'. $userid);
						$status = get_field('status_authentication' , 'user_'. $userid );
						$gennaretion = get_field('telephone_number', 'user_'. $userid);
						if(!is_user_logged_in())
						{
							echo ("<script LANGUAGE='JavaScript'>
							window.alert('กรุณาเข้าสู่ระบบก่อนเข้าใช้งาน');
							window.location.href='". get_home_url() ."/login/';
							</script>");
						}
						if($status == 'pass'){
							echo ("<script LANGUAGE='JavaScript'>
							window.alert('คุณได้ยืนยันตัวตนแล้ว');
							window.location.href='". get_home_url() ."';
							</script>");
						}
						$otp = rand(100000, 999999);

						update_field( 'field_5f2b892bd48c4', $_POST['tel-field'], 'user_'.$user_id );
						update_field( 'field_5f2399337f295', $otp, 'user_'.$user_id );

						//$_COOKIE['otp_code'] = $otp;

						$_REQUEST['username']= '0897474552';
						$_REQUEST['password'] = 'Bb123456';
						$_REQUEST['msisdn'] = $_POST['tel-field'];
						$_REQUEST['message'] = 'รหัส OTP ของคุณคือ: ' . $otp;
						$_REQUEST['sender'] = 'THAIBULKSMS';
						$_REQUEST['ScheduledDelivery'] = date('YmdHi');
						$_REQUEST['force'] = 'premium';

						$username = $_REQUEST['username'];
						$password = $_REQUEST['password'];
						$msisdn = $_REQUEST['msisdn'];
						$message = $_REQUEST['message'];
						$sender = $_REQUEST['sender'];
						$ScheduledDelivery = $_REQUEST['ScheduledDelivery'];
						$force = $_REQUEST['force'];

						$resultxx = sms::send_sms($username,$password,$msisdn,$message,$sender,$ScheduledDelivery,$force);		
					break;	
				}
																							
				}					

		}else{
			return home_url() . '/otp/';
		}
	}else{
		return home_url() . '/otp/';
	}
}
add_action('init', 'send_otp');

function otp_confirm_script() {

	global $wp_query;

	// In most cases it is already included on the page and this line can be removed
	wp_enqueue_script('jquery');

	// register our main script but do not enqueue it yet
	wp_register_script( 'otp_confirm', get_stylesheet_directory_uri() . '/js/otp-confirm.js', array('jquery') );

	// now the most interesting part
	// we have to pass parameters to myloadmore.js script but we can get the parameters values only in PHP
	// you can define variables directly in your HTML but I decided that the most proper way is wp_localize_script()
	wp_localize_script( 'otp_confirm', 'otp_confirm_params',
	array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );

	 wp_enqueue_script( 'otp_confirm' );
  }

  add_action( 'wp_enqueue_scripts', 'otp_confirm_script' );

/* check page id */
function confirm_otp(){

	if(isset($_POST['otp-confirm']) && $_POST['otp-confirm'] == 'passed' ) {
		$otp_field = $_POST['otp-field'];

		if($otp_field){
			$err = '';
			$success = '';

			global $wpdb, $PasswordHash, $current_user;

			$gennaretion = get_field('generate_number', 'user_'. get_current_user_id());
			$status = get_field('status_authentication' , 'user_'. get_current_user_id() );
			$telephone_number = get_field('telephone_number', 'user_'. get_current_user_id());

			if ($otp_field == $gennaretion) {

				update_field( 'field_5f2399877f296', 'pass', 'user_'. get_current_user_id() );
				echo json_encode(array("type"=>"success", "message"=>"การยืนยันตัวตนสำเร็จ", "url" => get_home_url() ));
				// $result['type'] = "success";
				// $result['message'] = 'Your mobile number is verified!';
			}else{
				//echo $otp_field . '!==' . $gennaretion;
				echo json_encode(array("type"=>"error", "message"=>"มีข้อผิดพลาดกรุณากรอกใหม่อีกครั้ง" ));
				// $result['type'] = "error";
				// $result['message'] = 'Mobile number verification failed';
			}
			//echo json_encode($result);
		}
	}

	wp_die();
}
add_action('wp_ajax_otp_confirm', 'confirm_otp'); // wp_ajax_{action}
add_action('wp_ajax_nopriv_otp_confirm', 'confirm_otp'); // wp_ajax_nopriv_{action}

function my_acf_op_init() {

    // Check function exists.
    if( function_exists('acf_add_options_page') ) {

        // Add parent.
        $parent = acf_add_options_page(array(
            'page_title'  => __('Theme General Settings'),
            'menu_title'  => __('Theme Settings'),
			'redirect'    => false,
			'menu_slug' 	=> 'theme-general-settings'
        ));

        // Add sub page.
        $child = acf_add_options_page(array(
            'page_title'  => __('Ranking Broker'),
            'menu_title'  => __('Ranking Broker'),
			'parent_slug' => $parent['menu_slug'],
			'menu_slug' 	=> 'ranking-broker',
		));
		//Add sub page.
        $child = acf_add_options_page(array(
            'page_title'  => __('Ranking Disclosure'),
            'menu_title'  => __('Ranking Disclosure'),
			'parent_slug' => $parent['menu_slug'],
			'menu_slug' 	=> 'ranking-disclosure',
        ));
    }
}
add_action('acf/init', 'my_acf_op_init');

function custom_type_archive_display($query) {
    if (is_post_type_archive('broker')) {
         $query->set('posts_per_page',30);
         $query->set('orderby', 'date' );
         $query->set('order', 'DESC' );
        return;
    }
}
add_action('pre_get_posts', 'custom_type_archive_display');

function search_broker_script() {

	global $wp_query;

	// In most cases it is already included on the page and this line can be removed
	wp_enqueue_script('jquery');

	// register our main script but do not enqueue it yet
	wp_register_script( 'search_broker_x', get_stylesheet_directory_uri() . '/js/search-broker.js', array('jquery') );

	// now the most interesting part
	// we have to pass parameters to myloadmore.js script but we can get the parameters values only in PHP
	// you can define variables directly in your HTML but I decided that the most proper way is wp_localize_script()
	wp_localize_script( 'search_broker_x', 'search_broker_params',
	array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );

	wp_enqueue_script( 'search_broker_x' );
   }
   add_action( 'wp_enqueue_scripts', 'search_broker_script' );

   function broker_form(){


 	$store_arr["results"]=array();


	if ($_POST['keywords'] != '') {
		$loop = new WP_Query( array(
			'posts_per_page' => -1,
			's' => esc_attr( $_POST['keywords'] ),
			'post_type' => 'broker',
			'orderby' => 'title',
			'order'   => 'DESC'
		) );

		if( $loop->have_posts() ){
			while( $loop->have_posts() ) {
				$loop->the_post();
				$icon_broker = get_field( 'icon_broker' );
				// echo $icon_broker['url'];
				$data = array(
					"id"=> get_the_ID(),
					"link" => get_permalink() ,
					"title" => get_the_title(),
					"logo" => $icon_broker['url']
				);




				array_push($store_arr["results"], $data);

				// $data = array();
				// $data['id'] = array( get_the_ID() );
				// echo json_encode($data);

			}
			echo json_encode( $store_arr );
			wp_reset_postdata();
		}else{

			$data = array(
				"title" => 'ไม่พบคำที่คุณค้นหา'
			);

			array_push($store_arr["results"], $data);
			echo json_encode( $store_arr );


		}
	
	}
	else {
		$data = array(
			"title" => ''
		);

		array_push($store_arr["results"], $data);
		echo json_encode( $store_arr );
	}

	die();

}
// the ajax function
add_action('wp_ajax_broker_form' , 'broker_form');
add_action('wp_ajax_nopriv_broker_form','broker_form');
/*end*/
?>
