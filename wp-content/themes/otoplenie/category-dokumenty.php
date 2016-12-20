<?php get_header(); ?>
   <div id="main">
    <div id="content">
    <div>
    <?php if ( function_exists('yoast_breadcrumb') ) {
    yoast_breadcrumb('<p id="breadcrumbs">','</p>');
    } ?>
    </div>
    <div class="clear"></div>
    <?php if ( $paged < 2 ) { ?>
                        <div class="desc">
                        <?php echo category_description(); ?></div>
                      <?php } ?>      
  <div class="clear"></div>           
    <?php if (have_posts()) { ?>
        <?php while (have_posts()) { the_post(); ?>    
 <div class="post" id="post-<?php the_ID(); ?>">

        <div class="text_container_l">
            <div class="text_container_r">
                <div class="text_l">
       
                <?php
                 if ( has_post_thumbnail() ) {
                          the_post_thumbnail();
                    } else {
                       //echo catch_that_image();
                    }       
                 ?>
                
                
                
                </div>

                <div class="text_r">
                <a class="header_link" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
                <?='<noindex>'?> 
                    <?php the_excerpt(); ?>
                <?='</noindex>'?> 
                </div>
            </div>
        </div>                                                             
 </div>
        <?php } ?>
        
   
            <div class="navigation">
                 <?php if(function_exists('wp_pagenavi')) { wp_pagenavi(); } ?>
             </div>
  <div class="clear"></div>       
              <div class="rekl">
            <!-- Яндекс.Директ -->
            <script type="text/javascript">
            yandex_partner_id = 136856;
            yandex_stat_id = 998;
            yandex_site_bg_color = 'FFFFFF';
            yandex_ad_format = 'direct';
            yandex_font_size = 1.2;
            yandex_font_family = 'courier new';
            yandex_direct_type = 'flat';
            yandex_direct_limit = 4;
            yandex_direct_title_font_size = 3;
            yandex_direct_links_underline = true;
            yandex_direct_title_color = 'FF0000';
            yandex_direct_url_color = '000000';
            yandex_direct_text_color = '000000';
            yandex_direct_hover_color = '006DB5';
            yandex_direct_favicon = true;
            yandex_no_sitelinks = true;
            document.write('<scr'+'ipt type="text/javascript" src="//an.yandex.ru/system/context.js"></scr'+'ipt>');
            </script>
          </div>
 <div class="clear"></div>       
   <div class="vkcomCat">
       

        <!-- VK Widget -->
        <div id="vk_groups"></div>
        <script type="text/javascript">
        VK.Widgets.Group("vk_groups", {mode: 0, width: "725", height: "200", color1: 'FFFFFF', color2: '2B587A', color3: '5B7FA6'}, 76403901);
        </script>
       
       </div>
  <div class="clear"></div>          
<?php } else { ?>
         
    <?php } ?>     
    </div><!--/content -->
    <?php get_sidebar(); ?>
 </div><!--/main -->

<?php get_footer(); ?>