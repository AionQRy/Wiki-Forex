<?php
/**
 * Loop Name: Content Broker Single
 */
$logo_flag = get_field('flag_country');
$url_broker = get_field('url_broker'); 
$register_broker = get_field('register_broker');
$moderate = get_field('moderate');
$image_feature = get_field('image_feature');
$all_score_broker = get_field('all_score_broker');
$license_index = get_field('license_index');
$license_business = get_field('license_business');
$risk_management_index = get_field('risk_management_index');
$software_index = get_field('software_index');
$regulatory_index = get_field('regulatory_index');
?>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<article id="post-<?php the_ID(); ?>" <?php post_class('content-single'); ?>>
    <header id="header-broker" class="header-broker">
        <div class="s-container">
            <div class="main_content">
                <div class="box-image_broker col_broker <?php if($moderate == 'pass'){ echo 'pass'; }elseif($moderate == 'notpassed'){ echo 'notpassed';}
                else{ echo 'waiting';} ?>">
                <?php 
                    if($moderate == 'pass'){
                        $status_moderate = 'อยู่ภายใต้หน่วยงานดูแล'; 
                        $moderate_color = '#2BB351';
                    }elseif($moderate == 'notpassed'){
                        $status_moderate = 'ยังไม่อยู่ภายใต้หน่วยงานดูแล';
                        $moderate_color = '#e85e4f';
                    } else{
                        $status_moderate = 'อยู่ในระหว่างตรวจสอบ';
                        $moderate_color = '#ee760c';
                    } 
                ?>
                    <div class="image_class">
                        <span class="status_broker" style="background: <?php echo $moderate_color; ?>;">  
                            <?php echo $status_moderate; ?>
                        </span>
                        <?php 
                            if (has_post_thumbnail()) {
                                the_post_thumbnail( 'full', array( 'class' => 'image_borker') );
                            }else{
                                echo '<img src="' . get_stylesheet_directory_uri() 
                                . '/images/thumbnail-default.jpg" />';
                            }
                        ?>
                        <span class="popup_feature" style="border-color: <?php echo $moderate_color;?>;color: <?php echo $moderate_color;?>;">
                            <?php echo $status_moderate; ?>    
                        </span>
                    </div>

                </div>
                <div class="box-content_broker col_broker">
                    <div class="title_broker">
                        <?php the_title( '<h2 class="title-broker">', '</h2>' ); ?>                       
                    </div>
                    <div class="img_flag">
                        <?php
                            if ( $logo_flag ) {
                                echo '<img src="' . $logo_flag['url']
                                . '" alt="' . $logo_flag['alt'] . '" />';
                            }
                        ?>                      
                    </div>
                    <div class="content_broker">
                        <?php if ( have_rows('list_detail') ) : ?>
                            <ul class="list-content_broker">
                                <?php 
                                    while( have_rows('list_detail') ) : the_row();
                                    $list = get_sub_field('short_detail');
                                ?>
                                    <li>
                                    <?php echo $list; ?>
                                    </li>
                                <?php endwhile; ?>
                            </ul>
                        <?php else:?>
                            <p>ไม่มีข้อมูล</p>
                        <?php endif; ?>  
                    </div>     
                    <?php if ( $url_broker ) : ?>
                    <div class="website">                   
                        <p>เว็บไซต์ <span><?php echo $url_broker; ?></span></p> 
                    </div>
                    <?php endif; ?> 
                    <div class="box_button">
                    <?php if ( $register_broker ) : ?>
                        <a href="<?php echo $register_broker; ?>" class="register" target="_blank" rel="nofollow">สมัครสมาชิกออนไลน์</a>
                    <?php endif; ?>
                    <?php if ( $register_broker ) : ?>
                        <a href="<?php echo $register_broker; ?>" class="download" target="_blank" rel="nofollow">ดาวน์โหลดแพลตฟอร์มซื้อขาย</a>
                    <?php endif; ?>                       
                    </div>               
                                  
                </div>
                <div class="point col_broker">  
                    <div class="main_score <?php if(!$all_score_broker){ echo 'main_score_one';}?>">
                        <?php if(!empty($all_score_broker)):?>
                        <div class="score_box_one">                          
                            <h4>ให้คะแนน</h4>
                            <div class="all_score">
                                <h3 class="first"><?php echo $all_score_broker; ?></h3>
                                <h3 class="last">/10</h3>
                            </div>
                        </div>
                        <?php endif;?>
                        <div class="score_box_two">               
                            <div id="myChart"></div>
                        <?php 
                            $all_score_broker = get_field('all_score_broker');
                            $license_index = get_field('license_index');
                            $license_business = get_field('license_business');
                            $risk_management_index = get_field('risk_management_index');
                            $software_index = get_field('software_index');
                            $regulatory_index = get_field('regulatory_index');
                            $all_list = $license_index . $license_business . $risk_management_index . $software_index . $regulatory_index;
                            
                            // $all_list_array = array ($license_index, $license_business , $risk_management_index , $software_index , $regulatory_index);
                            // print_r($all_list_array);
                        ?>
                        <script>
                            var options = {
                                series: [{
                                name: 'สัดส่วนคะแนน',
                                data: [<?php echo $license_index; ?>,
                                               <?php echo $license_business; ?>,
                                               <?php echo $risk_management_index; ?>,
                                               <?php echo $software_index; ?>,
                                               <?php echo $regulatory_index; ?>
                                ]
                                }],
                                chart: {
                                type: 'bar',
                                fontFamily: 'Sarabun, sans-serif',
                                foreColor: "#fff",
                                toolbar: {
                                show: false
                                },
                                height: 230,
                                width: '100%'
                                },
                                plotOptions: {
                                bar: {
                                    horizontal: true,
                                }
                                },
                                dataLabels: {
                                    enabled: true,
                                    offsetX: -6,
                                    style: {
                                    fontSize: '12px',
                                    colors: ['#fff']
                                    }
          
                                },                            
                                stroke: {
                                show: false,
                                width: 1,
                                colors: ['#fff']
                                },     
                                fill: {
                                    colors: ['#2ab257']
                                }, 
                                                                                    
                                xaxis: {
                                    categories: ['ดัชนีใบอนุญาต', 'ดัชนีธุรกิจ', 'ดัชนีการจัดการความเสี่ยง', 'ดัชนีซอฟท์แวร์', 'ดัชนีการกำกับดูแล'],
                                    labels: {
                                        show: true,
                                        style: {
                                            colors: ['#fff'],
                                            fontSize: '16px',
                                            fontWeight: 400
                                        }
                                    },
                                }
                            };

                                var chart = new ApexCharts(document.querySelector("#myChart"), options);
                                chart.render();
      
                        </script>
                        </div>
                        
                    </div>                      
                </div>
            </div>        
        </div>              
    </header>
    <div class="box_content">
        <div class="s-container">
            <div class="main-box_content">
                <div class="aside_broker">                  
                    <div class="broker_check box_inside">
                        <h3>ข้อมูลการกำกับดูแล</h3>
                        <div class="box-list_check">
                            <?php if ( have_rows('repeat_broker') ) : ?>
                                <ul class="list_check">
                                    <?php 
                                        $i = 1;
                                        while( have_rows('repeat_broker') ) : the_row();
                                        $logo = get_sub_field('logo');
                                        $name = get_sub_field('name');
                                        $name_security = get_sub_field('name_security');
                                        $status = get_sub_field('status');
                                        $image_security = get_sub_field('image_security');                                       
                                    ?>
                                        <li class="object_list <?php if($status == 'pass'){ echo 'pass'; }elseif($status == 'notpassed'){ echo 'notpassed';}
                                         else{ echo 'waiting';} ?>" setid="<?php echo $i++;?>"">
                                            <div class="third_check">
                                                <div class="one_check sub-list_check">
                                                    <img src="<?php echo $logo['url']; ?>" alt="<?php echo $logo['alt']; ?>">
                                                </div>
                                                <div class="two_check sub-list_check">
                                                <?php 
                                                    if($status == 'pass'){
                                                        $status_status = 'อยู่ภายใต้หน่วยงานดูแล'; 
                                                        $status_color = '#2BB351';
                                                    }elseif($status == 'notpassed'){
                                                        $status_status = 'ยังไม่อยู่ภายใต้หน่วยงานดูแล';
                                                        $status_color = '#e85e4f';
                                                    } else{
                                                        $status_status = 'อยู่ในระหว่างตรวจสอบ';
                                                        $status_color = '#ee760c';
                                                    } 
                                                ?>
                                                    <div class="name">
                                                        <h4><?php echo $name; ?></h4>
                                                    </div>
                                                    <div class="name_security">
                                                        <p>
                                                            <span class="box_color" style="background: <?php echo $status_color; ?>">
                                                            <?php echo $name_security; ?>
                                                            </span>
                                                            <?php echo $status_status; ?>
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="three_check sub-list_check">
                                                    <span class="arrow_link"><i class="fas fa-chevron-right"></i></span>
                                                </div>
                                                <?php //if($image_security){
                                                    ?>
                                                     <!-- <div class="image_security">
                                                        <div class="img">
                                                            <img src="<?php echo $image_security['url'];?>" alt="<?php echo $image_security['title'];?>">
                                                        </div>
                                                    </div> -->
                                                    <?php
                                              //  } ?>                                              
                                            </div>                                    
                                        </li>
                                    <?php endwhile; ?>
                                </ul>
                            <?php else:?>
                                <div class="warning_box">
                                    <i class="fas fa-exclamation-circle"></i>
                                    <p>ยังไม่มีการยืนยันข้อมูลการกำกับดูแล</p>
                                    <p>โปรดระมัดระวังความเสี่ยงที่อาจจะเกิดขึ้น</p>
                                </div>
                            <?php endif; ?>                                 
                        </div>
                    </div>
                    <!--end block-->
                    <div class="broker_feature box_inside">
                        <div class="box-feature">
                        <?php
                            if ( $image_feature ) {
                                echo '<img src="' . $image_feature['url']
                                . '" alt="' . $image_feature['alt'] . '" />';
                            }else{
                                echo '<img src="' . get_stylesheet_directory_uri() 
                                . '/images/thumbnail-default.jpg" />';
                            }
                        ?>                                 
                        </div>
                    </div>
                </div>
                <div class="detail_broker">
                <?php if ( have_rows('warning') ) : ?>
                <div class="broker_warning box_inside">
                        <div class="box-list_warning"> 
                        <h3>Uhas เตือนความเสี่ยง</h3>                        
                        <?php while( have_rows('warning') ): the_row(); 
                        // Get sub field values.
                        $testing_time = get_sub_field('test_lasted');
                        $date = DateTime::createFromFormat('Ymd', $testing_time);
                        $the_risk = get_sub_field('the_risk');

                        ?>
                        <div class="box_warning_list">                         
                            <div id="testing_time">                         
                                <div class="testing_time_box">
                                    <p>การทดสอบครั้งที่แล้ว: <?php echo $testing_time; ?></p>
                                </div>
                                <div class="testing_count">
                                    <p class="text-show-1 p-2">คลิกเพื่อเปิดอ่าน</p>
                                    <p class="text-show-2 p-2">คลิกเพื่อปิด</p>
                                    <i class="fas fa-chevron-down"></i> 
                                    <i class="fas fa-chevron-up"></i>                                  
                                </div>                               
                            </div>
                            <?php if( have_rows('the_risk') ): ?>
                                <div class="exspend-risk">
                                    <ul class="list_risk_box">
                                    <?php while( have_rows('the_risk') ): the_row(); 
                                        $detail_risk = get_sub_field('detail_risk');                                   
                                        ?>
                                        <li>
                                            <p><i class="fas fa-chevron-right"></i><span class="text"><?php echo $detail_risk; ?></span></p>
                                        </li>
                                    <?php endwhile; ?>
                                    </ul>
                                </div>                            
                            <?php endif; ?>
                        </div>                      
                        <?php endwhile; ?>                                                    
                        </div>
                    </div>
                    <!--end block-->
                    <?php endif; ?>   
                    <div class="broker_assessment box_inside">
                        <h3>การให้คะแนนของเรา</h3>
                        <div class="box-list_assessment">
                            <?php if ( have_rows('assessment') ) : ?>
                                <ul class="list_assessment">
                                    <?php 
                                        while( have_rows('assessment') ) : the_row();
                                        $image_assessment = get_sub_field('image_assessment');
                                        $title = get_sub_field('title');
                                    ?>
                                        <li>
                                            <div class="make_list">
                                                <div class="img">
                                                    <img src="<?php echo $image_assessment['url']; ?>" alt="<?php echo $image_assessment['alt']; ?> ">                                                        
                                                </div>
                                                <div class="title">
                                                     <p><?php echo $title; ?></p>
                                                </div>                                               
                                            </div>                                      
                                        </li>
                                    <?php endwhile; ?>
                                </ul>
                            <?php else:?>
                                <div class="warning_box">
                                    <i class="fas fa-exclamation-circle"></i>
                                    <p>ยังไม่มีการข้อมูลมีการประเมิน</p>
                                    <p>โปรดระมัดระวังความเสี่ยงที่อาจจะเกิดขึ้น</p>
                                </div>
                            <?php endif; ?>                                 
                        </div>
                    </div>
                    <!--end block-->
                    <div class="broker_profile box_inside">
                        <h3>ข้อมูลบริษัท</h3>
                        <div class="box-list_profile">
                           <?php
                           /*profile*/
                            $name_company = get_field('name_company');
                            $country_register = get_field('country_register');
                            $email_gust = get_field('email_gust');
                            $nickname_company = get_field('nickname_company');
                            $phone_service = get_field('phone_service');
                            ?>
                                <ul class="list_profile">
                                    <?php if ( $name_company ) : ?>
                                        <li>
                                            <div class="title_profile">
                                                <i class="far fa-check-circle"></i>   
                                                <p>ชื่อเต็มของบริษัท :</p>
                                            </div>
                                            <div class="detail_profile">
                                                <p><?php echo $name_company; ?></p> 
                                            </div>                         
                                        </li>
                                        <?php endif; ?>  
                                        <?php if ( $nickname_company ) : ?> 
                                        <li>
                                            <div class="title_profile">
                                                <i class="far fa-check-circle"></i>   
                                                <p>ชื่อย่อบริษัท :</p>
                                            </div>
                                            <div class="detail_profile">
                                                <p><?php echo $nickname_company; ?></p>
                                            </div>                         
                                        </li>
                                        <?php endif; ?>  
                                            <?php if( have_rows('country_register') ): ?>
                                            <?php if( $name_country ): ?>
                                                <?php while( have_rows('country_register') ): the_row(); 

                                                    // Get sub field values.
                                                    $image_country = get_sub_field('image_country');
                                                    $name_country = get_sub_field('name_country');

                                                    ?>
                                                    <li>
                                                        <div class="title_profile">
                                                            <i class="far fa-check-circle"></i>   
                                                            <p>ประเทศที่จดทะเบียนของบริษัท :</p>
                                                        </div>
                                                        <div class="detail_profile">
                                                            <p><img src="<?php echo $image_country['url']; ?>" alt="<?php echo $image_country['alt']; ?> "><?php echo $name_country; ?></p>
                                                        </div>  
                                                    </li>
                                                <?php endwhile; ?>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                        <li>
                                            <div class="title_profile">
                                                <i class="far fa-check-circle"></i>   
                                                <p>สถานะในการกำกับดูแล :</p>
                                            </div>
                                            <div class="detail_profile">
                                                <p class="status_p" style="color: <?php echo $status_color; ?>"><?php echo $status_moderate; ?> </p>
                                            </div>                         
                                        </li>   
                                        <?php if ( $email_gust ) : ?>                                 
                                        <li>
                                            <div class="title_profile">
                                                <i class="far fa-check-circle"></i>   
                                                <p>อีเมลฝ่ายบริการลูกค้า :</p>
                                            </div>
                                            <div class="detail_profile">
                                                <p><?php echo $email_gust; ?></p>
                                            </div>                         
                                        </li>
                                        <?php endif; ?>
                                        <?php if ( $phone_service ) : ?>
                                        <li>
                                            <div class="title_profile">
                                                <i class="far fa-check-circle"></i>   
                                                <p>เบอร์โทรศัพท์ที่ให้บริการ :</p>
                                            </div>
                                            <div class="detail_profile">
                                                <p><?php echo $phone_service; ?></p>
                                            </div>                         
                                        </li>
                                        <?php endif; ?>                                 
                                </ul>
                                                      
                        </div>
                    </div>
                    <!--end block-->
                    <div class="broker_open box_inside">
                        <h3>เรื่องร้องเรียน</h3>
                        <div class="box-list_">
                           <?php
                            $loop = new WP_Query( array(
                                'posts_per_page'    => sanitize_title( $atts['numberpost'] ),
                                'post_type'         => 'disclosure',
                                'orderby'           => 'date',
                                'order'             => 'DESC',
                                'meta_query' => array(
                                    array(
                                        'key'     => 'broker_report',
                                        'value'   =>  get_the_ID(),
                                        'compare' => 'LIKE',
                                    ),
                                )
                            ) );
                        
                            if( ! $loop->have_posts() ) {
                               ?>
                               <ul class="list_">
                                <div class="warning_box">
                                    <i class="fas fa-exclamation-circle"></i>
                                    <p>ยังไม่มีการข้อมูลมีเรื่องร้องเรียน</p>
                                    <p>โปรดระมัดระวังความเสี่ยงที่อาจจะเกิดขึ้น</p>
                                </div>                             
                                </ul>
                               <?php
                            }
                            ?>
                            <?php
                            while( $loop->have_posts() ) {
                                $loop->the_post();
                                $user = get_post_field( 'post_author', $post_id );
                                $user_info = get_userdata($user);
                                ?>
                                <div class="in-card-disclosure">
                                    <div class="detail-box-disclosure"> 
                                        <div class="in-head">
                                            <div class="cat_disclosure">
                                                <?php    
                                                    $terms = get_the_term_list( get_the_ID(), 'disclosure_category', '', ',' ); 
                                                    $terms = strip_tags( $terms );       
                                                    $terms = get_the_term_list( get_the_ID(), 'disclosure_category');
                                                        if ($terms) {
                                                            echo '<span class="term_text">'.$terms.'</span>';                        
                                                        } else  {
                                                            echo '<p>'.'No Category'.'</p>';
                                                        }
                                                ?>
                                            </div>
                                            <div class="in-title">
                                                <h4><a href="<?php the_permalink();?>"><?php the_title(); ?></a></h4>         
                                            </div> 
                                        </div>                                                                                                                   
                                        <div class="excerpt-in">
                                            <?php the_excerpt(); ?>
                                        </div>
                                        <div class="timeing_box">
                                            <div class="avatar_disclosure">
                                                <div class="head_profile">
                                                    <div class="image">
                                                        <?php if ( $user ) : ?>
                                                            <img src="<?php echo esc_url( get_avatar_url( $user ) ); ?>" />
                                                        <?php endif; ?>
                                                    </div>
                                                    <div class="name">
                                                        <?php
                                                        $username = $user_info->user_login;
                                                        $first_name = $user_info->first_name;
                                                        echo '<p>';
                                                        echo $user_info->first_name;
                                                        echo '</p>';
                                                        ?>
                                                    </div>            
                                                </div>                       
                                            </div>
                                            <div class="date_post">
                                                <time datetime="<?php echo get_the_date('c'); ?>" itemprop="datePublished"><?php echo get_the_date('d F Y'); ?></time>
                                            </div>           
                                        </div>
                                    </div>
                                    <div class="in-thumbnail-disclosure">
                                        <?php the_post_thumbnail('medium'); ?>
                                    </div>
                                </div>
                                <?php
                            }
                            wp_reset_postdata();
                            ?>  
                            <div class="btn-go-disclosure">
                                <a href="/post-disclosure/" class="btn-go-disclosure"><i class="far fa-plus-square"></i> แจ้งเรื่องร้องเรียน</a>
                            </div>                                                      
                    <!--end block-->                                  
                    </div>

                </div>            
            </div>
        </div>    
    </div>                        
</article>

                            <?php if ( have_rows('repeat_broker') ) : ?>
                                    <?php 
                                        $i = 1;
                                        while( have_rows('repeat_broker') ) : the_row();
                                        $image_security = get_sub_field('image_security');                                       
                                    ?>
                                        
                                     <?php if($image_security){
                                                    ?>
                                                     <div class="image_security" setid="<?php echo $i++;?>">
                                                        <div class="img">
                                                            <img src="<?php echo $image_security['url'];?>" alt="<?php echo $image_security['title'];?>">
                                                        </div>
                                                    </div>
                                                    <?php
                                    } ?>                                              
                                    <?php endwhile; ?>
           
                            <?php else:?>

                            <?php endif; ?>               